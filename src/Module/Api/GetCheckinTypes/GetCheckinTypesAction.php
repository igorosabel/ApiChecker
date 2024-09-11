<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Module\Api\GetCheckinTypes;

use Osumi\OsumiFramework\Routing\OAction;
use Osumi\OsumiFramework\Web\ORequest;
use Osumi\OsumiFramework\App\Component\Model\CheckinTypeList\CheckinTypeListComponent;

class GetCheckinTypesAction extends OAction {
	public string $status = 'ok';
	public ?CheckinTypeListComponent $list = null;
	/**
	 * Método para obtener el listado de checkins de un usuario
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(ORequest $req):void {
		$filter = $req->getFilter('Login');
		$id_user = array_key_exists('id', $filter) ? $filter['id'] : null;
		$this->list = new CheckinTypeListComponent(['list' => []]);

		if (is_null($id_user)) {
			$this->status = 'error';
		}

		if ($this->status == 'ok') {
			$this->list->setValue('list', $this->service['Web']->getUserCheckinTypes($id_user));
		}
	}
}
