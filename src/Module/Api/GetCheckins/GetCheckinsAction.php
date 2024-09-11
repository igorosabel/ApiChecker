<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Module\Api\GetCheckins;

use Osumi\OsumiFramework\Routing\OAction;
use Osumi\OsumiFramework\App\DTO\CheckinsDTO;
use Osumi\OsumiFramework\App\Component\Model\CheckinList\CheckinListComponent;

class GetCheckinsAction extends OAction {
	public string $status = 'ok';
	public string | float $pages  = 'null';
	public string | float $total  = 'null';
	public ?CheckinListComponent $list = null;

	/**
	 * Método para obtener el listado de checkins de un usuario
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(CheckinsDTO $data):void {
		$this->list = new CheckinListComponent(['list' => []]);

		if (!$data->isValid()) {
			$this->status = 'error';
		}

		if ($this->status == 'ok') {
			$this->list->setValue('list', $this->service['Web']->getUserCheckins($data));
			$stats = $this->service['Web']->getUserCheckinsPages($data);
			$this->pages = $stats['pages'];
			$this->total = $stats['total'];
		}
	}
}
