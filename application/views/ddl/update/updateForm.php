<?php
/**
 * Created by PhpStorm.
 * User: project
 * Date: 09/09/15
 * Time: 14:27
 */
if(isset($error))
{
    foreach($error as $key => $value)
    {
        echo '<span style="background-color: red">'.$value.'</span>';
        echo '<br>';
    }
}

echo form_open(isset($destination) ? $destination : base_url('ddl/update'),
    isset($formAttr) ? $formAttr : array(), array('t' => $tableName));
{

    echo "<div class=\"form-group\" id=\"tableName\">";
    {
        echo form_input(array('type' => "text", 'name' => "tableName", 'id' => "tableName", 'placeholder' => "Table Name", 'value' => (isset($tableName) ? $tableName : "")));
    }
    echo "</div>";

    if(isset($tableData))
    {
        echo $tableData;
    }

    echo "<div class=\"form-group\" id=\"add\">";
    {
        echo form_button('add', 'Add');
    }
    echo "</div>";

    echo "<div class=\"form-group\" id=\"submit\">";
    {
        echo form_submit('submit', 'Update');
    }
    echo "</div>";
}
echo form_close();
?>

<script type="text/javascript" src=<?php echo base_url("assets/js/jquery-2.1.4.min.js")?>></script>
<script type="text/javascript" src=<?php echo base_url("assets/js/ddl/fieldGenerator.js")?>></script>
<script type="text/javascript" src=<?php echo base_url("assets/js/ddl/dataTypeLengthGenerator.js")?>></script>
<script type="text/javascript" src=<?php echo base_url("assets/js/ddl/cryptGenerator.js")?>></script>
<script>
    $(document).on('change', 'form#update div.form-group select.dataType', function()
    {
        switch($(this).val())
        {
            case "INT" :
            {
                if($(this).next().is(".dataLength"))
                {
                    $(this).next(".dataLength").remove();
                }
                $(this).after(createDataLengthList($(this).val().toLowerCase(), "data", $(this).parent(".form-group").attr('id')));
                break;
            }
            case "DOUBLE" :
            case "TIMESTAMP" :
            {
                if($(this).next().is(".dataLength"))
                {
                    $(this).next(".dataLength").remove();
                }
                break;
            }
        }
    });

    $(document).on('click', 'form#update div.form-group button.deleteField', function()
    {
        $(this).parent().remove();
    });

    $(document).on('click', 'form#update div#add button[name="add"]', function()
    {
        $(createNewField("data", rand())).insertBefore($(this));
    });
</script>