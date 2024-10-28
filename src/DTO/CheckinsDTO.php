<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\DTO;

use Osumi\OsumiFramework\Core\ODTO;
use Osumi\OsumiFramework\Web\ORequest;

class CheckinsDTO implements ODTO{
	public ?int $id_type  = null;
	public ?string $start = null;
	public ?string $end   = null;
	public ?int $page     = null;
  public ?int $id_user  = null;

	public function isValid(): bool {
		return (
			!is_null($this->page) &&
			!is_null($this->id_user)
		);
	}

	public function load(ORequest $req): void {
    $filter = $req->getFilter('Login');

		$this->id_type = $req->getParamInt('idType');
		$this->start   = $req->getParamString('start');
		$this->end     = $req->getParamString('end');
		$this->page    = $req->getParamInt('page');
    $this->id_user = array_key_exists('id', $filter) ? $filter['id'] : null;
	}
}
