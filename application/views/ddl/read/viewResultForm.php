<?php
/**
 * Created by PhpStorm.
 * User: project
 * Date: 09/09/15
 * Time: 11:29
 */



$this->table->set_heading('No', 'Name Field', 'Data Type', 'Data Length');

echo "Table Name : ".$tableName.'<br>';

foreach($tableData as $key => $data)
{
    $this->table->add_row($key+1, $data['Field'], $data['Type'], isset($data['Length']) ? $data['Length'] : "-");
}
echo $this->table->generate();

echo form_open(isset($destination) ? $destination : base_url('ddl/update'),
    isset($formUpdateAttr) ? $formUpdateAttr : array(), array('t' => $tableName));
{
    echo "<div class=\"form-group\" id=\"submit\">";
    {
        echo form_submit('', 'Update');
    }
    echo "</div>";
}
echo form_close();

echo form_open(isset($destination) ? $destination : base_url('ddl/delete'),
    isset($formDeleteAttr) ? $formDeleteAttr : array(), array('t' => $tableName));
{
    echo "<div class=\"form-group\" id=\"submit\">";
    {
        echo form_submit('', 'Delete');
    }
    echo "</div>";
}
echo form_close();