<?php
/**
 * Created by PhpStorm.
 * User: project
 * Date: 31/08/15
 * Time: 14:27
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ddl extends CI_Model
{


    public function install($name, $constrain, $primaryKey = null, $foreignKey = null)
    {
        $query = "CREATE OR REPLACE TABLE $name";
        $query .= "( ";
        foreach($constrain as $key => $value)
        {
            $query .= $key . "";
        }
        $query .= " );";
    }

    public function create($query)
    {
        if($this->db->query($query))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}