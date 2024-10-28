<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Module\Api\SaveCheckin;

use Osumi\OsumiFramework\Core\OComponent;
use Osumi\OsumiFramework\App\DTO\CheckinDTO;
use Osumi\OsumiFramework\App\Model\Checkin;
use Osumi\OsumiFramework\App\Model\CheckinType;
use Osumi\OsumiFramework\App\Model\Photo;
use Osumi\OsumiFramework\App\Service\WebService;

class SaveCheckinComponent extends OComponent {
	private ?WebService $ws = null;

	public string $status = 'ok';

	public function __construct() {
    parent::__construct();
		$this->ws = inject(WebService::class);
	}

	/**
	 * Método para guardar un checkin
	 *
	 * @param CheckinDTO $data Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(CheckinDTO $data): void {
		if (!$data->isValid()) {
			$this->status = 'error';
		}

		if ($this->status === 'ok') {
			$c = Checkin::create();

			$delete_previous_photo = null;
			$load_new_photo = false;

			if (!is_null($data->id)) {
				$c = Checkin::findOne(['id' => $data->id]);

				// No llega foto, no llega photo id y ya tenia (id_photo !== null) => borrar anterior
				if (is_null($data->photo) && is_null($data->id_photo) && !is_null($c->id_photo)) {
					$delete_previous_photo = $c->id_photo;
				}
				// Llega foto (photo) y no tenia (id_photo == null) => cargar nueva
				if (!is_null($data->photo) && is_null($c->id_photo)) {
					$load_new_photo = true;
				}
				// Llega foto (photo) y ya tenia (id_photo != null) => borrar anterior y cargar nueva
				if (!is_null($data->photo) && !is_null($c->id_photo)) {
					$delete_previous_photo = $c->id_photo;
					$load_new_photo = true;
				}
			}
			else {
				$c->id_user = $data->id_user;
				$c->id_type = $data->id_type;

				// Llega foto (photo) => cargar nueva
				if (!is_null($data->photo)) {
					$load_new_photo = true;
				}
			}

			if (!is_null($delete_previous_photo)) {
				$p = Photo::findOne(['id' => $delete_previous_photo]);
				$p->deleteFull();
				$data->id_photo = null;
			}
			if ($load_new_photo) {
				$p = Photo::create();
				$p->id_user = $data->id_user;
				$p->save();
				$data->id_photo = $p->id;

				$this->ws->savePhoto($data->photo, $p->id);
			}

			$c->message      = !is_null($data->message) ? urldecode($data->message) : null;
			$c->value        = $data->value;
			$c->location_lat = $data->location_lat;
			$c->location_lon = $data->location_lon;
			$c->id_photo     = $data->id_photo;

			$c->save();

			$ct = $c->getCheckinType();
			$ct->num       = $ct->num + 1;
			$ct->last_used = $c->get('created_at', 'Y-m-d H:i:s');
			$ct->save();
		}
	}
}
