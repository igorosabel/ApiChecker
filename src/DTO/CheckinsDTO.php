<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\DTO;

use Osumi\OsumiFramework\Core\ODTO;
use Osumi\OsumiFramework\Web\ORequest;

class CheckinsDTO implements ODTO{
	private ?int $id_type  = null;
	private ?string $start = null;
	private ?string $end   = null;
	private ?int $page     = null;
  private ?int $id_user  = null;

	private function setIdType(?int $id_type) {
		$this->id_type = $id_type;
	}
	public function getIdType(): ?int {
		return $this->id_type;
	}
	private function setStart(?string $start) {
		$this->start = $start;
	}
	public function getStart(): ?string {
		return $this->start;
	}
	private function setEnd(?string $end) {
		$this->end = $end;
	}
	public function getEnd(): ?string {
		return $this->end;
	}
	private function setPage(?int $page) {
		$this->page = $page;
	}
	public function getPage(): ?int {
		return $this->page;
	}
  public function getIdUser(): ?int {
		return $this->id_user;
	}
	private function setIdUser(?int $id_user): void {
		$this->id_user = $id_user;
	}

	public function isValid(): bool {
		return (
			!is_null($this->getPage()) &&
			!is_null($this->getIdUser())
		);
	}

	public function load(ORequest $req): void {
    $filter = $req->getFilter('Login');

		$this->setIdType($req->getParamInt('idType'));
		$this->setStart($req->getParamString('start'));
		$this->setEnd($req->getParamString('end'));
		$this->setPage($req->getParamInt('page'));
    $this->setIdUser(array_key_exists('id', $filter) ? $filter['id'] : null);
	}
}
