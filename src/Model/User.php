<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Model;

use Osumi\OsumiFramework\ORM\OModel;
use Osumi\OsumiFramework\ORM\OPK;
use Osumi\OsumiFramework\ORM\OField;
use Osumi\OsumiFramework\ORM\OCreatedAt;
use Osumi\OsumiFramework\ORM\OUpdatedAt;

class User extends OModel {
	#[OPK(
	  comment: 'Id único del usuario'
	)]
	public ?int $id;

	#[OField(
	  comment: 'Nombre del usuario',
	  nullable: false,
	  max: 50
	)]
	public ?string $name;

	#[OField(
	  comment: 'Email del usuario',
	  nullable: false,
	  max: 50
	)]
	public ?string $email;

	#[OField(
	  comment: 'Contraseña encriptada del usuario',
	  nullable: false,
	  max: 100
	)]
	public ?string $pass;

	#[OCreatedAt(
	  comment: 'Fecha de creación del registro'
	)]
	public ?string $created_at;

	#[OUpdatedAt(
	  comment: 'Fecha de última modificación del registro'
	)]
	public ?string $updated_at;

	/**
	 * Comprueba la contraseña del usuario actualmente cargado
	 *
	 * @param string $pass Contraseña a comprobar del usuario
	 *
	 * @return bool Devuelve si el inicio de sesión es correcto
	 */
	public function checkPass(string $pass): bool {
		return password_verify($pass, $this->pass);
	}

	/**
	 * Token del usuario
	 */
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
	public function setToken(string $token): void {
		$this->token = $token;
	}
}
