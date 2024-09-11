<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Module\Api\SaveCheckin;

use Osumi\OsumiFramework\Routing\OAction;
use Osumi\OsumiFramework\App\DTO\CheckinDTO;
use Osumi\OsumiFramework\App\Model\Checkin;
use Osumi\OsumiFramework\App\Model\CheckinType;
use Osumi\OsumiFramework\App\Model\Photo;

class SaveCheckinAction extends OAction {
	public string $status = 'ok';

	/**
	 * Método para guardar un checkin
	 *
	 * @param CheckinDTO $data Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(CheckinDTO $data):void {
		if (!$data->isValid()) {
			$this->status = 'error';
		}

		if ($this->status == 'ok') {
			$c = new Checkin();

			$delete_previous_photo = null;
			$load_new_photo = false;

			if (!is_null($data->getId())) {
				$c->find(['id' => $data->getId()]);

				// No llega foto, no llega photo id y ya tenia (id_photo !== null) => borrar anterior
				if (is_null($data->getPhoto()) && is_null($data->getIdPhoto()) && !is_null($c->get('id_photo'))) {
					$delete_previous_photo = $c->get('id_photo');
				}
				// Llega foto (photo) y no tenia (id_photo == null) => cargar nueva
				if (!is_null($data->getPhoto()) && is_null($c->get('id_photo'))) {
					$load_new_photo = true;
				}
				// Llega foto (photo) y ya tenia (id_photo != null) => borrar anterior y cargar nueva
				if (!is_null($data->getPhoto()) && !is_null($c->get('id_photo'))) {
					$delete_previous_photo = $c->get('id_photo');
					$load_new_photo = true;
				}
			}
			else {
				$c->set('id_user', $data->getIdUser());
				$c->set('id_type', $data->getIdType());

				// Llega foto (photo) => cargar nueva
				if (!is_null($data->getPhoto())) {
					$load_new_photo = true;
				}
			}

			if (!is_null($delete_previous_photo)) {
				$p = new Photo();
				$p->find(['id' => $delete_previous_photo]);
				$p->deleteFull();
				$data->setIdPhoto(null);
			}
			if ($load_new_photo) {
				$p = new Photo();
				$p->set('id_user', $data->getIdUser());
				$p->save();
				$data->setIdPhoto($p->get('id'));

				$this->service['Web']->savePhoto($data->getPhoto(), $p->get('id'));
			}

			$c->set('message',      !is_null($data->getMessage()) ? urldecode($data->getMessage()) : null);
			$c->set('value',        $data->getValue());
			$c->set('location_lat', $data->getLocationLat());
			$c->set('location_lon', $data->getLocationLon());
			$c->set('id_photo',     $data->getIdPhoto());

			$c->save();

			$ct = $c->getCheckinType();
			$ct->set('num', $ct->get('num') + 1);
			$ct->set('last_used', $c->get('created_at', 'Y-m-d H:i:s'));
			$ct->save();
		}
	}
}
