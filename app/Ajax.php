<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 22/03/2016
 * @Time    : 14:18
 * @File    : Ajax.php
 * @Version : 1.0
 * @LastUpdate  : 23/03/2016 à 16:44
 */

session_start();

define('ROOT', dirname(__DIR__));
require ROOT . '/core/Debug/ref.php';
require ROOT . '/app/App.php';

App::load();
$app = App::getInstance();

$query = $app->getDb();

function logs($logs){
	global $query;
	$query->query("INSERT INTO users_logs (user_id, `identity`, `date`, `action`) VALUES ('{$_SESSION['user_id']}','{$_SESSION['identity']}', '".time()."', '{$logs}')");
}

if ($_GET):
	if ($_GET['type'] == "antenna_name") {
		$prep = $query->prepare("SELECT * FROM ml_structures WHERE antenna_name LIKE :term LIMIT 0,10", ['term' => '%' . $_GET['term'] . '%']);

		$array = [];

		foreach ($prep as $data) {
			array_push($array, $data->antenna_name);
		}

		echo json_encode($array, JSON_FORCE_OBJECT);
	}

	if ($_GET['type'] == "postal_code") {
		$prep = $query->prepare("SELECT * FROM towns WHERE postal LIKE :term GROUP BY postal LIMIT 0,10", ['term' => $_GET['term'] . '%']);

		$array = [];

		foreach ($prep as $data) {
			array_push($array, $data->postal);
		}

		echo json_encode($array, JSON_FORCE_OBJECT);
	}

	if ($_GET['type'] == "town") {
		$prep = $query->prepare("SELECT * FROM towns WHERE `name` LIKE :term GROUP BY `name` LIMIT 0,10", ['term' => $_GET['term'] . '%']);

		$array = [];

		foreach ($prep as $data) {
			array_push($array, $data->name);
		}

		echo json_encode($array, JSON_FORCE_OBJECT);
	}

endif;
if ($_POST):

	if (!empty($_POST['type'])):
		if (($_POST['type'] == "all") AND ($_POST['name'])) {
			$prep = $query->prepare("SELECT * FROM ml_structures WHERE antenna_name = :term", [':term' => $_POST['name']]);

			$array['code'] = $prep[0]->structure_code;
			$array['name'] = $prep[0]->structure_name;
			$array['department'] = $prep[0]->department;

			echo json_encode($array, JSON_FORCE_OBJECT);
		}
	endif;
	if (!empty($_POST['action'])):
		if ($_POST['action'] == "getAntennaForYouth") {
			$prep = $query->prepare("SELECT * FROM ml_structures WHERE department = :term", [':term' => $_SESSION['department']]);
			$array['list'] = [];

			foreach ($prep as $data) {
				array_push($array['list'], $data->antenna_name);
			}

			$array['session'] = $_SESSION['antenna'];

			echo json_encode($array, JSON_FORCE_OBJECT);
		}

		if (($_POST['action'] == "getCounselorForYouth") AND ($_POST['antenna'])) {
			$prep = $query->prepare("SELECT * FROM users_staff WHERE antenna_name = :term", [':term' => $_POST['antenna']]);
			$array['list'] = [];

			foreach ($prep as $data) {
				array_push($array['list'], $data->identity);
			}

			$array['session'] = $_SESSION['identity'];

			echo json_encode($array, JSON_FORCE_OBJECT);
		}

		if (($_POST['action'] == "getCounselorPhone") AND $_POST['counselor']) {
			$prep = $query->prepare("SELECT * FROM users_staff WHERE `identity` = :term", [':term' => $_POST['counselor']]);
			$array = [];

			$array['phone'] = $prep[0]->phone_number;

			echo json_encode($array, JSON_FORCE_OBJECT);
		}

		if (($_POST['action'] == "getTown") AND ($_POST['code'])) {
			$prep = $query->prepare("SELECT * FROM towns WHERE postal = :term GROUP BY `name` ASC ", [':term' => $_POST['code']]);
			$array = [];

			foreach ($prep as $data) {
				array_push($array, $data->name);
			}

			echo json_encode($array, JSON_FORCE_OBJECT);
		}
		if (($_POST['action'] == "getPostalCode") AND ($_POST['town'])) {
			$prep = $query->prepare("SELECT * FROM towns WHERE name = :term GROUP BY `name` ASC ", [':term' => $_POST['town']]);

			$array['code'] = $prep[0]->postal;

			echo json_encode($array, JSON_FORCE_OBJECT);
		}

		if ($_POST['action'] == "verifDataYouth" AND $_POST['row'] AND $_POST['value']) {

			$prep = $query->query("SELECT * FROM youth_folder WHERE {$_POST['row']} = '{$_POST['value']}'", null, false, true);

			$array['result'] = (!$prep) ? "ok" : "error";

			echo json_encode($array, JSON_FORCE_OBJECT);
		}

		if ($_POST['action'] == "getNumRowFolders") {
			if ($_SESSION['rank'] != "Prescripteur") {
				$array['num'] = $query->query("SELECT  * FROM youth_folder WHERE attachment_antenna = '{$_SESSION['antenna']}' AND validation = 'P' AND process = 'V'", null, true);
				echo json_encode($array, JSON_FORCE_OBJECT);
			}
		}

		if ($_POST['action'] == "readAlert" AND $_POST['id']) {
			$alert = $query->query("SELECT  * FROM alerts WHERE id = '{$_POST['id']}' AND `to` = '{$_SESSION['user_id']}'");

			if ($alert) {
				$update = $query->query("UPDATE alerts SET `read` = 'Y' WHERE id = '{$_POST['id']}' AND `to` = '{$_SESSION['user_id']}'");
				if ($update) {
					$array['done'] = "ok";
				} else {
					$array['done'] = "errorUpdate";
				}
			} else {
				$array['done'] = "error";
			}
			echo json_encode($array, JSON_FORCE_OBJECT);
		}

		if ($_POST['action'] == "updateBug" AND $_POST['update'] AND $_POST['id']) {

			$update = $query->query("UPDATE bugs SET `status` = '{$_POST['update']}' WHERE id = '{$_POST['id']}'");
			if ($update) {
				$array['done'] = "ok";
			} else {
				$array['done'] = "errorUpdate";
			}

			echo json_encode($array, JSON_FORCE_OBJECT);
		}

		if ($_POST['action'] == "getLogoutImages") {
			if (!empty($_POST['department'])) {
				$images = $query->query("SELECT * FROM ml_structures WHERE department = '{$_POST['department']}'", null, false, true);
				$array['logo'] = $images->logo;
				$array['background'] = $images->background;
			} else {
				$array['logo'] = "none";
				$array['background'] = "app/ml/background/HP.jpg";
			}

			echo json_encode($array, JSON_FORCE_OBJECT);
		}

		if ($_POST['action'] == "convertTime") {
			echo json_encode(date('d/m/Y', $_POST['time']), JSON_FORCE_OBJECT);
		}

		if ($_POST['action'] == "validateFolder" AND $_POST['p'] AND $_POST['id'] AND $_POST['r'] AND $_POST['j'] AND $_POST['j_id'] AND $_POST['motif'] AND $_POST['date'] AND $_POST['lieu']) {
			$return = $query->query("UPDATE youth_folder SET validation='{$_POST['p']}' WHERE i_milo_folder_id = '{$_POST['id']}'");
			$return = $query->query("UPDATE youth_folder SET validator_motif='".addslashes($_POST['motif'])."' WHERE i_milo_folder_id = '{$_POST['id']}'");
			$return = $query->query("UPDATE youth_folder SET commission_date='".strtotime(str_replace('/', '-', $_POST['date']))."' WHERE i_milo_folder_id = '{$_POST['id']}'");
			$return = $query->query("UPDATE youth_folder SET commission_lieu='".addslashes($_POST['lieu'])."' WHERE i_milo_folder_id = '{$_POST['id']}'");
			$counselor = $query->query("SELECT * FROM users_staff WHERE `identity` = '{$_POST['r']}'");

			switch ($_POST['p']) {
			case "P":
				$type = "warning";
				$title = "Attention : Dossier incomplet";
				$message = "Le dossier de <b>{$_POST['j']}</b> est jugé incomplet par le validateur. Rendez-vous <a href=\"/youth/manage/{$_POST['j_id']}\">ici</a> pour compléter ce dossier. Le motif du validateur sera affiché dans un bandeau.";
				$decision = "incomplet";
				break;
			case "R":
				$type = "danger";
				$title = "Erreur : Refus de dossier";
				$message = "Le dossier de <b>{$_POST['j']}</b> vient d\'être refusé par le validateur. Rendez-vous <a href=\"/youth/refused/{$_POST['j_id']}\">ici</a> avoir les informations de ce refus.";
				$decision = "refusé";
				break;
			Case "V":
				$return = $query->query("UPDATE youth_folder SET process='C' WHERE i_milo_folder_id = '{$_POST['id']}'");
				$type = "success";
				$title = "Information : Dossier validé!";
				$message = "Le dossier de <b>{$_POST['j']}</b> vient d\'être envoyé en pré commission/commision. Rendez-vous <a href=\"/youth/accepted/{$_POST['j_id']}\">ici</a> pour suivre l\'état du dossier.";
				$decision = "accepté";
				break;
			}
			$alert_id = uniqid("_a-");
			$return = $query->query("INSERT INTO alerts (id, `to`, `type`, title, alert) VALUES ('{$alert_id}','{$counselor[0]->user_id}', '{$type}', '{$title}', '{$message}' )");
			logs("Prise de décision sur un dossier (dossier de {$_POST['j']} $decision : ".addslashes($_POST['motif']).").");

			$data = ($return) ? "ok" : "error";

			echo json_encode($data, JSON_FORCE_OBJECT);
		}

	endif;
endif;