<?php
/**
 * Created by PhpStorm.
 * User: project
 * Date: 07/09/15
 * Time: 15:11
 */

if(isset($error))
{
    foreach($error as $key => $value)
    {
        echo '<span style="background-color: red">'.$value.'</span>';
        echo '<br>';
    }
}




echo form_open(isset($destination) ? $destination : base_url('ddl/read'),
    isset($formAttr) ? $formAttr : array());
{
    echo "<div class=\"form-group\" id=\"tableName\">";
    {
        echo form_input(array('type' => "text", 'name' => "t", 'id' => "tableName", 'placeholder' => "Table Name"));
    }
    echo "</div>";

    echo "<div class=\"form-group\" id=\"submit\">";
    {
        echo form_submit('', 'Test');
    }
    echo "</div>";
}
echo form_close();