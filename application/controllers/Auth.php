<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: project
 * Date: 23/07/15
 * Time: 13:32
 */
class auth extends CI_Controller
{
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function index()
	{
        $this->load->helper('url');
        redirect(base_url('login'));
	}

    public function logon()
    {
        if(count($_POST) == 3 && isset($_POST['submit']) ? $_POST['submit'] == "Login" ? true : false : false)
        {
            $this->doLogon();
        }
        else
        {
            $this->load->helper(array('url', 'form'));
            $this->load->view('auth/logon/logonForm');
        }
    }

    public function doLogon()
    {
        $this->load->library('form_validation');
        $this->config->load('form_validation', TRUE);

        $this->form_validation->set_rules($this->config->item('logon', 'form_validation'));
        if(!$this->form_validation->run())
        {
            $this->load->helper(array('url', 'form'));
            $this->load->view('auth/logon/logonForm');
        }
        else
        {
            $this->load->model('member', '', TRUE);
            $result = $this->member->getUserAccountByEmail($this->input->post('email'));
            if($result != null)
            {
                if($result[0]->password == $this->input->post('password'))
                {
                    echo "SucesssFull";
                    return;
                }
                else
                {
                    $data['status']['failLogonStatus'] = "Email and Password Combination wrong";
                }
            }
            else
            {
                $data['status']['failLogonStatus'] = "Account Doesn't Exists";
            }
            $this->load->helper(array('url', 'form'));
            $this->load->view('auth/logon/logonForm', $data);
        }
    }

    public function registration()
    {
        if(count($_POST) == 5 && isset($_POST['submit']) ? $_POST['submit'] == "Register" ? true : false : false)
        {
            $this->doRegister();
        }
        else
        {
            $this->load->helper(array('url', 'form'));
            $this->load->view('auth/registration/registrationForm');
        }
    }

    public function test()
    {
/*        $this->load->model('member', '', TRUE);
        var_dump($this->member->testCallTest());*/
        $this->load->helper('url');
        $this->load->view('tests/counter');
/*        $this->load->model('member', '', TRUE);
        $query = $this->member->getEmailCount();
        var_dump($query);*/
    }

    public function testAjax()
    {
        $this->load->model('member', '', TRUE);
        $status = $this->member->testCallTest();
        log_message('error', $status);
        echo json_encode(array('status' => $status));
    }

    public function testAjaxPostgresql()
    {
        $this->load->model('member', '', TRUE);
        $status = $this->member->testCallTestPostgreStream();
        log_message('error', $status);
        echo json_encode(array('status' => $status));
    }

    public function doRegister()
    {

        $this->load->helper(array('url', 'form'));
        $this->load->library('form_validation');

        $this->config->load('form_validation', TRUE);
        $rule_dataset = $this->config->item('register', 'form_validation');

        foreach ($rule_dataset as $i => $rules)
        {
            if (isset($rules['rules']))
            {
                foreach ($rules['rules'] as $k => $rule)
                {
                    if (is_array($rule) && preg_match("/_callable/",$rule[0]) && isset($rule[1][0]))
                    {
                        if(!isset($this->$rule[1][0]))
                        {
                            $this->load->library($rule[1][0]);
                        }
                        $rule[1][0] = strtolower($rule[1][0]);
                        $rule_dataset[$i]['rules'][$k][1][0] = $this->$rule[1][0];
                    }
                }
            }
        }
        $this->form_validation->set_rules($rule_dataset);
        if(!$this->form_validation->run())
        {
            $this->load->view('auth/registration/registrationForm');
        }
        else
        {
            if($this->load->model('member', '', TRUE))
            {
                $result = $this->member->addMember($this->input->post('username'), $this->input->post('email'),
                    $this->input->post('passwordConf'));
                if ($result['status'])
                {
                    echo "Registration Successfull";
                    unset($result);
                } else
                {
                    echo $result['data'];
                    unset($result);
                }
            }
            else
            {
                echo "There was error while processing data";
            }
        }
    }
}