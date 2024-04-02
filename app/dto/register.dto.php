<?php declare(strict_types=1);

namespace OsumiFramework\App\DTO;

use OsumiFramework\OFW\Core\ODTO;
use OsumiFramework\OFW\Web\ORequest;

class RegisterDTO implements ODTO{
	private ?string $name  = null;
	private ?string $email = null;
	private ?string $pass  = null;
  private ?string $conf  = null;

	private function setName(?string $name) {
		$this->name = $name;
	}
	public function getName(): ?string {
		return $this->name;
	}
	private function setEmail(?string $email) {
		$this->email = $email;
	}
	public function getEmail(): ?string {
		return $this->email;
	}
	private function setPass(?string $pass) {
		$this->pass = $pass;
	}
	public function getPass(): ?string {
		return $this->pass;
	}
	private function setConf(?string $conf) {
		$this->conf = $conf;
	}
	public function getConf(): ?string {
		return $this->conf;
	}

	public function isValid(): bool {
		return (
			!is_null($this->getName()) &&
      !is_null($this->getEmail()) &&
      !is_null($this->getPass()) &&
      !is_null($this->getConf()) &&
      ($this->getPass() === $this->getConf())
		);
	}

	public function load(ORequest $req): void {
		$this->setName($req->getParamString('name'));
		$this->setEmail($req->getParamString('email'));
		$this->setPass($req->getParamString('pass'));
		$this->setConf($req->getParamString('conf'));
	}
}
