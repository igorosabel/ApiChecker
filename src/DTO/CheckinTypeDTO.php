<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\DTO;

use Osumi\OsumiFramework\Core\ODTO;
use Osumi\OsumiFramework\Web\ORequest;

class CheckinTypeDTO implements ODTO{
	public ?int $id           = null;
	public ?string $name      = null;
	public ?string $icon      = null;
  public ?bool $has_message = null;
  public ?bool $has_value   = null;
  public ?int $id_user      = null;

	public function isValid(): bool {
		return (
      !is_null($this->name) &&
      !is_null($this->icon) &&
      !is_null($this->id_user)
    );
	}

	public function load(ORequest $req): void {
    $filter = $req->getFilter('Login');

		$this->id          = $req->getParamInt('id');
		$this->name        = $req->getParamString('name');
		$this->icon        = $req->getParamString('icon');
    $this->has_message = $req->getParamBool('hasMessage');
    $this->has_value   = $req->getParamBool('hasValue');
    $this->id_user     = array_key_exists('id', $filter) ? $filter['id'] : null;
	}
}
