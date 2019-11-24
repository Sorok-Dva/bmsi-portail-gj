<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 21/03/2016
 * @Time    : 09:15
 * @File    : Table.php
 * @Version : 1.0
 * @LastUpdate  : 22/03/2016 à 11:09
 *
 * Information : La table est automatiquement récupérer selon le controleur dans lequel la function est executée
 */

namespace Core\Table;

use Core\Database\Database;

/**
 * Class Table
 * @package Core\Table
 * @return Table
 */
class Table {

	protected $table;
	protected $db;
	protected $u_id;

	public function __construct(Database $db) {
		$this->db = $db;

		if (!empty($_SESSION)) {
			$this->u_id = $_SESSION['user_id'];
		}

		if (is_null($this->table)) {
			$parse = explode('\\', get_class($this));
			$class_name = end($parse);
			$this->table = strtolower(str_replace('Table', '', $class_name)) . 's';
		}
	}

	/**
	 * @param $id int Récupère une ligne précise
	 * @return mixed
	 *
	 * @UsageExemple :
	 *      $this->find($id) | $this->find(1098);
	 */
	public function find($id) {
		return $this->query("SELECT * FROM {$this->table}  WHERE youth_id = ? ", [$id], false, true);
	}

	/**
	 * @param $id int Récupère une ligne précise (un dossier précisement)
	 * @return mixed
	 *
	 * @UsageExemple :
	 *      $this->find($id_dossier) | $this->find(4071);
	 */
	public function findFolder($id) {
		return $this->query("SELECT * FROM {$this->table}  WHERE i_milo_folder_id = ? OR youth_id = ? ", [$id, $id], false, true);
	}

	/**
	 * Récupère les informations d'un user
	 * @param $id
	 * @return mixed
	 *
	 * @UsageExample :
	 *      $this->getUser($id); | $this->getUser("uid1098");
	 */
	public function getUser($id) {
		return $this->query("SELECT *  FROM {$this->table}  WHERE user_id = ? ", [$id], false, true);
	}

	/**
	 * Récupère toutes les données d'une table
	 * @return mixed
	 *
	 * @UsageExample :
	 *      $this->all();
	 */
	public function all() {
		return $this->query("SELECT * FROM {$this->table} ORDER BY id ");
	}

	/**
	 * Supprime les données du statement
	 * @param $id
	 * @return mixed
	 *
	 * @UsageExample :
	 *      $this->delete($id); | $this->delete(1098);
	 */
	public function delete($id) {
		return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id], false, true);
	}

	/**
	 * Modifie les données du statement
	 * @param $id int Permet de savoir quelle ligne on modifie
	 * @param $fields array Les champs pour concernés par l'update
	 * @param $where string Le nom du champ qu'il faut modifier
	 * @return mixed
	 *
	 * @UsageExample :
	 *      $this->update($id, $where, [$fields]);
	 *      $this->update(1098, "id", [ 'column' => 'data' ]);
	 *      $this->update(1098, "user_id', [ 'id' => '100798', 'timestamp' => '149875425' ]);
	 */
	public function update($id, $where, $fields) {
		$sql_parts = [];
		$attributes = [];

		foreach ($fields as $k => $v) {
			$sql_parts[] = "$k = ?";
			$attributes[] = $v;
		}
		$attributes[] = $id;
		$sql_part = implode(', ', $sql_parts);

		return $this->query("UPDATE {$this->table} SET $sql_part WHERE $where = ?", $attributes, true);
	}

	/**
	 * Créer une ligne de données
	 * @param $fields array $key.$value des données à insérées
	 * @return mixed
	 *
	 * @UsageExample :
	 *      $this->create($fields);
	 *      $this->create( [ 'id' => '1098' ]);
	 *      $this->create( [ 'id' => '1098', 'timestamp' => '149875425', 'otherData' => 'Adata'] );
	 */
	public function create($fields) {
		$sql_parts = [];
		$attributes = [];

		foreach ($fields as $k => $v) {
			$sql_parts[] = "`$k` = ?";
			$attributes[] = $v;
		}
		$sql_part = implode(', ', $sql_parts);
		return $this->query("INSERT INTO {$this->table} SET $sql_part", $attributes, true);
	}

	/**
	 * Execute une requête complexe avec plusieurs clause
	 * @param $statement string Requête à executée
	 * @param null $attributes string Attributs si c'est une requête préparée
	 * @param bool $count Si on veut faire un rowCount sur l'objet
	 * @param bool|false $one Si l'on décide de récupérer toute les données ou qu'une seule
	 * @return mixed
	 */
	public function query($statement, $attributes = null, $count = false, $one = false) {
		if ($attributes) {
			return $this->db->prepare(
				$statement,
				$attributes,
				null,
				$one
			);
		} else {
			if ($count) {
				return $this->db->query(
					$statement,
					null,
					$count
				);
			} else {
				return $this->db->query(
					$statement,
					null,
					$one
				);
			}

		}
	}
}