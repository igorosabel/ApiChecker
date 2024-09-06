<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Module\ApiModule\Actions\GetCheckins;

use Osumi\OsumiFramework\Routing\OModuleAction;
use Osumi\OsumiFramework\Routing\OAction;
use Osumi\OsumiFramework\App\DTO\CheckinsDTO;
use Osumi\OsumiFramework\App\Component\Model\CheckinList\CheckinListComponent;

#[OModuleAction(
	url: '/get-checkins',
	services:	['Web'],
	filters: ['Login']
)]
class GetCheckinsAction extends OAction {
	/**
	 * Método para obtener el listado de checkins de un usuario
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(CheckinsDTO $data):void {
		$status = 'ok';
		$checkin_list_component = new CheckinListComponent(['list' => []]);
		$pages = 'null';
		$total = 'null';

		if (!$data->isValid()) {
			$status = 'error';
		}

		if ($status == 'ok') {
			$checkin_list_component->setValue('list', $this->service['Web']->getUserCheckins($data));
			$stats = $this->service['Web']->getUserCheckinsPages($data);
			$pages = $stats['pages'];
			$total = $stats['total'];
		}

		$this->getTemplate()->add('status', $status);
		$this->getTemplate()->add('list',   $checkin_list_component);
		$this->getTemplate()->add('pages',  $pages);
		$this->getTemplate()->add('total',  $total);
	}
}
