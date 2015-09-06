<?php
/**
 * Created by PhpStorm.
 * User: project
 * Date: 31/07/15
 * Time: 13:42
 */
/*$config = array(
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
                             array(
                                 'email_callable',
                                 function($str)
                                 {
                                     $CI =& get_instance();
                                     $CI->load->model('member', '', TRUE);
                                     if($CI->member->getEmailCount($str) >= 1)
                                     {
                                         unset($CI);
                                         return FALSE;
                                     }
                                     else
                                     {
                                         unset($CI);
                                         return TRUE;
                                     }
                                 }
                             )),
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
    )
);*/