<?php
/**
 * Created by PhpStorm.
 * User: project
 * Date: 31/08/15
 * Time: 14:18
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class ddl extends CI_Controller
{
    public function create()
    {
        if(count($_POST) >= 2 && isset($_POST['submit']) ? $_POST['submit'] == "Test" ? true : false : false)
        {
            $this->doCreate();
        }
        else
        {
            $this->load->helper(array('url', 'form'));
            $this->load->view('ddl/create/createForm', array('formAttr' => array('id' => 'create')));
        }
    }

    public function doCreate()
    {
        //var_dump($_POST);

        $this->load->library('ddl/PostQueryFilter');
        $valid = $this->postqueryfilter->validity($this->input->post('tableName'), $this->input->post('data'));
        if($valid[0])
        {
            unset($valid);
            $this->load->library('ddl/QueryParser');
            $this->load->model('model_ddl', '', TRUE);
            $query = $this->queryparser->parseQuery($this->input->post('tableName'), $this->input->post('data'));
            if($this->model_ddl->create($query))
            {
                echo "SUCCESS";
            }
            else
            {
                echo "FAIL";
            }
        }
        else
        {
            unset($valid[0]);
            $this->load->helper(array('url', 'form'));
            $this->load->view('ddl/create/createForm', array('formAttr' => array('id' => 'create'), 'error' => array('formField' => 'There was error when inserting data please try again later', 'dataField' => $valid[1])));
        }
    }
}

