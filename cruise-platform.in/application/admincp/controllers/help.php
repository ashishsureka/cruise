<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Help extends MY_Controller {

    public $data;
   

    public function __construct() {

        parent::__construct();
        
        //$GLOBALS['record_per_page']=10;
        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        //set header, footer and leftmenu
        $this->data['title'] = 'Help : ' . $site_name;
        $this->data['header'] = $this->load->view('header', $this->data);
        $this->data['leftmenu'] = $this->load->view('leftmenu', $this->data);
        $this->data['footer'] = $this->load->view('footer', $this->data,true);


        $this->load->model('common');

        //Loadin Pagination Custome Config File
        $this->config->load('paging', TRUE);
        $this->paging = $this->config->item('paging');
        //print_r($this->paging);
        //die();

        //remove catch so after logout cannot view last visited page if that page is this
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    //display user list
   public function index() {

        if ($this->session->userdata('user_search_keyword')) {
            $this->session->unset_userdata('user_search_keyword');
        }

        $this->data['module_name'] = 'Help Management';
        $this->data['section_title'] = 'Help List';
        
        $limit =$this->paging['per_page'];
        
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
            $short_by = $this->uri->segment(3);
            $order_by = $this->uri->segment(4);
        } else {
            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
            $short_by = 'help_title';
            $order_by = 'asc';
        }

        $this->data['offset'] = $offset;
        
        $contition_array = array('help_status != ' => 'delete');        
        $this->data['help_list'] = $this->common->select_data_by_condition('help', $contition_array, '*', $short_by, $order_by, $limit, $offset);
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['base_url'] = site_url("help/index/" . $short_by . "/" . $order_by);
        } else {
            $this->paging['base_url'] = site_url("help/index/");
        }
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['uri_segment'] = 5;
        } else {
            $this->paging['uri_segment'] = 3;
        }
        //for my use
        
        //$this->data['offset']=$offset;
        
        
        
        
        $this->paging['total_rows'] = count($this->common->select_data_by_condition('help', $contition_array, 'help_id'));
        $this->data['total_rows']=$this->paging['total_rows'];
        $this->data['limit']=$limit;
        //$this->paging['per_page'] = 2;

        $this->pagination->initialize($this->paging);
        $this->data['search_keyword'] = '';
        $this->load->view('help/index', $this->data);
    }
	
	//insert page
    public function add() {
       
        if ($this->input->post()) {
                       
            $insert_array = array(
                'help_title'=>trim($this->input->post('help_title')),
                'help_description'=>trim($this->input->post('help_description')),
                'help_status'=> 'enable',                
                'insertdatetime' => date('Y-m-d H:i:s'),
                'insertip' => $_SERVER['REMOTE_ADDR'],
                'editdatetime' => date('Y-m-d H:i:s'),
                'editip' => $_SERVER['REMOTE_ADDR'],
            );           
            
            $insert_result = $this->common->insert_data_getid($insert_array, 'help');
           
            if ($this->input->post('redirect_url')) {
                $redirect_url = $this->input->post('redirect_url');
            } else {
                $redirect_url = site_url('help') ;
            }

            if ($insert_result) {
                
                $this->session->set_flashdata('success', 'Help successfully added.');
                redirect($redirect_url, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                redirect($redirect_url, 'refresh');
            }
        }
        
            $this->data['module_name'] = 'Help Management';
            $this->data['section_title'] = 'Add Help';            
            
            $this->load->view('help/add', $this->data);
        
    }    
    
    //update page
    public function edit($id = '') {
		$id = base64_decode($id);
        if ($this->input->post('help_id')) {
                       
            $update_array = array(
                'help_title'=>trim($this->input->post('help_title')),
                'help_description'=>trim($this->input->post('help_description')),
                'help_status'=> 'enable',                
                'insertdatetime' => date('Y-m-d H:i:s'),
                'insertip' => $_SERVER['REMOTE_ADDR'],
                'editdatetime' => date('Y-m-d H:i:s'),
                'editip' => $_SERVER['REMOTE_ADDR'],
           
            );
                       
            $update_result = $this->common->update_data($update_array, 'help', 'help_id', $this->input->post('help_id'));
           
            if ($this->input->post('redirect_url')) {
                $redirect_url = $this->input->post('redirect_url');
            } else {
                $redirect_url = site_url('help') ;
            }

            if ($update_result) {
                
                $this->session->set_flashdata('success', 'Help successfully updated.');
                redirect($redirect_url, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');
                redirect($redirect_url, 'refresh');
            }
        }

        $help_detail = $this->common->select_data_by_id('help', 'help_id', $id, '*');
        
        if (!empty($help_detail)) {
            $this->data['module_name'] = 'Help Management';
            $this->data['section_title'] = 'Edit Help';
            
            $this->data['help_detail'] = $help_detail;
            $this->load->view('help/edit', $this->data);
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again.');
            redirect('help', 'refresh');
        }
    }    
	
	//change status
    public function change_status($help_id='',$status=''){
        $help_id = base64_decode($help_id);
        $status = base64_decode($status);
        if($help_id=='' || $status==''){
            $this->session->set_flashdata('error','Error Occurred. Try Agaim!');
            redirect('help','refresh');
        }
        if($status=='enable'){
            $status="disable";
        }else{
            $status='enable';
        }
                
        $update_data=array('help_status'=>$status);
        
        $update_result=  $this->common->update_data($update_data,'help','help_id',$help_id);
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = $_SERVER['HTTP_REFERER'];
        } else {
            $redirect_url = site_url() . 'help';
        }
        if($update_result){
            $this->session->set_flashdata('success', 'help status successfully changed');
            redirect($redirect_url, 'refresh');
        }
        else{
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect($redirect_url, 'refresh');
        }
    }
    
    public function delete($help_id=''){
        $help_id = base64_decode($help_id);
        
        if(!$help_id){
            $this->session->set_flashdata('error','Error Occurred. Try Agaim!');
            redirect('help','refresh');
        }
        
        //help delete
        
        $update_data=array('help_status'=>'delete');
        
        $update_result=  $this->common->update_data($update_data,'help','help_id',$help_id);
                
        
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = $_SERVER['HTTP_REFERER'];
        } else {
            $redirect_url = site_url() . 'help';
        }
        if($update_result){
            $this->session->set_flashdata('success', 'Help record successfully deleted');
            redirect($redirect_url, 'refresh');
        }
        else{
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect($redirect_url, 'refresh');
        }
    }

	
	public function view_detail() {
            
        
        if ($this->input->is_ajax_request() && $this->input->post('help_id')) {
 
        $contition_array = array('help_id' => $this->input->post('help_id'),'help_status !=' => 'delete');
        
        $help_detail = $this->common->select_data_by_condition('help', $contition_array, '*');
        
        if($help_detail) { 
        
            $data="<table class='table'>";        
            $data.="<tr>";
            $data.="<td>Help Title</td>";        
            $data.="<td>".$help_detail[0]['help_title']."</td>";            
            $data.="</tr>";
            $data.="<tr>";
            $data.="<td>Help Description</td>";        
            $data.="<td>".$help_detail[0]['help_description']."</td>";            
            $data.="</tr>";                    
            
        }
        $data.="</table>";
        print_r($data);        
        die();
        
        }
        
        
    }        

}

?>