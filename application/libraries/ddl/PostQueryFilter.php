<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: project
 * Date: 06/09/15
 * Time: 12:25
 */
class PostQueryFilter
{
    public function validity($tableName, $tableData)
    {
        //log_message("ERROR", var_export($tableData, true));
        if(isset($tableName) && (!PostQueryFilter::isEmptyString($tableName)))
        {
            if(isset($tableData))
            {
                foreach($tableData as $key => $value)
                {
                    if(PostQueryFilter::needDataLength(strtolower($value['dataType'])))
                    {
                        if(!isset($value['dataLength']))
                        {
                            return array(false, "Field ".$value['fieldName']." with data type ".$value['dataType']." need data type length.");
                        }
                    }
                }
                return array(true, "");
            }
            else
            {
                return array(false, "Each table consist at least one data field");
            }
        }
        else
        {
            return array(false, "You must specify the table name");
        }
    }

    public function isEmptyString($value)
    {
        return $value == "" ? true : false;
    }

    public function needDataLength($dataType)
    {
        if(in_array($dataType, array("int")))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}