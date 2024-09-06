<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Module\ApiModule\Actions\DeleteCheckinType;

use Osumi\OsumiFramework\Routing\OModuleAction;
use Osumi\OsumiFramework\Routing\OAction;
use Osumi\OsumiFramework\Web\ORequest;
use Osumi\OsumiFramework\App\Model\CheckinType;

#[OModuleAction(
	url: '/delete-checkin-type',
	services:	['Web'],
	filters: ['Login']
)]
class DeleteCheckinTypeAction extends OAction {
	/**
	 * Método para borrar un tipo de checkin y todos sus checkins asociados
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(ORequest $req):void {
		$status = 'ok';
		$id = $req->getParamInt('id');
		$filter = $req->getFilter('Login');
		$id_user = array_key_exists('id', $filter) ? $filter['id'] : null;

		if (is_null($id) || is_null($id_user)) {
			$status = 'error';
		}

		if ($status == 'ok') {
			$ct = new CheckinType();
			if ($ct->find(['id' => $id])) {
				if ($ct->get('id_user') == $id_user) {
					$this->service['Web']->deleteCheckinType($ct);
				}
				else {
					$status = 'error';
				}
			}
			else {
				$status = 'error';
			}
		}

		$this->getTemplate()->add('status', $status);
	}
}