<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 23/03/2016
 * @Time    : 10:41
 * @File    : YouthTable.php
 * @Version : 1.0
 * @LastUpdate  :
 */

namespace App\Table;

use \Core\Table\Table;

class YouthTable extends Table {

	protected $table = "youth_folder";

	public function checkData($type, $data) {
		return $this->query("SELECT * FROM {$this->table} WHERE {$type} = '{$data}'");
	}

	public function getForms() {
		return $this->query("SELECT * FROM forms WHERE ml = '{$_SESSION['antenna']}'");
	}

	public function getFoldersProcessV() {
		return $this->query("SELECT `youth_id`, `civility`, `identity`, `birthday` , `birthplace_town` ,`validation` FROM {$this->table} WHERE attachment_antenna = '{$_SESSION['antenna']}' AND process = 'V' ");
	}

	public function getFoldersProcessPC() {
		return $this->query("SELECT `youth_id`, `civility`, `identity`, `birthday` , `birthplace_town` ,`validation`, `commission_date`, `commission_lieu` FROM {$this->table} WHERE attachment_antenna = '{$_SESSION['antenna']}' AND process = 'PC' ");
	}

	public function getFoldersProcessC() {
		return $this->query("SELECT `youth_id`, `civility`, `identity`, `birthday` , `birthplace_town` ,`validation`, `commission_date`, `commission_lieu` FROM {$this->table} WHERE attachment_antenna = '{$_SESSION['antenna']}' AND process = 'C' ");
	}

	public function myFolders() {
		return $this->query("SELECT * FROM {$this->table} WHERE ML_referring_in_charge = '{$_SESSION['identity']}' ");
	}

}