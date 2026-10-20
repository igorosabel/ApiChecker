<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\DTO;

use Osumi\OsumiFramework\DTO\ODTO;
use Osumi\OsumiFramework\DTO\ODTOField;

class RegisterDTO extends ODTO{
	#[ODTOField(required: true)]
	public ?string $name  = null;

	#[ODTOField(required: true)]
	public ?string $email = null;

	#[ODTOField(required: true)]
	public ?string $pass  = null;

	#[ODTOField(required: true)]
  public ?string $conf  = null;
}
