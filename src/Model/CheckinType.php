<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Model;

use Osumi\OsumiFramework\ORM\OModel;
use Osumi\OsumiFramework\ORM\OPK;
use Osumi\OsumiFramework\ORM\OField;
use Osumi\OsumiFramework\ORM\OCreatedAt;
use Osumi\OsumiFramework\ORM\OUpdatedAt;
use Osumi\OsumiFramework\ORM\ODB;
use Osumi\OsumiFramework\App\Model\Checkin;

class CheckinType extends OModel {
	#[OPK(
	  comment: 'Id único del tipo de checkin'
	)]
	public ?int $id;

	#[OField(
	  comment: 'Id del usuario',
	  nullable: false,
	  ref: 'user.id'
	)]
	public ?int $id_user;

	#[OField(
	  comment: 'Nombre del tipo de checkin',
	  nullable: false,
	  max: 50
	)]
	public ?string $name;

	#[OField(
	  comment: 'Icono del tipo de checkin',
	  nullable: false,
	  max: 50
	)]
	public ?string $icon;

	#[OField(
	  comment: 'Indica si el checkin debe tener mensaje 1 o no 0',
	  nullable: false,
	  default: false
	)]
	public ?bool $has_message;

	#[OField(
	  comment: 'Indica si el checkin debe tener valor 1 o no 0',
	  nullable: false,
	  default: false
	)]
	public ?bool $has_value;

	#[OField(
	  comment: 'Número de veces que se ha usado',
	  nullable: false
	)]
	public ?int $num;

	#[OField(
	  comment: 'Última vez que se ha usado el tipo de checkin',
	  nullable: true,
	  default: null,
	  type: OField::DATE
	)]
	public ?string $last_used;

	#[OCreatedAt(
	  comment: 'Fecha de creación del registro'
	)]
	public ?string $created_at;

	#[OUpdatedAt(
	  comment: 'Fecha de última modificación del registro'
	)]
	public ?string $updated_at;

	/**
	 * Listado de checkins de un tipo
	 */
	private array | null $checkins = null;

	/**
	 * Guarda el listado de checkins que tiene un tipo
	 *
	 * @param array $list Listado de checkins
	 *
	 * @return void
	 */
	public function setCheckins(array $list): void {
		$this->checkins = $list;
	}

	/**
	 * Obtiene el listado de checkins que tiene un tipo
	 *
	 * @return array Listado de checkins
	 */
	public function getCheckins(): array {
		if (is_null($this->checkins)) {
			$this->loadCheckins();
		}
		return $this->checkins;
	}

	/**
	 * Carga el listado de checkins que tiene un tipo
	 *
	 * @return void
	 */
	public function loadCheckins(): void {
		$db = new ODB();
		$sql = "SELECT * FROM `checkin` WHERE `id_type` = ? ORDER BY `created_at` DESC";

		$list = [];
		$db->query($sql, [$this->id]);

		while ($res = $db->next()) {
			$c = Checkin::from($res);

			$list[] = $c;
		}

		$this->setCheckins($list);
	}
}
