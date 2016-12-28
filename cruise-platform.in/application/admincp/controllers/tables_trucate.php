<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tables_trucate extends MY_Controller {

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

			$tables_list = 'inquiry,projects,project_comment_likes,project_invites,project_modules,project_requirements,project_requirement_comments,project_requirement_likes_dislikes,project_users,users';
		 $delete_result = $this->common->delete_all_table($tables_list);
           
            if ($this->input->post('redirect_url')) {
                $redirect_url = $this->input->post('redirect_url');
            } else {
                $redirect_url = site_url() ;
            }

            if ($delete_result) {
                
                $this->session->set_flashdata('success', 'Tables are successfully Truncated.');
                redirect($redirect_url, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');
                redirect($redirect_url, 'refresh');
            }

    }
    
    
}

?>