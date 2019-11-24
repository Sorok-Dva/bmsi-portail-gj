<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 21/03/2016
 * @Time    : 11:16
 * @File    : UsersController.php
 * @Version : 1.0
 * @LastUpdate  :
 */

namespace App\Controller;

use App;
use App\Controller;
use App\Table;

class StructuresController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel("Structures");
    }

    public function add()
    {
        /*$structures = array (
            "1"  => array (
                "INSEE_area_code" => "73",
                "area" => "Midi-Pyrénées",
                "INSEE_department_code" => "09",
                "department" => "Ariège",
                "structure_code" => "09122",
                "structure_name" => "09 - Mission Locale Ariège",
                "antenna_code" => "A01",
                "antenna_name" => "ML LAVELANET",
                "type" => "ANTENNE"
            ),
            "2"  => array (
                "INSEE_area_code" => "73",
                "area" => "Midi-Pyrénées",
                "INSEE_department_code" => "09",
                "department" => "Ariège",
                "structure_code" => "09122",
                "structure_name" => "09 - Mission Locale Ariège",
                "antenna_code" => "A02",
                "antenna_name" => "ML PAMIERS",
                "type" => "ANTENNE"
            ),
            "3"  => array (
                "INSEE_area_code" => "73",
                "area" => "Midi-Pyrénées",
                "INSEE_department_code" => "09",
                "department" => "Ariège",
                "structure_code" => "09122",
                "structure_name" => "09 - Mission Locale Ariège",
                "antenna_code" => "A03",
                "antenna_name" => "ML FOIX",
                "type" => "ANTENNE"
            ),
            "4"  => array (
                "INSEE_area_code" => "73",
                "area" => "Midi-Pyrénées",
                "INSEE_department_code" => "09",
                "department" => "Ariège",
                "structure_code" => "09122",
                "structure_name" => "09 - Mission Locale Ariège",
                "antenna_code" => "A04",
                "antenna_name" => "ML SAINT GIRONS",
                "type" => "ANTENNE"
            ),

            "5"  => array (
                "INSEE_area_code" => "73",
                "area" => "Midi-Pyrénées",
                "INSEE_department_code" => "12",
                "department" => "Aveyron",
                "structure_code" => "12145",
                "structure_name" => "12 - Mission Locale Aveyron",
                "antenna_code" => "A01",
                "antenna_name" => "MILLAU",
                "type" => "ANTENNE"
            ),
            "6"  => array (
                "INSEE_area_code" => "73",
                "area" => "Midi-Pyrénées",
                "INSEE_department_code" => "12",
                "department" => "Aveyron",
                "structure_code" => "12145",
                "structure_name" => "12 - Mission Locale Aveyron",
                "antenna_code" => "A02",
                "antenna_name" => "RODEZ",
                "type" => "ANTENNE"
            ),
            "7"  => array (
                "INSEE_area_code" => "73",
                "area" => "Midi-Pyrénées",
                "INSEE_department_code" => "12",
                "department" => "Aveyron",
                "structure_code" => "12145",
                "structure_name" => "12 - Mission Locale Aveyron",
                "antenna_code" => "A03",
                "antenna_name" => "DECAZEVILLE",
                "type" => "ANTENNE"
            ),
            "8"  => array (
                "INSEE_area_code" => "73",
                "area" => "Midi-Pyrénées",
                "INSEE_department_code" => "12",
                "department" => "Aveyron",
                "structure_code" => "12145",
                "structure_name" => "12 - Mission Locale Aveyron",
                "antenna_code" => "A04",
                "antenna_name" => "SAINT AFFRIQUE",
                "type" => "ANTENNE"
            ),
            "9"  => array (
                "INSEE_area_code" => "73",
                "area" => "Midi-Pyrénées",
                "INSEE_department_code" => "12",
                "department" => "Aveyron",
                "structure_code" => "12145",
                "structure_name" => "12 - Mission Locale Aveyron",
                "antenna_code" => "A05",
                "antenna_name" => "SEVERAC",
                "type" => "ANTENNE"
            ),
            "10"  => array (
                "INSEE_area_code" => "73",
                "area" => "Midi-Pyrénées",
                "INSEE_department_code" => "12",
                "department" => "Aveyron",
                "structure_code" => "12145",
                "structure_name" => "12 - Mission Locale Aveyron",
                "antenna_code" => "A06",
                "antenna_name" => "VILLEFRANCHE",
                "type" => "ANTENNE"
            )
        );

        $i_a = 1;

        foreach ($structures as $struc){
            var_dump($structures[$i_a]);
            $req = $this->Structures->create($structures[$i_a]);
            var_dump($req);
            $i_a++;
        }*/
//        $this->render("index.home");
    }
}