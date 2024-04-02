<?php declare(strict_types=1);

namespace OsumiFramework\App\Service;

use OsumiFramework\OFW\Core\OService;
use OsumiFramework\OFW\DB\ODB;
use OsumiFramework\App\Model\CheckinType;

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
}
