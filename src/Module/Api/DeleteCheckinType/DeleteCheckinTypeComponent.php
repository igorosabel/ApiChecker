<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Module\Api\DeleteCheckinType;

use Osumi\OsumiFramework\Core\OComponent;
use Osumi\OsumiFramework\Web\ORequest;
use Osumi\OsumiFramework\App\Model\CheckinType;

class DeleteCheckinTypeComponent extends OComponent {
	public string $status = 'ok';

	/**
	 * Método para borrar un tipo de checkin y todos sus checkins asociados
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(ORequest $req):void {
		$id = $req->getParamInt('id');
		$filter = $req->getFilter('Login');
		$id_user = array_key_exists('id', $filter) ? $filter['id'] : null;

		if (is_null($id) || is_null($id_user)) {
			$this->status = 'error';
		}

		if ($this->status == 'ok') {
			$ct = new CheckinType();
			if ($ct->find(['id' => $id])) {
				if ($ct->get('id_user') == $id_user) {
					$this->service['Web']->deleteCheckinType($ct);
				}
				else {
					$this->status = 'error';
				}
			}
			else {
				$this->status = 'error';
			}
		}
	}
}
