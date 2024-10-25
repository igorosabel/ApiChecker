<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Module\Api\GetCheckinTypes;

use Osumi\OsumiFramework\Core\OComponent;
use Osumi\OsumiFramework\Web\ORequest;
use Osumi\OsumiFramework\App\Service\WebService;
use Osumi\OsumiFramework\App\Component\Model\CheckinTypeList\CheckinTypeListComponent;

class GetCheckinTypesComponent extends OComponent {
	private ?WebService $ws = null;

	public string $status = 'ok';
	public ?CheckinTypeListComponent $list = null;

	public function __construct() {
    parent::__construct();
		$this->ws = inject(WebService::class);
		$this->list = new CheckinTypeListComponent();
	}

	/**
	 * Método para obtener el listado de checkins de un usuario
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(ORequest $req): void {
		$filter = $req->getFilter('Login');
		$id_user = array_key_exists('id', $filter) ? $filter['id'] : null;

		if (is_null($id_user)) {
			$this->status = 'error';
		}

		if ($this->status === 'ok') {
			$this->list->list = $this->ws->getUserCheckinTypes($id_user);
		}
	}
}
