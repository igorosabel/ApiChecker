<?php declare(strict_types=1);

namespace OsumiFramework\App\Module\Action;

use OsumiFramework\OFW\Routing\OModuleAction;
use OsumiFramework\OFW\Routing\OAction;
use OsumiFramework\OFW\Web\ORequest;
use OsumiFramework\App\Component\Model\CheckinTypeListComponent;

#[OModuleAction(
	url: '/get-checkin-types',
	services:	['web'],
	filters: ['login']
)]
class getCheckinTypesAction extends OAction {
	/**
	 * Método para obtener el listado de checkins de un usuario
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(ORequest $req):void {
		$status = 'ok';
		$filter = $req->getFilter('login');
		$id_user = array_key_exists('id', $filter) ? $filter['id'] : null;
		$checkin_type_list_component = new CheckinTypeListComponent(['list' => []]);

		if (is_null($id_user)) {
			$status = 'error';
		}

		if ($status == 'ok') {
			$checkin_type_list_component->setValue('list', $this->web_service->getUserCheckinTypes($id_user));
		}

		$this->getTemplate()->add('status', $status);
		$this->getTemplate()->add('list',   $checkin_type_list_component);
	}
}
