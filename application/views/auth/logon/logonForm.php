<?php
/**
 * Created by PhpStorm.
 * User: project
 * Date: 02/08/15
 * Time: 9:45
 */

echo form_open(isset($destination) ? $destination : base_url('logon'),
    isset($formAttr) ? $formAttr : array());
{
    echo (isset($status['failLogonStatus']) ? $status['failLogonStatus'] : "");
    echo "<div class=\"form-group\">";
    {
        echo form_error('email', '<span class="error" style="font-family: \'DejaVu Sans Mono\'">', '</span></br>');
        echo form_label('Email', 'email');
        echo form_input(array('name' => 'email', 'id' => 'email', 'placeholder' => 'Email', 'type' => 'email', 'value' => set_value('email')));
    }
    echo "</div>";

    echo "<div class=\"form-group\">";
    {
        echo form_error('password', '<span class="error" style="font-family: \'DejaVu Sans Mono\'">', '</span></br>');
        echo form_label('Password', 'password');
        echo form_password(array('name' => 'password', 'id' => 'password', 'placeholder' => 'Password'));
    }
    echo "</div>";

    echo "<div class=\"form-group\">";
    {
        echo form_submit('submit', 'Login');
    }
    echo "</div>";
}
echo form_close();