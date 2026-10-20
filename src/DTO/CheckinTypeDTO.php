<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\DTO;

use Osumi\OsumiFramework\DTO\ODTO;
use Osumi\OsumiFramework\DTO\ODTOField;

class CheckinTypeDTO extends ODTO{
	#[ODTOField]
	public ?int $id = null;

	#[ODTOField(required: true)]
	public ?string $name = null;

	#[ODTOField(required: true)]
	public ?string $icon = null;

	#[ODTOField]
  public ?bool $has_message = null;

	#[ODTOField]
  public ?bool $has_value = null;

	#[ODTOField(
			required: true,
			middleware: 'Login',
			middlewareProperty: 'id'
	)]
  public ?int $id_user = null;
}
