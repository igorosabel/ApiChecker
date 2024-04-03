<?php declare(strict_types=1);

namespace OsumiFramework\App\Module\Action;

use OsumiFramework\OFW\Routing\OModuleAction;
use OsumiFramework\OFW\Routing\OAction;
use OsumiFramework\App\DTO\CheckintypeDTO;
use OsumiFramework\App\Model\CheckinType;

#[OModuleAction(
	url: '/save-checkin-type',
	filters: ['login']
)]
class saveCheckinTypeAction extends OAction {
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
