<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Module\Api\Login;

use Osumi\OsumiFramework\Core\OComponent;
use Osumi\OsumiFramework\Web\ORequest;
use Osumi\OsumiFramework\Plugins\OToken;
use Osumi\OsumiFramework\App\Model\User;
use Osumi\OsumiFramework\App\Service\WebService;
use Osumi\OsumiFramework\App\Service\UserService;
use Osumi\OsumiFramework\App\Component\Model\User\UserComponent;
use Osumi\OsumiFramework\App\Component\Model\CheckinTypeList\CheckinTypeListComponent;

class LoginComponent extends OComponent {
	private ?WebService $ws = null;
	private ?UserService $us = null;

	public string $status = 'ok';
	public ?UserComponent $user = null;
	public ?CheckinTypeListComponent $checkin_type_list = null;

	public function __construct() {
    parent::__construct();
		$this->ws = inject(WebService::class);
		$this->us = inject(UserService::class);
		$this->user = new UserComponent();
		$this->checkin_type_list = new CheckinTypeListComponent();
	}

	/**
	 * Método para iniciar sesión
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(ORequest $req): void {
		$name = $req->getParamString('name');
		$pass = $req->getParamString('pass');

		if (is_null($name) || is_null($pass)) {
			$this->status = 'error';
		}

		if ($this->status === 'ok') {
			$u = $this->us->login($name, $pass);
			if (!is_null($u)) {
				$tk = new OToken($this->getConfig()->getExtra('secret'));
				$tk->addParam('id',    $u->id);
				$tk->addParam('name',  $u->name);
				$tk->addParam('email', $u->email);
				$tk->setEXP(time() + (60 * 60 * 24));
				$u->setToken($tk->getToken());

				$this->user->user = $u;
				$this->checkin_type_list->list = $this->ws->getUserCheckinTypes($u->id);
			}
			else {
				$this->status = 'error';
			}
		}
	}
}
