<?php declare(strict_types=1);

namespace OsumiFramework\App\Service;

use OsumiFramework\OFW\Core\OService;
use OsumiFramework\OFW\DB\ODB;
use OsumiFramework\App\DTO\CheckinsDTO;
use OsumiFramework\App\Model\CheckinType;
use OsumiFramework\App\Model\Checkin;

class webService extends OService {
	function __construct() {
		$this->loadService();
	}

	/**
	 * Obtiene la lista de tipos de checkin de un usuario
	 *
	 * @param int $id_user Id del usuario del que obtener la lista
	 *
	 * @return array Lista de tipos de checkin
	 */
	public function getUserCheckinTypes(int $id_user): array {
		$db = new ODB();
		$sql = "SELECT * FROM `checkin_type` WHERE `id_user` = ? ORDER BY `num` DESC";

		$ret = [];
		$db->query($sql, [$id_user]);

		while ($res=$db->next()) {
			$ct = new CheckinType();
			$ct->update($res);

			array_push($ret, $ct);
		}

		return $ret;
	}

	/**
	 * Método para obtener el listado de checkins de un usuario
	 *
	 * @param CheckinsDTO $data Filtros para obtener los checkin
	 *
	 * @return array Listado de checkins
	 */
	public function getUserCheckins(CheckinsDTO $data): array {
		$db = new ODB();
		$params = [$data->getIdUser()];
		$sql = "SELECT * FROM `checkin` WHERE `id_user` = ?";
		if (!is_null($data->getIdType())) {
			$sql .= " AND `id_type` = ?";
			array_push($params, $data->getIdType());
		}
		if (!is_null($data->getStart()) && !is_null($data->getEnd())) {
			$sql .= " AND `created_at` BETWEEN ? AND ?";
			array_push($params, $data->getStart(), $data->getEnd());
		}
		$sql .= " ORDER BY `created_at` DESC";

		$ret = [];
		$db->query($sql, $params);

		while ($res=$db->next()) {
			$c = new Checkin();
			$c->update($res);

			array_push($ret, $c);
		}

		return $ret;
	}

	/**
	 * Método para borrar un tipo de checkin y todos sus checkins asociados
	 *
	 * @param CheckinType $ct Tipo de checkin a borrar
	 *
	 * @return void
	 */
	public function deleteCheckinType(CheckinType $ct): void {
		$checkins = $ct->getCheckins();

		foreach ($checkins as $c) {
			$c->deleteFull();
		}

		$ct->delete();
	}
}
