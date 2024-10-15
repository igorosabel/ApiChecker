<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Module\Api\DeleteCheckin;

use Osumi\OsumiFramework\Core\OComponent;
use Osumi\OsumiFramework\Web\ORequest;
use Osumi\OsumiFramework\App\Model\Checkin;

class DeleteCheckinComponent extends OComponent {
	public string $status = 'ok';

	/**
	 * Método para borrar un checkin
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
			$c = new Checkin();
			if ($c->find(['id' => $id])) {
				if ($c->get('id_user') == $id_user) {
					$c->deleteFull();
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
