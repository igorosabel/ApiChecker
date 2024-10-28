<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\DTO;

use Osumi\OsumiFramework\Core\ODTO;
use Osumi\OsumiFramework\Web\ORequest;

class CheckinDTO implements ODTO{
	public ?int $id             = null;
  public ?int $id_type        = null;
	public ?string $message     = null;
	public ?float $value        = null;
  public ?float $location_lat = null;
  public ?float $location_lon = null;
  public ?int $id_photo       = null;
  public ?string $photo       = null;
	public ?int $id_user        = null;

	public function isValid(): bool {
		return (
			!is_null($this->id_type) &&
			!is_null($this->id_user)
		);
	}

	public function load(ORequest $req): void {
    $filter = $req->getFilter('Login');

		$this->id           = $req->getParamInt('id');
    $this->id_type      = $req->getParamInt('idType');
		$this->message      = $req->getParamString('message');
		$this->value        = $req->getParamFloat('value');
    $this->location_lat = $req->getParamFloat('locationLat');
    $this->location_lon = $req->getParamFloat('locationLon');
    $this->id_photo     = $req->getParamInt('idPhoto');
    $this->photo        = $req->getParamString('photo');
    $this->id_user      = array_key_exists('id', $filter) ? $filter['id'] : null;
	}
}
