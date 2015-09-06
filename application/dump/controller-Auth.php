<?php
/**
 * Created by PhpStorm.
 * User: project
 * Date: 31/07/15
 * Time: 13:17
 */

//region 31 July 2015

//<editor-fold desc="Buzz External">
/*    public function browser()
    {
        $browser = new Buzz\Browser();
        $response = $browser->get('http://www.google.com');

        echo $browser->getLastRequest()."\n";
        echo $response;
    }*/
//</editor-fold>

//<editor-fold desc="Faker External">
/*    public function faker()
    {
        $faker = Faker\Factory::create();

        for( $x=0 ; $x<5 ; $x++ ) {
            printf( "%s <%s> from %s\n",
                $faker->name,
                $faker->email,
                $faker->city );
        }
    }*/
//</editor-fold>

//<editor-fold desc="Send Email">
/*    public function calendar()
    {
        $this->load->library('email');
        $this->email->from('Syafiq.rezpector@gmail.com', 'Your Name');
        $this->email->to('Syafiq.rezpector@gmail.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        $this->email->send();

    }*/
//</editor-fold>

//<editor-fold desc="Form Validation 1">
/*
[Way 1]
$this->config->load('fvalidation');
$validation_rules = $this->config->item('register1');
var_dump($this->config);
*/
//</editor-fold>

//<editor-fold desc="Form Validation 0">
/*        //$this->load->run() == FALSE
    if(!$this->form_validation->run('register'))
    {
        $this->load->view('auth/registration/registrationForm');
    }
    else
    {
        $this->load->model('member', '', TRUE);
        $test = $this->member->addMember($this->input->post('username'), $this->input->post('email'), $this->input->post('passwordConf'));
        var_dump($test);
        $_POST = array();
        echo "Registration Successfull";
    }*/
//</editor-fold>
//endregion
