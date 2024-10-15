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
	public function run(RegisterDTO $data):void {
		$this->user = new UserComponent();
		$this->checkin_type_list = new CheckinTypeListComponent();

		if (!$data->isValid()) {
			$this->status = 'error';
		}

		if ($this->status == 'ok') {
			$u = new User();
			if ($u->find(['email' => $data->getEmail()])) {
				$this->status = 'error-email';
			}
			if ($this->status == 'ok' && $u->find(['name' => $data->getName()])) {
				$this->status = 'error-name';
			}
			if ($this->status == 'ok') {
				$u->set('name', $data->getName());
				$u->set('email', $data->getEmail());
				$u->set('pass', password_hash($data->getPass(), PASSWORD_BCRYPT));
				$u->save();

				$tk = new OToken($this->getConfig()->getExtra('secret'));
				$tk->addParam('id', $u->get('id'));
				$tk->addParam('name', $u->get('name'));
				$tk->addParam('email', $u->get('email'));
				$u->setToken($tk->getToken());

				$this->user->user = $u;
			}
		}
	}
}
