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

    public function read()
    {
        //var_dump($_GET);
        if(isset($_GET['t']))
        {
            if(strlen($_GET['t']) > 0)
            {
                $this->doRead();
            }
            else
            {
                $this->load->helper(array('url', 'form'));
                $this->load->view('ddl/searchForm', array('destination' => base_url('ddl/read'), 'formAttr' => array('id' => 'read', 'method' => 'get'), 'error' => array('empty' => 'The search field cannot be empty')));
            }
        }
        else
        {
            $this->load->helper(array('url', 'form'));
            $this->load->view('ddl/searchForm', array('destination' => base_url('ddl/read'), 'formAttr' => array('id' => 'read', 'method' => 'get')));
        }
    }

    public function doRead()
    {
        $this->load->model('model_ddl', '', TRUE);
        if($this->model_ddl->checkTable($_GET['t']))
        {
            $this->load->helper(array('url', 'form'));
            $this->load->library('table');
            $result = $this->model_ddl->getTableDescription($_GET['t']);
            $result = $this->model_ddl->filterTableDescription($result);
            $this->load->view('ddl/read/viewResultForm', array('formDeleteAttr' => array('id' => 'delete', 'method' => 'get'), 'formUpdateAttr' => array('id' => 'update', 'method' => 'get'), 'tableData' => $result, 'tableName' => $_GET['t']));
        }
        else
        {
            $this->load->helper(array('url', 'form'));
            $this->load->view('ddl/searchForm', array('destination' => base_url('ddl/read'), 'formAttr' => array('id' => 'read', 'method' => 'get'), 'error' => array('notFound' => 'The table you specified is not found')));
        }
    }

    public function update()
    {
        if(isset($_GET['t']))
        {
            if(count($_POST) >= 2 && isset($_POST['submit']) ? $_POST['submit'] == "Update" ? true : false : false)
            {
                $this->commitUpdate();
            }
            else
            {
                if (strlen($_GET['t']) > 0)
                {
                    $this->doUpdate();
                }
                else
                {
                    $this->load->helper(array('url', 'form'));
                    $this->load->view('ddl/searchForm', array('destination' => base_url('ddl/update'),
                                                              'formAttr' => array('id' => 'read', 'method' => 'get'),
                                                              'error' => array('empty' => 'The search field cannot be empty')));
                }
            }
        }
        else
        {
            $this->load->helper(array('url', 'form'));
            $this->load->view('ddl/searchForm', array('destination' => base_url('ddl/update'), 'formAttr' => array('id' => 'read', 'method' => 'get')));
        }
    }

    public function doUpdate()
    {
        $this->load->model('model_ddl', '', TRUE);
        if($this->model_ddl->checkTable($_GET['t']))
        {
            $this->load->library('ddl/FieldGenerator');
            $this->load->helper(array('url', 'form'));
            $result = $this->model_ddl->getTableDescription($_GET['t']);
            $result = $this->model_ddl->filterTableDescription($result);
            $result = $this->fieldgenerator->makeHTMLForField($result);
            $this->load->view('ddl/update/updateForm', array('destination' => base_url('ddl/update?t='.$_GET['t']), 'formAttr' => array('id' => 'update'), 'tableData' => $result, 'tableName' => $_GET['t']));
        }
        else
        {
            $this->load->helper(array('url', 'form'));
            $this->load->view('ddl/searchForm', array('destination' => base_url('ddl/update'), 'formAttr' => array('id' => 'read', 'method' => 'get'), 'error' => array('notFound' => 'The table you specified is not found')));
        }
    }

    public function commitUpdate()
    {
        log_message("ERROR", "commit");
        $this->load->library('ddl/PostQueryFilter');
        $valid = $this->postqueryfilter->validity($this->input->post('tableName'), $this->input->post('data'));
        if($valid[0])
        {
            unset($valid);
            $this->load->library('ddl/QueryParser');
            $this->load->model('model_ddl', '', TRUE);
            $query = $this->queryparser->parseQuery($this->input->post('tableName'), $this->input->post('data'));
            if($this->model_ddl->reCreate($query, $this->input->post('tableName')))
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
            $this->load->model('model_ddl', '', TRUE);
            $this->load->library('ddl/FieldGenerator');
            $this->load->helper(array('url', 'form'));
            $result = $this->model_ddl->getTableDescription($_GET['t']);
            $result = $this->model_ddl->filterTableDescription($result);
            $result = $this->fieldgenerator->makeHTMLForField($result);
            $this->load->view('ddl/update/updateForm', array('destination' => base_url('ddl/update?t='.$_GET['t']), 'formAttr' => array('id' => 'update'), 'error' => array('formField' => 'There was error when inserting data please try again later'), 'tableData' => $result, 'tableName' => $_GET['t']));
            //$this->load->view('ddl/create/createForm', array('formAttr' => array('id' => 'create'), , 'dataField' => $valid[1])));
        }
    }

    public function delete()
    {
        if(isset($_GET['t']))
        {
            if(count($_POST) == 1 && isset($_POST['submit']) ? is_array($_POST['submit']) ? true : false : false)
            {
                if(isset($_POST['submit'][0]))
                {
                    $this->commitDelete();
                }
                else
                {
                    $this->load->helper(array('url', 'form'));
                    $this->load->view('ddl/searchForm',
                        array('destination' => base_url('ddl/delete'), 'formAttr' => array('id' => 'read', 'method' => 'get')));
                }
            }
            else
            {
                if (strlen($_GET['t']) > 0)
                {
                    $this->doDelete();
                }
                else
                {
                    $this->load->helper(array('url', 'form'));
                    $this->load->view('ddl/searchForm', array('destination' => base_url('ddl/delete'),
                                                              'formAttr' => array('id' => 'read', 'method' => 'get'),
                                                              'error' => array('empty' => 'The search field cannot be empty')));
                }
            }
        }
        else
        {
            $this->load->helper(array('url', 'form'));
            $this->load->view('ddl/searchForm',
                array('destination' => base_url('ddl/delete'), 'formAttr' => array('id' => 'read', 'method' => 'get')));
        }
    }

    public function doDelete()
    {
        $this->load->model('model_ddl', '', TRUE);
        if($this->model_ddl->checkTable($_GET['t']))
        {
            $this->load->library('table');
            $this->load->helper(array('url', 'form'));
            $result = $this->model_ddl->getTableDescription($_GET['t']);
            $result = $this->model_ddl->filterTableDescription($result);
            $this->load->view('ddl/delete/deleteForm', array('destination' => base_url('ddl/delete?t='.$_GET['t']), 'formAttr' => array('id' => 'update'), 'tableData' => $result, 'tableName' => $_GET['t']));
        }
        else
        {
            $this->load->helper(array('url', 'form'));
            $this->load->view('ddl/searchForm', array('destination' => base_url('ddl/update'), 'formAttr' => array('id' => 'read', 'method' => 'get'), 'error' => array('notFound' => 'The table you specified is not found')));
        }
    }

    public function commitDelete()
    {
        $this->load->model('model_ddl', '', TRUE);
        if($this->model_ddl->deleteTable($_GET['t']))
        {
            echo "SUCCESS";
        }
        else
        {
            echo "FAIL";
        }
    }
}

