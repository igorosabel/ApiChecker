<?php declare(strict_types=1);

namespace OsumiFramework\App\Module\Action;

use OsumiFramework\OFW\Routing\OModuleAction;
use OsumiFramework\OFW\Routing\OAction;
use OsumiFramework\OFW\Web\ORequest;
use OsumiFramework\App\Model\Checkin;

#[OModuleAction(
	url: '/delete-checkin',
	filters: ['login']
)]
class deleteCheckinAction extends OAction {
	/**
	 * Método para borrar un checkin
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(ORequest $req):void {
		$status = 'ok';
		$id = $req->getParamInt('id');
		$filter = $req->getFilter('login');
		$id_user = array_key_exists('id', $filter) ? $filter['id'] : null;

		if (is_null($id) || is_null($id_user)) {
			$status = 'error';
		}

		if ($status == 'ok') {
			$c = new Checkin();
			if ($c->find(['id' => $id])) {
				if ($c->get('id_user') == $id_user) {
					$c->deleteFull();
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
