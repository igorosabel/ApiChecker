<?php declare(strict_types=1);

namespace OsumiFramework\App\Module\Action;

use OsumiFramework\OFW\Routing\OModuleAction;
use OsumiFramework\OFW\Routing\OAction;
use OsumiFramework\App\DTO\CheckinDTO;

#[OModuleAction(
	url: '/save-checkin',
	filters: ['login'],
	services: ['web']
)]
class saveCheckinAction extends OAction {
	/**
	 * Método para guardar un checkin
	 *
	 * @param CheckinDTO $data Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(CheckinDTO $data):void {}
}
