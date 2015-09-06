<?php
/**
 * Created by PhpStorm.
 * User: project
 * Date: 24/07/15
 * Time: 19:32
 */

class Member extends CI_Model
{

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function addMember($username, $email, $password)
    {
        $query = "INSERT INTO devtest005.member VALUES (NULL, '".$username."', '".$email."', '".$password."')";
        if($this->db->query($query))
        {
            return array('status' => 1, 'data' => null);
        }
        else
        {
            return array('status' => 0, 'data' => "There was error when processing data");
        }
    }

    public function getEmailCount($email = null)
    {
        $query = "SELECT ALL COUNT(devtest005.member.email) AS \"COUNT\" FROM devtest005.member WHERE TRUE".(isset($email) ? " AND devtest005.member.email = '".$email."'" : "");
        $query = $this->db->query($query);
        return $query->result()[0]->COUNT;
    }

    public function getUserAccountByEmail($email)
    {
        $query = "SELECT ALL devtest005.member.email, devtest005.member.password FROM devtest005.member WHERE devtest005.member.email = '".$email."' LIMIT 1";
        return $this->db->query($query)->result();
    }

    public function getPostgreSQLABC()
    {
        $query = "SELECT ALL * FROM abc";
        return $this->db->query($query)->result();
    }

    public function testCallTest()
    {
        $query = "call devtest005.test(@status)";
        $this->db->trans_start();
        {
            $this->db->query($query);
            $query = $this->db->query("select @status");
        }
        $this->db->trans_complete();

        return $query->result_array()[0]['@status'];
    }

    public function testCallTestPostgreTable()
    {
        $query = "select public.addtest()";
        $this->db->trans_start();
        {
            $query = $this->db->query($query);
        }
        $this->db->trans_complete();

        return $query->result_array()[0]['addtest'];
    }

    public function testCallTestPostgreStream()
    {
        $query = "insert into test(time) values(current_timestamp)";
        if($this->db->query($query))
        {
            return "1";
        }
        else
        {
            return "0";
        }
    }
}