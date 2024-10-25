<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Model;

use Osumi\OsumiFramework\ORM\OModel;
use Osumi\OsumiFramework\ORM\OPK;
use Osumi\OsumiFramework\ORM\OField;
use Osumi\OsumiFramework\ORM\OCreatedAt;
use Osumi\OsumiFramework\ORM\OUpdatedAt;
use Osumi\OsumiFramework\App\Model\Photo;
use Osumi\OsumiFramework\App\Model\CheckinType;

class Checkin extends OModel {
	#[OPK(
	  comment: 'Id único del checkin'
	)]
	public ?int $id;

	#[OField(
	  comment: 'Id del usuario',
	  nullable: false,
	  ref: 'user.id'
	)]
	public ?int $id_user;

	#[OField(
	  comment: 'Id del tipo de checkin',
	  nullable: false,
	  ref: 'checkin_type.id'
	)]
	public ?int $id_type;

	#[OField(
	  comment: 'Mensaje del checkin',
	  nullable: true,
	  type: OField::LONGTEXT
	)]
	public ?string $message;

	#[OField(
	  comment: 'Valor del checkin',
	  nullable: true
	)]
	public ?float $value;

	#[OField(
	  comment: 'Latitud del checkin',
	  nullable: true
	)]
	public ?string $location_lat;

	#[OField(
	  comment: 'Longitud del checkin',
	  nullable: true
	)]
	public ?string $location_lon;

	#[OField(
	  comment: 'Id de la foto del checkin',
	  nullable: true,
	  ref: 'photo.id',
	  default: null
	)]
	public ?int $id_photo;

	#[OCreatedAt(
	  comment: 'Fecha de creación del registro'
	)]
	public ?string $created_at;

	#[OUpdatedAt(
	  comment: 'Fecha de última modificación del registro'
	)]
	public ?string $updated_at;

	/**
	 * Tipo de checkin
	 */
	private CheckinType | null $ct = null;

	/**
	 * Guarda el tipo de un checkin
	 *
	 * @param CheckinType $ct Tipo de checkin
	 *
	 * @return void
	 */
	public function setCheckinType(CheckinType $ct): void {
		$this->ct = $ct;
	}

	/**
	 * Obtiene el tipo de un checkin
	 *
	 * @return CheckinType Tipo de un checkin
	 */
	public function getCheckinType(): CheckinType {
		if (is_null($this->ct)) {
			$this->loadCheckinType();
		}
		return $this->ct;
	}

	/**
	 * Carga el tipo de un checkin
	 *
	 * @return void
	 */
	public function loadCheckinType(): void {
		$ct = CheckinType::findOne(['id' => $this->id_type]);
		$this->setCheckinType($ct);
	}

	/**
	 * Método para borrar un checkin y su foto asociada, si tiene
	 *
	 * @return void
	 */
	public function deleteFull(): void {
		if (!is_null($this->id_photo)) {
			$p = Photo::findOne(['id' => $this->id_photo]);
			if (!is_null($p)) {
				$p->deleteFull();
			}
		}
		$this->delete();
	}
}
