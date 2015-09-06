<?php
/**
 * Created by PhpStorm.
 * User: project
 * Date: 31/07/15
 * Time: 8:15
 */

class CallableFormValidation
{
    private $_CI;

    function __construct()
    {
        $this->_CI = &get_instance();
    }

    public function checkExistingEmail($email)
    {
        try
        {
            $this->_CI->load->model('member', '', TRUE);
            if ($this->_CI->member->getEmailCount($email) >= 1)
            {
                unset($CI);
                return FALSE;
            } else
            {
                unset($CI);
                return TRUE;
            }
        }
        catch (Exception $error)
        {
            return false;
        }
    }

}