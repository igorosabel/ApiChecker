<?php declare(strict_types=1);

namespace OsumiFramework\App\DTO;

use OsumiFramework\OFW\Core\ODTO;
use OsumiFramework\OFW\Web\ORequest;

class CheckintypeDTO implements ODTO{
	private ?int $id           = null;
	private ?string $name      = null;
	private ?string $icon      = null;
  private ?bool $has_message = null;
  private ?bool $has_value   = null;
  private ?int $id_user      = null;

	private function setId(?int $id) {
		$this->id = $id;
	}
	public function getId(): ?int {
		return $this->id;
	}
	private function setName(?string $name) {
		$this->name = $name;
	}
	public function getName(): ?string {
		return $this->name;
	}
	private function setIcon(?string $icon) {
		$this->icon = $icon;
	}
	public function getIcon(): ?string {
		return $this->icon;
	}
  private function setHasMessage(?bool $has_message) {
		$this->has_message = $has_message;
	}
	public function getHasMessage(): ?bool {
		return $this->has_message;
	}
  private function setHasValue(?bool $has_value) {
		$this->has_value = $has_value;
	}
	public function getHasValue(): ?bool {
		return $this->has_value;
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
      !is_null($this->getIcon()) &&
      !is_null($this->getIdUser())
    );
	}

	public function load(ORequest $req): void {
    $filter = $req->getFilter('login');

		$this->setId($req->getParamInt('id'));
		$this->setName($req->getParamString('name'));
		$this->setIcon($req->getParamString('icon'));
    $this->setHasMessage($req->getParamBool('hasMessage'));
    $this->setHasValue($req->getParamBool('hasValue'));
    $this->setIdUser(array_key_exists('id', $filter) ? $filter['id'] : null);
	}
}
