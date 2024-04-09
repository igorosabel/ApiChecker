<?php declare(strict_types=1);

namespace OsumiFramework\App\Module\Action;

use OsumiFramework\OFW\Routing\OModuleAction;
use OsumiFramework\OFW\Routing\OAction;
use OsumiFramework\OFW\Web\ORequest;
use OsumiFramework\App\Model\User;
use OsumiFramework\App\Component\Model\UserComponent;
use OsumiFramework\App\Component\Model\CheckinTypeListComponent;
use OsumiFramework\OFW\Plugins\OToken;

#[OModuleAction(
	url: '/login',
	services:	['web']
)]
class loginAction extends OAction {
	/**
	 * Método para iniciar sesión
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(ORequest $req):void {
		$status = 'ok';
		$name   = $req->getParamString('name');
		$pass   = $req->getParamString('pass');
		$user_component = new UserComponent(['user' => null]);
		$checkin_type_list_component = new CheckinTypeListComponent(['list' => []]);

		if (is_null($name) || is_null($pass)) {
			$status = 'error';
		}

		if ($status=='ok') {
			$user = new User();
			if ($user->login($name, $pass)) {
				$tk = new OToken($this->getConfig()->getExtra('secret'));
				$tk->addParam('id', $user->get('id'));
				$tk->addParam('name', $user->get('name'));
				$tk->addParam('email', $user->get('email'));
				$tk->setEXP(time() + (60*60*24));
				$user->setToken($tk->getToken());

				$user_component->setValue('user', $user);
				$checkin_type_list_component->setValue('list', $this->web_service->getUserCheckinTypes($user->get('id')));
			}
			else {
				$status = 'error';
			}
		}

		$this->getTemplate()->add('status', $status);
		$this->getTemplate()->add('user',   $user_component);
		$this->getTemplate()->add('checkin_type_list', $checkin_type_list_component);
	}
}
