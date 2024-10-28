<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\DTO;

use Osumi\OsumiFramework\Core\ODTO;
use Osumi\OsumiFramework\Web\ORequest;

class ProfileDTO implements ODTO{
	public ?string $name  = null;
	public ?string $email = null;
	public ?string $pass  = null;
  public ?string $conf  = null;
	public ?int $id_user  = null;

	public function isValid(): bool {
		return (
			!is_null($this->name) &&
      !is_null($this->email) &&
			!is_null($this->getIdUser())
		);
	}

	public function load(ORequest $req): void {
		$filter = $req->getFilter('Login');

		$this->name    = $req->getParamString('name');
		$this->email   = $req->getParamString('email');
		$this->pass    = $req->getParamString('pass');
		$this->conf    = $req->getParamString('conf');
		$this->id_user = array_key_exists('id', $filter) ? $filter['id'] : null;
	}
}
