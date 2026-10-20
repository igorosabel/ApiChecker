<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\DTO;

use Osumi\OsumiFramework\DTO\ODTO;
use Osumi\OsumiFramework\DTO\ODTOField;

class CheckinDTO extends ODTO {
	#[ODTOField]
	public ?int $id = null;

	#[ODTOField(required: true)]
	public ?int $id_type = null;

	#[ODTOField]
	public ?string $message = null;

	#[ODTOField]
	public ?float $value = null;

	#[ODTOField]
  public ?float $location_lat = null;

	#[ODTOField]
  public ?float $location_lon = null;

	#[ODTOField]
  public ?int $id_photo = null;

	#[ODTOField]
  public ?string $photo = null;

	#[ODTOField(
			required: true,
			middleware: 'Login',
			middlewareProperty: 'id'
	)]
	public ?int $id_user = null;
}
