<?php
/**
 * Created by PhpStorm.
 * User: project
 * Date: 23/07/15
 * Time: 13:27
 */

echo form_open(isset($destination) ? $destination : base_url('register'),
    isset($formAttr) ? $formAttr : array());
{
    //echo validation_errors();

    echo "<div class=\"form-group\">";
    {
        echo form_error('username', '<span class="error" style="font-family: \'DejaVu Sans Mono\'">', '</span></br>');
        echo form_label('Username', 'username');
        echo form_input(array('name' => 'username', 'id' => 'username', 'placeholder' => 'Username', 'value' => set_value('username')));
    }
    echo "</div>";

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
        echo form_error('passwordConf', '<span class="error" style="font-family: \'DejaVu Sans Mono\'">', '</span></br>');
        echo form_label('Confirm Password', 'passwordConf');
        echo form_password(array('name' => 'passwordConf', 'id' => 'passwordConf', 'placeholder' => 'Password Confirmation'));
    }
    echo "</div>";

    echo "<div class=\"form-group\">";
    {
        echo form_submit('submit', 'Register');
    }
    echo "</div>";
}
echo form_close();