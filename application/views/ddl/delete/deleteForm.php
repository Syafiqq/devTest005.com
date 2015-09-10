<?php
/**
 * Created by PhpStorm.
 * User: project
 * Date: 10/09/15
 * Time: 19:05
 */



$this->table->set_heading('No', 'Name Field', 'Data Type', 'Data Length');

echo "Table Name : ".$tableName.'<br>';

foreach($tableData as $key => $data)
{
    $this->table->add_row($key+1, $data['Field'], $data['Type'], isset($data['Length']) ? $data['Length'] : "-");
}
echo $this->table->generate();

echo form_open(isset($destination) ? $destination : base_url('ddl/delete'),
    isset($formAttr) ? $formAttr : array());
{
    echo '<span> Do you want to delete this database</span>';
    echo "<div class=\"form-group\" id=\"submit\">";
    {
        echo form_submit('submit[0]', 'Yes');
    }
    echo "</div>";
    echo "<div class=\"form-group\" id=\"submit\">";
    {
        echo form_submit('submit[1]', 'No');
    }
    echo "</div>";
}
echo form_close();
