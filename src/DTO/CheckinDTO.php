<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\DTO;

use Osumi\OsumiFramework\Core\ODTO;
use Osumi\OsumiFramework\Web\ORequest;

class CheckinDTO implements ODTO{
	private ?int $id             = null;
  private ?int $id_type        = null;
	private ?string $message     = null;
	private ?float $value        = null;
  private ?float $location_lat = null;
  private ?float $location_lon = null;
  private ?int $id_photo       = null;
  private ?string $photo       = null;
	private ?int $id_user        = null;

	private function setId(?int $id) {
		$this->id = $id;
	}
	public function getId(): ?int {
		return $this->id;
	}
  private function setIdType(?int $id_type) {
		$this->id_type = $id_type;
	}
	public function getIdType(): ?int {
		return $this->id_type;
	}
	private function setMessage(?string $message) {
		$this->message = $message;
	}
	public function getMessage(): ?string {
		return $this->message;
	}
	private function setValue(?float $value) {
		$this->value = $value;
	}
	public function getValue(): ?float {
		return $this->value;
	}
  private function setLocationLat(?float $location_lat) {
		$this->location_lat = $location_lat;
	}
	public function getLocationLat(): ?float {
		return $this->location_lat;
	}
  private function setLocationLon(?float $location_lon) {
		$this->location_lon = $location_lon;
	}
	public function getLocationLon(): ?float {
		return $this->location_lon;
	}
  public function getIdPhoto(): ?int {
		return $this->id_photo;
	}
	private function setIdPhoto(?int $id_photo): void {
		$this->id_photo = $id_photo;
	}
  private function setPhoto(?string $photo) {
		$this->photo = $photo;
	}
	public function getPhoto(): ?string {
		return $this->photo;
	}
  public function getIdUser(): ?int {
		return $this->id_user;
	}
	private function setIdUser(?int $id_user): void {
		$this->id_user = $id_user;
	}

	public function isValid(): bool {
		return (
			!is_null($this->getIdType()) &&
			!is_null($this->getIdUser())
		);
	}

	public function load(ORequest $req): void {
    $filter = $req->getFilter('Login');

		$this->setId($req->getParamInt('id'));
    $this->setIdType($req->getParamInt('idType'));
		$this->setMessage($req->getParamString('message'));
		$this->setValue($req->getParamFloat('value'));
    $this->setLocationLat($req->getParamFloat('locationLat'));
    $this->setLocationLon($req->getParamFloat('locationLon'));
    $this->setIdPhoto($req->getParamInt('idPhoto'));
    $this->setPhoto($req->getParamString('photo'));
    $this->setIdUser(array_key_exists('id', $filter) ? $filter['id'] : null);
	}
}
