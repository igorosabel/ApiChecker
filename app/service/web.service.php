<?php declare(strict_types=1);

namespace OsumiFramework\App\Service;

use OsumiFramework\OFW\Core\OService;
use OsumiFramework\OFW\DB\ODB;
use OsumiFramework\OFW\Plugins\OImage;
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

	/**
	 * Obtener la extensión de una foto en formato Base64
	 *
	 * @param string $data Imagen en formato Base64
	 *
	 * @return string Extensión de la imagen
	 */
	public function getFotoExt(string $data): string {
		$arr_data = explode(';', $data);
		$arr_data = explode(':', $arr_data[0]);
		$arr_data = explode('/', $arr_data[1]);

		return $arr_data[1];
	}

	/**
	 * Guarda una imagen en Base64 en la ubicación indicada
	 *
	 * @param string $dir Ruta en la que guardar la imagen
	 *
	 * @param string $base64_string Imagen en formato Base64
	 *
	 * @param int $id Id de la imagen
	 *
	 * @param string $ext Extensión del archivo de imagen
	 *
	 * @return string Devuelve la ruta completa a la nueva imagen
	 */
	public function saveImage(string $dir, string $base64_string, int $id, string $ext): string {
		$ruta = $dir.$id.'.'.$ext;

		if (file_exists($ruta)) {
			unlink($ruta);
		}

		$ifp = fopen($ruta, "wb");
		$data = explode(',', $base64_string);
		fwrite($ifp, base64_decode($data[1]));
		fclose($ifp);

		return $ruta;
	}

	/**
	 * Guarda una imagen en Base64 para un checkin. Si no tiene formato WebP se convierte
	 *
	 * @param string $base64_string Imagen en formato Base64
	 *
	 * @param int $id Id de la imagen
	 *
	 * @return void
	 */
	public function savePhoto(string $base64_string, int $id): void {
		$ext = $this->getFotoExt($base64_string);
		$ruta = $this->saveImage($this->getConfig()->getDir('ofw_tmp'), $base64_string, $id, $ext);
		$im = new OImage();
		$im->load($ruta);

		// Compruebo tamaño inicial
		if ($im->getWidth() > 1000) {
			$im->resizeToWidth(1000);
			$im->save($ruta, $im->getImageType());
		}

		// Guardo la imagen ya modificada como WebP
		$im->save($this->getConfig()->getExtra('photos').$id.'.webp', IMAGETYPE_WEBP);

		// Borro la imagen temporal
		unlink($ruta);
	}
}
