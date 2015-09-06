<?php
/**
 * Created by PhpStorm.
 * User: project
 * Date: 03/09/15
 * Time: 8:25
 */

class QueryParser
{

    public function parseQuery($tableName, $tableData)
    {
        $query = "";
        $query .= "CREATE TABLE IF NOT EXISTS ".$tableName;
        $query .= "(";
        foreach($tableData as $ignore => $data)
        {
            $query .= $data['fieldName'] . " " . $data['dataType'] . "" . (in_array(strtolower($data['dataType']),
                    array("int")) ? "(" . $data['dataLength'] . ")" : "") . ", ";
        }
        $query = rtrim($query, ", ");
        $query .= ");";
        return $query;
    }
}