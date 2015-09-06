<?php
/**
 * Created by PhpStorm.
 * User: project
 * Date: 03/09/15
 * Time: 11:00
 */

echo '<span style="background-color: red">'.(isset($error['formField'])?$error['formField']:"").'</span>';
echo '<span style="background-color: red">'.(isset($error['dataField'])?(isset($error['formField'])?'<br>':"").$error['dataField']:"").'</span>';


echo form_open(isset($destination) ? $destination : base_url('ddl/create'),
    isset($formAttr) ? $formAttr : array());
{

    echo "<div class=\"form-group\" id=\"tableName\">";
    {
        echo form_input(array('type' => "text", 'name' => "tableName", 'id' => "tableName", 'placeholder' => "Table Name"));
    }
    echo "</div>";

    echo "<div class=\"form-group\" id=\"add\">";
    {
        echo form_button('add', 'Add');
    }
    echo "</div>";

    echo "<div class=\"form-group\" id=\"submit\">";
    {
        echo form_submit('submit', 'Test');
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
/*    $('form#create div#add').click(function()
    {
        //$('form#create div#add').before(createNewField("data", rand()));
        $(createNewField("data", rand())).insertBefore($(this));
    });*/

/*    $('form#create').click(function(event)
    {
        if($(event.target).is('button.deleteField'))
        {
            $(event.target).parent(".form-group").remove();
        }
        if($(event.target).is('select.dataType'))
        {
            switch($(event.target).val())
            {
                case "INT" :
                {
                    if($(event.target).next().is(".dataLength"))
                    {
                        $(event.target).next().remove();
                    }
                    $(event.target).after(createDataLengthList($(event.target).val().toLowerCase(), "data", $(event.target).parent(".form-group").attr('id')));
                    break;
                }
                case "DOUBLE" :
                case "TIMESTAMP" :
                {
                    if($(event.target).next().is(".dataLength"))
                    {
                        $(event.target).next().remove();
                    }
                    break;
                }
            }
        }
    });*/

    $(document).on('change', 'form#create div.form-group select.dataType', function()
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

    $(document).on('click', 'form#create div.form-group button.deleteField', function()
    {
        $(this).parent().remove();
    });

    $(document).on('click', 'form#create div#add button[name="add"]', function()
    {
        $(createNewField("data", rand())).insertBefore($(this));
    });


/*    $("form#create").on('click', 'div.form-group', function() {
        alert( "Handler for .change() called." );
    });*/
</script>