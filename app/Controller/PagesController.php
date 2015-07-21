<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {
    var $components = array('Email','CustomMail');

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function index() {
		$this->loadModel('Restaurant');
        $this->loadModel('Menu');
        $q = $this->Restaurant->find('all');
        $q1 = $this->Menu->find('all',array('conditions',array('featured'=>1),'limit'=>6));
        $this->set('res',$q);
        $this->set('menu',$q1);
        
	}
    function getGeneric()
    {
        $arr['title'] = 'Charlies Chopsticks';
        $arr['keyword']='Charlies Chopsticks , Food Ordering , Online Food , Order Food , Restaurant';
        $arr['description'] = 'Charlies Chopsticks is an online food ordering system for Canada. Just find your location and place your order and we will be right there to serve you.';
        return $arr;
    }
    public function shop()
    {
        
    }
    public function blog()
    {
        
    }
    public function features()
    {
        
    }
    public function about()
    {
        
    }    public function menu()
    {
        
    }
    public function pricing()
    {
        
    }
    public function findus()
    {
        
    }
    public function contact()
    {
        if(isset($_POST['name'])&&$_POST['name'])
        {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $sub = $_POST['subject'];
            $msg = $_POST['message'];
                /*$emails = new CakeEmail();
                $emails->from(array('charlieschopsticks@gmail.com'=>'Charlie\'s Chopsticks'));
            
                $emails->emailFormat('html');
                
                $emails->subject('New contact Message');*/
                $subject = 'New contact Message';
                
                $message="
                Hello,<br/><br/>
                You've received a new message from Charlie's Chopsticks<br/><br/> 

<b>From</b> : ".$name."<br/>
<b>Email</b> : ".$email."<br/>
<b>Subject</b> : ".$sub."<br/>
<b>Message</b> : ".$msg."<br/><br/>Thankyou,<br/>Charlie's Chopsticks.";
                /*$emails->to('charlieschopsticks@gmail.com');
                
                $emails->send($message);*/
                $to = 'charlieschopsticks@gmail.com';
                $this->CustomMail->sendMail($to,$subject,$message);
                
                $this->Session->setFlash('Message sent successfully');
            
                
                
                
                
                
                
                
                $this->redirect('contact');
        }

            $this->loadMOdel('Locations');
            $this->loadMOdel('Restaurants');
            $this->set('locations', $this->Locations->find('all'));
            $this->set('restaurants', $this->Restaurants->find('all'));

    }
    public function search_result()
    {
        
    }
    public function elements()
    {
        
    }
    public function term()
    {
        
    }
    public function privacy()
    {
        
    }
    function getCurrentUrl()
    {
        echo  $this->params['action'];die();
    }
    function suggest()
    {
        $name = $_POST['name'];
        $fname = $_POST['fname'];
        $femail = $_POST['femail'];
        /*$emails = new CakeEmail();
        $emails->from(array('charlieschopsticks@gmail.com'=>'Charlie\'s Chopsticks'));
    
        $emails->emailFormat('html');
        
        $emails->subject($_POST['name'].' - Suggestion');*/
        
        $whole =  Router::url(null,true);
        $base_url_arr = explode('/pages',$whole);
        $path = $base_url_arr['0'];
        
        $message="
        Hi ".$fname.",<br/><br/>
        Your friend, ".$name." suggested you to use <a href='".$path."'>".$path."</a><br/><br/>
        Charlie's Chopsticks is an online food ordering system. Give us a try!<br/><br/>
        Thank you,
        The Charlie's Chopsticks Team 
        ";
        /*$emails->to($femail);
        $emails->send($message);*/
        $this->CustomMail->sendMail($femail,$_POST['name'].' - Suggestion',$message);
        $this->Session->setFlash('Suggestion successfully sent to '.$femail);
        $this->redirect('/');
    }
    function test()
    {
        return $this->render('test');
    }
    function getHours()
    {
        
        $this->loadModel('Restaurant');
        return $this->Restaurant->find('first');
    }
    function testing()
    {
        $this->CustomMail->test('info@trinoweb.com','test','<b>Test</b>ing');
        die();
    }



    function getLocations() {
        $this->loadModel('Restaurants');
        $this->loadMOdel('Locations');
        $data = array();
        $data["Restaurants"] =  $this->Restaurants->find('all');
        $data["Locations"] = $this->Locations->find('all');
        return $data;
    }
}
