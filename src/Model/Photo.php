<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Model;

use Osumi\OsumiFramework\ORM\OModel;
use Osumi\OsumiFramework\ORM\OPK;
use Osumi\OsumiFramework\ORM\OField;
use Osumi\OsumiFramework\ORM\OCreatedAt;
use Osumi\OsumiFramework\ORM\OUpdatedAt;

class Photo extends OModel {
	#[OPK(
	  comment: 'Id único de la foto'
	)]
	public ?int $id;

	#[OField(
	  comment: 'Id del usuario',
	  nullable: false,
	  ref: 'user.id'
	)]
	public ?int $id_user;

	#[OCreatedAt(
	  comment: 'Fecha de creación del registro'
	)]
	public ?string $created_at;

	#[OUpdatedAt(
	  comment: 'Fecha de última modificación del registro'
	)]
	public ?string $updated_at;

	/**
	 * Método para borrar una foto y su archivo asociado
	 *
	 * @return void
	 */
	public function deleteFull(): void {
		global $core;
		$ruta = $core->config->getExtra('photos') . $this->id . '.webp';
		if (file_exists($ruta)){
			unlink($ruta);
		}

		$this->delete();
	}
}
