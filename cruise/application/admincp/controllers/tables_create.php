<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tables_create extends CI_Controller {

    public $data;
   

    public function __construct() {

        parent::__construct();       
		
		$this->load->model('common');

        //remove catch so after logout cannot view last visited page if that page is this
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    
   public function index() {

		$folder_name = 'dumps';
		$file_name = 'cruise.sql';
		$path = 'assets/backup_db/'; // Codeigniter application /assets
		$file_restore = $this->load->file($path . $folder_name . '/' . $file_name, true);
		$file_array = explode(';', $file_restore);
		array_pop($file_array);
		
		foreach ($file_array as $query)
			 {				 
				 if($query){
					 $this->db->query("SET FOREIGN_KEY_CHECKS = 0");
					 $this->db->query($query);
					 $this->db->query("SET FOREIGN_KEY_CHECKS = 1");
				 }
			 }
		
		$email_template_records = $this->common->select_data_by_condition('email_templates');
		

		if(!$email_template_records)
		{
			$insert_array = array(
                'et_id'=> 1,
                'et_subject'=>"CRUISE Registration Detail",
                'et_variables'=>"%emailid% => Registered email id\r\n%password% => User Password\r\n%site_url% => Site URL",
                'et_description'=> "&lt;h1&gt;CRUISE Registration&lt;/h1&gt;\r\n\r\n&lt;h3&gt;You are successfully registered with CRUISE. Your Login details are as below.&lt;/h3&gt;\r\n\r\n&lt;p&gt;Email : %emailid%&lt;/p&gt;\r\n\r\n&lt;p&gt;Password : %password%&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;a href=&quot;%site_url%&quot;&gt;CLICK HERE&lt;/a&gt;&amp;nbsp;&amp;nbsp;To get Log In to CRUISE&lt;/p&gt;\r\n",
                'timestamp'=>'2016-08-10 09:24:56',                
            );
           
            
            $insert_result = $this->common->insert_data_getid($insert_array, 'email_templates');
			
			$insert_array = array(
                'et_id'=> 2,
                'et_subject'=>"Invitation For CRUISE Project",
                'et_variables'=>"%link% => login link\r\n",
                'et_description'=>"&lt;h1&gt;CRUISE Login&lt;/h1&gt;\r\n\r\n&lt;p&gt;&lt;a href=&quot;%link%&quot;&gt;CLICK HERE&lt;/a&gt;&amp;nbsp;&amp;nbsp;To get Login / Register to CRUISE&lt;/p&gt;\r\n",
                'timestamp'=>'2016-09-07 06:41:59',                
            );
           
            
            $insert_result = $this->common->insert_data_getid($insert_array, 'email_templates');
			
			$insert_array = array(
                'et_id'=> 3,
                'et_subject'=>"CRUISE Activation",
                'et_variables'=>"%site_url% => Activation Link",
                'et_description'=>"&lt;h1&gt;CRUISE Activation&lt;/h1&gt;\r\n\r\n&lt;p&gt;&lt;a href=&quot;%site_url%&quot;&gt;CLICK HERE&lt;/a&gt;&amp;nbsp;&amp;nbsp;to activate your CRUISE account.&lt;/p&gt;\r\n",
                'timestamp'=>'2016-09-01 10:28:51',                
            );
           
            
            $insert_result = $this->common->insert_data_getid($insert_array, 'email_templates');
			
			$insert_array = array(
                'et_id'=> 4,
                'et_subject'=>"CRUISE Forgot Password",
                'et_variables'=>"%password% => New Password",
                'et_description'=>"&lt;h1&gt;CRUISE Forgot Password&lt;/h1&gt;\r\n\r\n&lt;h3&gt;Your new password is as below.&lt;/h3&gt;\r\n\r\n&lt;p&gt;New Password : %password%&lt;/p&gt;\r\n",
                'timestamp'=>'2016-09-03 09:35:21',                
            );
           
            
            $insert_result = $this->common->insert_data_getid($insert_array, 'email_templates');
			
		}	

			
                $redirect_url = site_url() ;
            
                $this->session->set_flashdata('success', 'Tables are successfully Created.');
                redirect($redirect_url, 'refresh');
            

    }
    
    
}

?>