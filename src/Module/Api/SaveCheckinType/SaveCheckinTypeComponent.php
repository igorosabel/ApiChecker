<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Module\Api\SaveCheckinType;

use Osumi\OsumiFramework\Core\OComponent;
use Osumi\OsumiFramework\App\DTO\CheckintypeDTO;
use Osumi\OsumiFramework\App\Model\CheckinType;

class SaveCheckinTypeComponent extends OComponent {
	public string $status = 'ok';
	/**
	 * Método para guardar un tipo de checkin
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(CheckintypeDTO $data): void {
		if (!$data->isValid()) {
			$this->status = 'error';
		}

		if ($this->status === 'ok') {
			if (!is_null($data->id)) {
				$ct = CheckinType::findOne(['id' => $data->id]);
			}
			else {
				$ct = CheckinType::create();
				$ct->id_user   = $data->id_user;
				$ct->num       = 0;
				$ct->last_used = null;
			}

			$ct->name        = urldecode($data->name);
			$ct->icon        = urldecode($data->icon);
			$ct->has_message = $data->has_message;
			$ct->has_value   = $data->has_value;

			$ct->save();
		}
	}
}
