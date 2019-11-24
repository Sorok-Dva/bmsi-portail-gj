<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 06/04/2016
 * @Time    : 16:53
 * @File    : IndexTable.php
 * @Version : 1.0
 * @LastUpdate  : 06/04/2016 à 16:53
 */

namespace App\Table;

use \Core\Table\Table;

class IndexTable extends Table
{

    protected $table = "alerts";

    public function getAlerts()
    {
        return $this->query("SELECT * FROM {$this->table} WHERE `to` = '{$_SESSION['user_id']}' AND `read` = 'N' ORDER BY id DESC");
    }

}