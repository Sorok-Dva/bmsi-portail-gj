<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 21/03/2016
 * @Time    : 15:30
 * @File    : StaffTable.php
 * @Version : 1.0
 * @LastUpdate  :
 */

namespace App\Table;

use \Core\Table\Table;

class StaffTable extends Table
{

    protected $table = "users_staff";

    public function checkData($type, $data)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE {$type} = '{$data}'");
    }

    public function checkPassword($password)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE password = '{$password}'");
    }
}