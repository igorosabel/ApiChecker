<?php declare(strict_types=1);

namespace OsumiFramework\App\Model;

use OsumiFramework\OFW\DB\OModel;
use OsumiFramework\OFW\DB\OModelGroup;
use OsumiFramework\OFW\DB\OModelField;

class CheckinType extends OModel {
	function __construct() {
		$model = new OModelGroup(
			new OModelField(
				name: 'id',
				type: OMODEL_PK,
				comment: 'Id único del tipo de checkin'
			),
			new OModelField(
				name: 'id_user',
				type: OMODEL_NUM,
				comment: 'Id del usuario',
				nullable: false,
				ref: 'user.id'
			),
			new OModelField(
				name: 'name',
				type: OMODEL_TEXT,
				comment: 'Nombre del tipo de checkin',
				nullable: false,
        size: 50
			),
			new OModelField(
				name: 'icon',
				type: OMODEL_TEXT,
				comment: 'Icono del tipo de checkin',
				nullable: false,
        size: 50
			),
			new OModelField(
				name: 'has_message',
				type: OMODEL_BOOL,
				comment: 'Indica si el checkin debe tener mensaje 1 o no 0',
				nullable: false,
				default: false
			),
			new OModelField(
				name: 'has_value',
				type: OMODEL_BOOL,
				comment: 'Indica si el checkin debe tener valor 1 o no 0',
				nullable: false,
				default: false
			),
			new OModelField(
				name: 'num',
				type: OMODEL_NUM,
				comment: 'Número de veces que se ha usado',
				nullable: false
			),
			new OModelField(
				name: 'last_used',
				type: OMODEL_DATE,
				comment: 'Última vez que se ha usado el tipo de checkin',
				nullable: false
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
}
