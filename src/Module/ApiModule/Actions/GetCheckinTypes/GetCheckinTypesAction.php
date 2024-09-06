<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Module\ApiModule\Actions\GetCheckinTypes;

use Osumi\OsumiFramework\Routing\OModuleAction;
use Osumi\OsumiFramework\Routing\OAction;
use Osumi\OsumiFramework\Web\ORequest;
use Osumi\OsumiFramework\App\Component\Model\CheckinTypeList\CheckinTypeListComponent;

#[OModuleAction(
	url: '/get-checkin-types',
	services:	['Web'],
	filters: ['Login']
)]
class GetCheckinTypesAction extends OAction {
	/**
	 * Método para obtener el listado de checkins de un usuario
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(ORequest $req):void {
		$status = 'ok';
		$filter = $req->getFilter('Login');
		$id_user = array_key_exists('id', $filter) ? $filter['id'] : null;
		$checkin_type_list_component = new CheckinTypeListComponent(['list' => []]);

		if (is_null($id_user)) {
			$status = 'error';
		}

		if ($status == 'ok') {
			$checkin_type_list_component->setValue('list', $this->service['Web']->getUserCheckinTypes($id_user));
		}

		$this->getTemplate()->add('status', $status);
		$this->getTemplate()->add('list',   $checkin_type_list_component);
	}
}
