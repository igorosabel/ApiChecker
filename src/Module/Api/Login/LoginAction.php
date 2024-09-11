<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Module\Api\Login;

use Osumi\OsumiFramework\Routing\OAction;
use Osumi\OsumiFramework\Web\ORequest;
use Osumi\OsumiFramework\Plugins\OToken;
use Osumi\OsumiFramework\App\Model\User;
use Osumi\OsumiFramework\App\Component\Model\User\UserComponent;
use Osumi\OsumiFramework\App\Component\Model\CheckinTypeList\CheckinTypeListComponent;

class LoginAction extends OAction {
	public string $status = 'ok';
	public ?UserComponent $user = null;
	public ?CheckinTypeListComponent $checkin_type_list = null;

	/**
	 * Método para iniciar sesión
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(ORequest $req):void {
		$name = $req->getParamString('name');
		$pass = $req->getParamString('pass');
		$this->user = new UserComponent(['User' => null]);
		$this->checkin_type_list = new CheckinTypeListComponent(['list' => []]);

		if (is_null($name) || is_null($pass)) {
			$this->status = 'error';
		}

		if ($this->status=='ok') {
			$u = new User();
			if ($u->login($name, $pass)) {
				$tk = new OToken($this->getConfig()->getExtra('secret'));
				$tk->addParam('id', $u->get('id'));
				$tk->addParam('name', $u->get('name'));
				$tk->addParam('email', $u->get('email'));
				$tk->setEXP(time() + (60*60*24));
				$u->setToken($tk->getToken());

				$this->user->setValue('User', $u);
				$this->checkin_type_list->setValue('list', $this->service['Web']->getUserCheckinTypes($u->get('id')));
			}
			else {
				$this->status = 'error';
			}
		}
	}
}
