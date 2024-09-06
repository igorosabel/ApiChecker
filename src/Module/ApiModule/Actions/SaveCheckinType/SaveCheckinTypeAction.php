<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Module\ApiModule\Actions\SaveCheckinType;

use Osumi\OsumiFramework\Routing\OModuleAction;
use Osumi\OsumiFramework\Routing\OAction;
use Osumi\OsumiFramework\App\DTO\CheckintypeDTO;
use Osumi\OsumiFramework\App\Model\CheckinType;

#[OModuleAction(
	url: '/save-checkin-type',
	filters: ['Login']
)]
class SaveCheckinTypeAction extends OAction {
	/**
	 * Método para guardar un tipo de checkin
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(CheckintypeDTO $data):void {
		$status = 'ok';

		if (!$data->isValid()) {
			$status = 'error';
		}

		if ($status == 'ok') {
			$ct = new CheckinType();

			if (!is_null($data->getId())) {
				$ct->find(['id' => $data->getId()]);
			}
			else {
				$ct->set('id_user', $data->getIdUser());
				$ct->set('num', 0);
				$ct->set('last_used', null);
			}

			$ct->set('name', urldecode($data->getName()));
			$ct->set('icon', urldecode($data->getIcon()));
			$ct->set('has_message', $data->getHasMessage());
			$ct->set('has_value', $data->getHasValue());

			$ct->save();
		}

		$this->getTemplate()->add('status', $status);
	}
}