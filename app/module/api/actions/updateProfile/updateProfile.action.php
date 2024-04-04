<?php declare(strict_types=1);

namespace OsumiFramework\App\Module\Action;

use OsumiFramework\OFW\Routing\OModuleAction;
use OsumiFramework\OFW\Routing\OAction;
use OsumiFramework\App\DTO\ProfileDTO;
use OsumiFramework\App\Model\User;

#[OModuleAction(
	url: '/update-profile',
	filters: ['login']
)]
class updateProfileAction extends OAction {
	/**
	 * Método para actualizar el perfil de un usuario
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(ProfileDTO $data):void {
		$status = 'ok';

		if (!$data->isValid()) {
			$status = 'error';
		}

		if ($status == 'ok') {
			$user = new User();
			if ($user->find(['id' => $data->getIdUser()])) {
				$user_check = new User();
				if (
					$user_check->find(['email' => $data->getEmail()]) &&
					$user->get('id') != $user_check->get('id')
				) {
					$status = 'error-email';
				}
				if (
					$status == 'ok' &&
					$user_check->find(['name' => $data->getName()]) &&
					$user->get('id') != $user_check->get('id')
				) {
					$status = 'error-name';
				}
				if ($status == 'ok') {
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
				$status = 'error';
			}
		}

		$this->getTemplate()->add('status', $status);
	}
}
