<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 15/07/2015
 * @Time    : 23:33
 * @File    : text.php
 * @Version : 1.0
 */

/**
 * Class Text
 */
class Text
{
    const SUFFIX = " �";
    /**
     * @var string
     */
    private static $suffix = " �";

    /**
     * @param $chiffre int
     * @return string
     */
    public static function PublicWithZero($chiffre)
    {
        return self::WithZero($chiffre);
    }

    /**
     * @param $chiffre int Ajoute un 0 au d�but si le chiffre est inf�rieur � 10
     * @return string
     */
    public static function WithZero($chiffre)
    {
        if ($chiffre < 10) {
            return '0' . $chiffre . self::SUFFIX;
        } else {
            return $chiffre . self::SUFFIX;
        }
    }
}