<?php declare(strict_types=1);

namespace OsumiFramework\App\Model;

use OsumiFramework\OFW\DB\OModel;
use OsumiFramework\OFW\DB\OModelGroup;
use OsumiFramework\OFW\DB\OModelField;

class User extends OModel {
	function __construct() {
		$model = new OModelGroup(
			new OModelField(
				name: 'id',
				type: OMODEL_PK,
				comment: 'Id único del usuario'
			),
			new OModelField(
				name: 'name',
				type: OMODEL_TEXT,
				comment: 'Nombre del usuario',
				nullable: false,
        size: 50
			),
			new OModelField(
				name: 'email',
				type: OMODEL_TEXT,
				comment: 'Email del usuario',
				nullable: false,
        size: 50
			),
      new OModelField(
				name: 'pass',
				type: OMODEL_TEXT,
				comment: 'Contraseña encriptada del usuario',
				nullable: false,
        size: 50
			),
			new OModelField(
				name: 'created_at',
				type: OMODEL_CREATED,
				comment: 'Fecha de creación del registro'
			),
			new OModelField(
				name: 'updated_at',
				type: OMODEL_UPDATED,
				comment: 'Fecha de última modificación del registro'
			)
		);

		parent::load($model);
	}

	/**
	 * Función para comprobar un inicio de sesión. Primero busca el usuario por su nombre de usuario y luego comprueba su contraseña.
	 *
	 * @param string $user Nombre de usuario
	 *
	 * @param string $pass Contraseña a comprobar del usuario
	 *
	 * @return bool Devuelve si el inicio de sesión es correcto
	 */
	public function login(string $email, string $pass): bool {
		if ($this->find(['email' => $email])) {
			return $this->checkPass($pass);
		}
		else {
			return false;
		}
	}

	/**
	 * Comprueba la contraseña del usuario actualmente cargado
	 *
	 * @param string $pass Contraseña a comprobar del usuario
	 *
	 * @return bool Devuelve si el inicio de sesión es correcto
	 */
	public function checkPass(string $pass): bool {
		return password_verify($pass, $this->get('pass'));
	}

	private string | null $token = null;

	/**
	 * Obtiene el token del usuario
	 *
	 * @return string | null Token del usuario
	 */
	public function getToken(): string | null {
		return $this->token;
	}

	/**
	 * Guarda el token del usuario
	 *
	 * @param string $token Token del usuario
	 *
	 * @return void
	 */
	public function setToken(string $token):  void {
		$this->token = $token;
	}
}
