<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\DTO;

use Osumi\OsumiFramework\DTO\ODTO;
use Osumi\OsumiFramework\DTO\ODTOField;

class CheckinsDTO extends ODTO{
	#[ODTOField]
	public ?int $id_type = null;

	#[ODTOField]
	public ?string $start = null;

	#[ODTOField]
	public ?string $end = null;

	#[ODTOField(required: true)]
	public ?int $page = null;

	#[ODTOField(
			required: true,
			middleware: 'Login',
			middlewareProperty: 'id'
	)]
  public ?int $id_user = null;
}
