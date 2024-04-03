<?php declare(strict_types=1);

namespace OsumiFramework\App\Model;

use OsumiFramework\OFW\DB\OModel;
use OsumiFramework\OFW\DB\OModelGroup;
use OsumiFramework\OFW\DB\OModelField;
use OsumiFramework\App\Model\Photo;

class Checkin extends OModel {
	function __construct() {
		$model = new OModelGroup(
			new OModelField(
				name: 'id',
				type: OMODEL_PK,
				comment: 'Id único del checkin'
			),
			new OModelField(
				name: 'id_user',
				type: OMODEL_NUM,
				comment: 'Id del usuario',
				nullable: false,
				ref: 'user.id'
			),
			new OModelField(
				name: 'id_type',
				type: OMODEL_NUM,
				comment: 'Id del tipo de checkin',
				nullable: false,
				ref: 'checkin_type.id'
			),
			new OModelField(
				name: 'message',
				type: OMODEL_LONGTEXT,
				comment: 'Mensaje del checkin',
				nullable: true
			),
			new OModelField(
				name: 'value',
				type: OMODEL_FLOAT,
				comment: 'Valor del checkin',
				nullable: true
			),
			new OModelField(
				name: 'location_lat',
				type: OMODEL_FLOAT,
				comment: 'Latitud del checkin',
				nullable: true
			),
			new OModelField(
				name: 'location_lon',
				type: OMODEL_FLOAT,
				comment: 'Longitud del checkin',
				nullable: true
			),
			new OModelField(
				name: 'id_photo',
				type: OMODEL_NUM,
				comment: 'Id de la foto del checkin',
				nullable: true,
				default: null,
				ref: 'photo.id'
			),
			new OModelField(
				name: 'created_at',
				type: OMODEL_CREATED,
				comment: 'Fecha de creación del registro'
			),
			new OModelField(
				name: 'updated_at',
				type: OMODEL_UPDATED,
				comment: 'Fecha de última modificación del registro'
			)
		);

		parent::load($model);
	}

	/**
	 * Método para borrar un checkin y su foto asociada, si tiene
	 *
	 * @return void
	 */
	public function deleteFull(): void {
		if (!is_null($this->get('id_photo'))) {
			$p = new Photo();
			if ($p->find(['id' => $this->get('id_photo')])) {
				$p->deleteFull();
			}
		}
		$this->delete();
	}
}
