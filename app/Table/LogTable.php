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

class LogTable extends Table
{

    protected $table = "users_logs";

    public function log($log, $important = "N"){
        return $this->create([
            'user_id' => $_SESSION['user_id'],
            'identity' => $_SESSION['identity'],
            'date' => time(),
            'action' => $log,
            'important' => $important,
        ]);
    }

}