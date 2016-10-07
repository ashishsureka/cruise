<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Home extends CI_Controller {

    public $data;

    public function __construct() {

        parent::__construct();
        
        
        $page_data = $this->common->select_data_by_id('pages', 'page_id', '1', '*');
        
        $this->data['metatag_title'] = $metatag_title = $page_data[0]['metatag_title'];
        $this->data['metatag_keywords'] = $metatag_keywords = $page_data[0]['metatag_keywords'];
        $this->data['metatag_description'] = $metatag_description = $page_data[0]['metatag_description'];
        $this->data['page_name'] = $page_name = $page_data[0]['page_name'];
        $this->data['page_title'] = $page_title = $page_data[0]['page_title'];
        $this->data['page_description'] = $page_description = $page_data[0]['page_description'];
        $this->data['page_image'] = $page_image = $page_data[0]['image'];
        
        include ("include.php");
        
   /*     if ($this->session->userdata('aangan_front')) {
            redirect('dashboard', 'refresh');
        }
*/
        //set header, footer and leftmenu
        $this->data['title'] = 'Home | Aangan Express';
//        $this->load->view('header');

//        $this->load->model('logins');

    /*    //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];

        $site_email_values = $this->common->select_data_by_id('settings', 'setting_id', '6', '*');
        $this->data['site_email'] = $site_email = $site_email_values[0]['setting_value'];
*/
        //remove catch so after logout cannot view last visited page if that page is this
        
        
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    //display Login form
    public function index() {
        
        //for banner
        

//        print_r($this->data['banner_list']);
//        die();
        $this->data['block_data_1'] = $this->common->select_data_by_id('block', 'block_id', '1', '*');
        $this->data['block_data_2'] = $this->common->select_data_by_id('block', 'block_id', '2', '*');
        $this->data['block_data_3'] = $this->common->select_data_by_id('block', 'block_id', '3', '*');
        
        $this->data['popular_data_1'] = $this->common->select_data_by_id('popular', 'popular_id', '1', '*');
        $this->data['popular_data_2'] = $this->common->select_data_by_id('popular', 'popular_id', '2', '*');
        $this->data['popular_data_3'] = $this->common->select_data_by_id('popular', 'popular_id', '3', '*');
        $this->data['popular_data_4'] = $this->common->select_data_by_id('popular', 'popular_id', '4', '*');
        
        
        $this->load->view('home/index',$this->data);
    }

 

}

?>