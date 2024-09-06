<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Module\ApiModule\Actions\Register;

use Osumi\OsumiFramework\Routing\OModuleAction;
use Osumi\OsumiFramework\Routing\OAction;
use Osumi\OsumiFramework\Plugins\OToken;
use Osumi\OsumiFramework\App\DTO\RegisterDTO;
use Osumi\OsumiFramework\App\Model\User;
use Osumi\OsumiFramework\App\Component\Model\User\UserComponent;
use Osumi\OsumiFramework\App\Component\Model\CheckinTypeList\CheckinTypeListComponent;

#[OModuleAction(
	url: '/register'
)]
class RegisterAction extends OAction {
	/**
	 * Función para registrar un nuevo usuario
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(RegisterDTO $data):void {
		$status = 'ok';
		$user_component = new UserComponent(['User' => null]);
		$checkin_type_list_component = new CheckinTypeListComponent(['list' => []]);

		if (!$data->isValid()) {
			$status = 'error';
		}

		if ($status == 'ok') {
			$user = new User();
			if ($user->find(['email' => $data->getEmail()])) {
				$status = 'error-email';
			}
			if ($status == 'ok' && $user->find(['name' => $data->getName()])) {
				$status = 'error-name';
			}
			if ($status == 'ok') {
				$user->set('name', $data->getName());
				$user->set('email', $data->getEmail());
				$user->set('pass', password_hash($data->getPass(), PASSWORD_BCRYPT));
				$user->save();

				$tk = new OToken($this->getConfig()->getExtra('secret'));
				$tk->addParam('id', $user->get('id'));
				$tk->addParam('name', $user->get('name'));
				$tk->addParam('email', $user->get('email'));
				$user->setToken($tk->getToken());

				$user_component->setValue('User', $user);
			}
		}

		$this->getTemplate()->add('status', $status);
		$this->getTemplate()->add('user',   $user_component);
		$this->getTemplate()->add('checkin_type_list', $checkin_type_list_component);
	}
}
