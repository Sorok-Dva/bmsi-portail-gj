<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 07/04/2016
 * @Time    : 09:28
 * @File    : BugTable.php
 * @Version : 1.0
 * @LastUpdate  : 07/04/2016 à 09:28
 */

namespace App\Table;

use \Core\Table\Table;

class BugTable extends Table
{

    public function getBugs(){
        return $this->query("SELECT * FROM {$this->table} ORDER BY date desc ");
    }
}