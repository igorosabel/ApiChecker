<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Module\ApiModule\Actions\UpdateProfile;

use Osumi\OsumiFramework\Routing\OModuleAction;
use Osumi\OsumiFramework\Routing\OAction;
use Osumi\OsumiFramework\App\DTO\ProfileDTO;
use Osumi\OsumiFramework\App\Model\User;

#[OModuleAction(
	url: '/update-profile',
	filters: ['Login']
)]
class UpdateProfileAction extends OAction {
	public string $status = 'ok';

	/**
	 * Método para actualizar el perfil de un usuario
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(ProfileDTO $data):void {
		if (!$data->isValid()) {
			$this->status = 'error';
		}

		if ($this->status == 'ok') {
			$user = new User();
			if ($user->find(['id' => $data->getIdUser()])) {
				$user_check = new User();
				if (
					$user_check->find(['email' => $data->getEmail()]) &&
					$user->get('id') != $user_check->get('id')
				) {
					$this->status = 'error-email';
				}
				if (
					$this->status == 'ok' &&
					$user_check->find(['name' => $data->getName()]) &&
					$user->get('id') != $user_check->get('id')
				) {
					$this->status = 'error-name';
				}
				if ($this->status == 'ok') {
					$user->set('name', $data->getName());
					$user->set('email', $data->getEmail());
					if (
						$data->getPass() !== null &&
						$data->getConf() !== null &&
						$data->getPass() == $data->getConf()
					) {
						$user->set('pass', password_hash($data->getPass(), PASSWORD_BCRYPT));
					}
					$user->save();
				}
			}
			else {
				$this->status = 'error';
			}
		}
	}
}
