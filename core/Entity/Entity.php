<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 21/03/2016
 * @Time    : 09:14
 * @File    : Entity.php
 * @Version : 1.0
 * @LastUpdate  :
 */

namespace Core\Entity;

class Entity
{

    /**
     * @param $key string Est une fonction magique
     * @return mixed
     */
    public function __get($key)
    {
        $method = 'get' . ucfirst($key);
        $this->key = $this->$method();
        return $this->key;
    }

}