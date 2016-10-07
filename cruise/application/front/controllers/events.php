<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Events extends CI_Controller {

    public $data;

    public function __construct() {

        parent::__construct();
        
        $page_data = $this->common->select_data_by_id('pages', 'page_id', '3', '*');
        
        $this->data['metatag_title'] = $metatag_title = $page_data[0]['metatag_title'];
        $this->data['metatag_keywords'] = $metatag_keywords = $page_data[0]['metatag_keywords'];
        $this->data['metatag_description'] = $metatag_description = $page_data[0]['metatag_description'];
        $this->data['page_image'] = $image = $page_data[0]['image'];
        
        include_once 'include.php';
/*     if ($this->session->userdata('aangan_front')) {
            redirect('dashboard', 'refresh');
        }
*/
        //set header, footer and leftmenu
        $this->data['title'] = 'Event | Aangan Express';
       

//    $this->load->model('logins');

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

//        for event images 
        
        $contition_array=array('is_delete'=>'0','status' => 'Enable');
        $data='event_front_image,event_title,eventid';
        $this->data['event_list'] = $this->common->select_data_by_condition('event', $contition_array, $data);
        
        $this->load->view('events/index',$this->data);
    }
    
    
    public function eventdetail($id='0') {
      
        $contition_array=array('is_delete'=>'0','eventid'=>$id,'status' => 'Enable');
//        $data='event_front_image,event_title,eventid,insertdatetime,event_description';
        $data='*';
        $this->data['event'] = $this->common->select_data_by_condition('event', $contition_array, $data);

        
        
        $this->load->view('events/eventdetail',$this->data);
    }

    
}

?>