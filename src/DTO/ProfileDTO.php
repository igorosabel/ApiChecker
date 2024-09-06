<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\DTO;

use Osumi\OsumiFramework\Core\ODTO;
use Osumi\OsumiFramework\Web\ORequest;

class ProfileDTO implements ODTO{
	private ?string $name  = null;
	private ?string $email = null;
	private ?string $pass  = null;
  private ?string $conf  = null;
	private ?int $id_user  = null;

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
	public function getIdUser(): ?int {
		return $this->id_user;
	}
	private function setIdUser(?int $id_user): void {
		$this->id_user = $id_user;
	}

	public function isValid(): bool {
		return (
			!is_null($this->getName()) &&
      !is_null($this->getEmail()) &&
			!is_null($this->getIdUser())
		);
	}

	public function load(ORequest $req): void {
		$filter = $req->getFilter('Login');

		$this->setName($req->getParamString('name'));
		$this->setEmail($req->getParamString('email'));
		$this->setPass($req->getParamString('pass'));
		$this->setConf($req->getParamString('conf'));
		$this->setIdUser(array_key_exists('id', $filter) ? $filter['id'] : null);
	}
}
