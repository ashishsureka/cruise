<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Help extends CI_Controller{

    public $data;

    public function __construct() {

        parent::__construct();
        
        $page_data = $this->common->select_data_by_id('pages', 'page_id', '5', '*');
        
        $this->data['metatag_title'] = $metatag_title = $page_data[0]['page_meta_title'];
        $this->data['metatag_keywords'] = $metatag_keywords = $page_data[0]['page_meta_keywords'];
        $this->data['metatag_description'] = $metatag_description = $page_data[0]['page_meta_descriptions'];        
        $this->data['page_title'] = $page_title = $page_data[0]['page_title'];
        
        
        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        
        $this->data['title'] = $site_name.' | '.$page_title;

        require_once 'include.php';
        
        //$this->load->model('logins');                

        //remove catch so after logout cannot view last visited page if that page is this
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    //display Login form
    public function index() {
               
		$condition_array=array('help_status' => 'enable');
        $this->data['help_list'] = $this->common->select_data_by_condition('help', $condition_array, '*');
        
        $this->load->view('help/index',$this->data);
    }    
   
}

?>