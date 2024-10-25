<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Module\Api\Register;

use Osumi\OsumiFramework\Core\OComponent;
use Osumi\OsumiFramework\Plugins\OToken;
use Osumi\OsumiFramework\App\DTO\RegisterDTO;
use Osumi\OsumiFramework\App\Model\User;
use Osumi\OsumiFramework\App\Component\Model\User\UserComponent;
use Osumi\OsumiFramework\App\Component\Model\CheckinTypeList\CheckinTypeListComponent;

class RegisterComponent extends OComponent {
	public string $status = 'ok';
	public ?UserComponent $user = null;
	public ?CheckinTypeListComponent $checkin_type_list = null;

	/**
	 * Función para registrar un nuevo usuario
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(RegisterDTO $data): void {
		$this->user = new UserComponent();
		$this->checkin_type_list = new CheckinTypeListComponent();

		if (!$data->isValid()) {
			$this->status = 'error';
		}

		if ($this->status === 'ok') {
			$u = User::findOne(['email' => $data->getEmail()]);
			if (!is_null($u)) {
				$this->status = 'error-email';
			}
			else {
				$u = User::findOne(['name' => $data->getName()]);
				if ($this->status === 'ok' && !is_null($u)) {
					$this->status = 'error-name';
				}
				if ($this->status === 'ok') {
					$u->name  = $data->getName();
					$u->email = $data->getEmail();
					$u->pass  = password_hash($data->getPass(), PASSWORD_BCRYPT);
					$u->save();

					$tk = new OToken($this->getConfig()->getExtra('secret'));
					$tk->addParam('id',    $u->id);
					$tk->addParam('name',  $u->name);
					$tk->addParam('email', $u->email);
					$u->setToken($tk->getToken());

					$this->user->user = $u;
				}
			}
		}
	}
}
