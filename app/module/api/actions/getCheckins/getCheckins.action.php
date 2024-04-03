<?php declare(strict_types=1);

namespace OsumiFramework\App\Module\Action;

use OsumiFramework\OFW\Routing\OModuleAction;
use OsumiFramework\OFW\Routing\OAction;
use OsumiFramework\App\DTO\CheckinsDTO;
use OsumiFramework\App\Component\Model\CheckinListComponent;

#[OModuleAction(
	url: '/get-checkins',
	services:	['web'],
	filters: ['login']
)]
class getCheckinsAction extends OAction {
	/**
	 * Método para obtener el listado de checkins de un usuario
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(CheckinsDTO $data):void {
		$status = 'ok';
		$checkin_list_component = new CheckinListComponent(['list' => []]);

		if (!$data->isValid()) {
			$status = 'error';
		}

		if ($status == 'ok') {
			$checkin_list_component->setValue('list', $this->web_service->getUserCheckins($data));
		}

		$this->getTemplate()->add('status', $status);
		$this->getTemplate()->add('list',   $checkin_list_component);
	}
}
