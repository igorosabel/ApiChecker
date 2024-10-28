<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\DTO;

use Osumi\OsumiFramework\Core\ODTO;
use Osumi\OsumiFramework\Web\ORequest;

class RegisterDTO implements ODTO{
	public ?string $name  = null;
	public ?string $email = null;
	public ?string $pass  = null;
  public ?string $conf  = null;

	public function isValid(): bool {
		return (
			!is_null($this->name) &&
      !is_null($this->email) &&
      !is_null($this->pass) &&
      !is_null($this->conf) &&
      ($this->pass === $this->conf)
		);
	}

	public function load(ORequest $req): void {
		$this->name  = $req->getParamString('name');
		$this->email = $req->getParamString('email');
		$this->pass  = $req->getParamString('pass');
		$this->conf  = $req->getParamString('conf');
	}
}
