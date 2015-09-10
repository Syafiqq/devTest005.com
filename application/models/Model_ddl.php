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

    public function reCreate($query, $tableName)
    {
        $this->db->trans_start();
        {
            $this->db->query('DROP TABLE '.$tableName);
            $this->db->query($query);
        }
        $this->db->trans_complete();

        return true;
    }

    public function deleteTable($tableName)
    {
        return $this->db->query('DROP TABLE '.$tableName);
    }

    public function checkTable($tableName)
    {
        return $this->db->query('SELECT count(TABLE_NAME) AS \'count\' FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = database() AND TABLE_NAME = \''.$tableName.'\' LIMIT 1;')->result_array()[0]['count'];
    }

    public function getTableDescription($tableName)
    {
        return $this->db->query('DESCRIBE '.$tableName)->result_array();
    }

    public function filterTableDescription($tableField)
    {
        foreach($tableField as $key => $field)
        {
            $field = $this->removeUnnessesaryField($field);
            $field = $this->separateTypeField($field);
            $tableField[$key] = $field;
        }

        return $tableField;
    }

    private function removeUnnessesaryField($field)
    {
        unset($field['Null']);
        unset($field['Key']);
        unset($field['Default']);
        unset($field['Extra']);
        return $field;
    }

    private function separateTypeField($field)
    {
        $field['Type'] =  explode("(" , rtrim($field['Type'], ")"));
        if(count($field['Type']) > 1)
        {
            $field['Length'] = $field['Type'][1];
        }
        $field['Type'] = $field['Type'][0];
        return $field;
    }


}