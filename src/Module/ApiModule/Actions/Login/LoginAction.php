<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Module\ApiModule\Actions\Login;

use Osumi\OsumiFramework\Routing\OModuleAction;
use Osumi\OsumiFramework\Routing\OAction;
use Osumi\OsumiFramework\Web\ORequest;
use Osumi\OsumiFramework\Plugins\OToken;
use Osumi\OsumiFramework\App\Model\User;
use Osumi\OsumiFramework\App\Component\Model\User\UserComponent;
use Osumi\OsumiFramework\App\Component\Model\CheckinTypeList\CheckinTypeListComponent;

#[OModuleAction(
	url: '/login',
	services:	['Web']
)]
class LoginAction extends OAction {
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
		$user_component = new UserComponent(['User' => null]);
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

				$user_component->setValue('User', $user);
				$checkin_type_list_component->setValue('list', $this->service['Web']->getUserCheckinTypes($user->get('id')));
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
