<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Module\ApiModule\Actions\UpdateProfile;

use Osumi\OsumiFramework\Routing\OModuleAction;
use Osumi\OsumiFramework\Core\OComponent;
use Osumi\OsumiFramework\App\DTO\ProfileDTO;
use Osumi\OsumiFramework\App\Model\User;

class UpdateProfileComponent extends OComponent {
	public string $status = 'ok';

	/**
	 * Método para actualizar el perfil de un usuario
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(ProfileDTO $data): void {
		if (!$data->isValid()) {
			$this->status = 'error';
		}

		if ($this->status === 'ok') {
			$user = User::findOne(['id' => $data->getIdUser()]);
			if (!is_null($user)) {
				$user_check = User::findOne(['email' => $data->getEmail()]);
				if (
					!is_null($user_check) &&
					$user->id !== $user_check->id
				) {
					$this->status = 'error-email';
				}

				$user_check = User::findOne(['name' => $data->getName()]);
				if (
					$this->status === 'ok' &&
					!is_null($user_check) &&
					$user->id !== $user_check->id
				) {
					$this->status = 'error-name';
				}

				if ($this->status === 'ok') {
					$user->name  = $data->getName();
					$user->email = $data->getEmail();
					if (
						$data->getPass() !== null &&
						$data->getConf() !== null &&
						$data->getPass() === $data->getConf()
					) {
						$user->pass = password_hash($data->getPass(), PASSWORD_BCRYPT);
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
