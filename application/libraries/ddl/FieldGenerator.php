<?php
/**
 * Created by PhpStorm.
 * User: project
 * Date: 10/09/15
 * Time: 13:19
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class FieldGenerator
{
    private $dataType = array("INT", "DOUBLE", "TIMESTAMP");
    private $dataLength = array("INT" => 11);


    public function makeHTMLForField($tableData, $dataName = "data")
    {
        $html = "";
        foreach($tableData as $key => $data)
        {
            $crypt = $this->generateCrypt();
            $html .= '<div class="form-group" id=' . $crypt . '>';
            $html .= $this->createFieldName($dataName, $crypt, $data['Field']);
            $html .= $this->createDataTypeList($dataName, $crypt, $data['Type']);
            if (isset($data['Length']))
            {
                $html .= $this->createDataLengthList($dataName, $crypt, $data['Type'], $data['Length']);
            }
            $html .= $this->createDeleteButton();
            $html .= '</div>';
        }
        return $html;
    }

    private function generateCrypt()
    {
        return substr(base_convert(mt_rand(), 10, 36),0,5).substr(base_convert(mt_rand(), 10, 36),0,5);
    }

    private function createFieldName($varname, $key, $value = "")
    {
        return '<input class="name" type="text" name="'.$varname.'['.$key.'][fieldName]" value='.$value.' id="name" placeholder="Field Name"/>';
    }

    private function createDataTypeList($varname, $key, $value = null)
    {
        $value = isset($value) ? strtoupper($value) : $this->dataType[0];
        $html = '<select class="dataType" name="'.$varname.'['.$key.'][dataType]">';
        foreach($this->dataType as $key => $dataType)
        {
            $html .= '<option value='.$dataType.' '.($dataType == $value ? 'selected=\"\"':' '). '>'.$dataType.'</option>';
        }
        $html .= '</select>';
        return $html;
    }

    function createDeleteButton()
    {
        return '<button type="button" class="deleteField"> X </button>';
        //return '<button type="button" onclick=\'doDelete("'+key+'")\'> X </button>';
    }

    function createDataLengthList($varname, $key, $dataType = null, $value = null)
    {
        $totalLength = isset($dataType) ? $this->dataLength[strtoupper($dataType)] : $this->dataLength[$this->dataType[0]];
        $value = isset($value) ? $value : $this->dataLength[$dataType];
        $html = '<select class="dataLength" name="'.$varname.'['.$key.'][dataLength]">';
        for($i = $totalLength; $i > 0; --$i)
        {
            $html .= '<option value='.$i.' '.($i == $value ? 'selected=\"\"' : ' ').'>'.$i.'</option>';
        }
        $html .= '</select>';
        return $html;
    }


}