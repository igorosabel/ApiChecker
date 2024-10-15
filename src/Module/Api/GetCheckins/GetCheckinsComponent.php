<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Module\Api\GetCheckins;

use Osumi\OsumiFramework\Core\OComponent;
use Osumi\OsumiFramework\App\DTO\CheckinsDTO;
use Osumi\OsumiFramework\App\Service\WebService;
use Osumi\OsumiFramework\App\Component\Model\CheckinList\CheckinListComponent;

class GetCheckinsComponent extends OComponent {
	private ?WebService $ws = null;

	public string $status = 'ok';
	public string | float $pages  = 'null';
	public string | float $total  = 'null';
	public ?CheckinListComponent $list = null;

	public function __construct() {
    parent::__construct();
		$this->ws = inject(WebService::class);
		$this->list = new CheckinListComponent();
	}

	/**
	 * Método para obtener el listado de checkins de un usuario
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(CheckinsDTO $data):void {
		if (!$data->isValid()) {
			$this->status = 'error';
		}

		if ($this->status === 'ok') {
			$this->list->list = $this->ws->getUserCheckins($data);
			$stats = $this->ws->getUserCheckinsPages($data);
			$this->pages = $stats['pages'];
			$this->total = $stats['total'];
		}
	}
}
