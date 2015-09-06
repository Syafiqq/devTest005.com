<?php
/**
 * Created by PhpStorm.
 * User: project
 * Date: 24/07/15
 * Time: 14:27
 */

$config = array(
    'register' => array (
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => array('required', 'min_length[3]', 'max_length[45]', 'alpha'),
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => array('required', 'valid_email', 'max_length[100]',
                            array('email_callable', array("callableFormValidation", 'checkExistingEmail'))),
            'errors' => array('email_callable' => "{field} ".$_POST['email']." is already exists")
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => array('required', 'min_length[8]'),
        ),
        array(
            'field' => 'passwordConf',
            'label' => 'Password Confirmation',
            'rules' => array('required', 'matches[password]', 'md5', 'md5'),
        )
    ),
    'logon' => array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => array('required', 'valid_email', 'max_length[100]'),
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => array('required', 'min_length[8]', 'md5', 'md5')
        ),
    )
);
