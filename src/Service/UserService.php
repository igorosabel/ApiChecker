<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Service;

use Osumi\OsumiFramework\Core\OService;
use Osumi\OsumiFramework\ORM\ODB;
use Osumi\OsumiFramework\App\Model\User;

class UserService extends OService {
  /**
   * Función para comprobar un inicio de sesión
   *
   * @param string $name Nombre de usuario
   *
   * @param string $pass Contraseña del usuario
   *
   * @return ?User Usuario si el inicio de sesión es correcto o null en caso contrario
   */
  public function login(string $name, string $pass): ?User {
    $user = User::findOne(['name' => $name]);
    if (!is_null($user) && $user->checkPass($pass)) {
      return $user;
		}
		return null;
  }
}
