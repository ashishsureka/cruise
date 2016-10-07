<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_format extends MY_Controller {

    public $data;
   

    public function __construct() {

        parent::__construct();
        
        //$GLOBALS['record_per_page']=10;
        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        //set header, footer and leftmenu
        $this->data['title'] = 'Email Format : ' . $site_name;
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
        

        $this->data['module_name'] = 'Email Format';
        $this->data['section_title'] = 'Email Format List';
        
        $limit =$this->paging['per_page'];
        
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
            $short_by = $this->uri->segment(3);
            $order_by = $this->uri->segment(4);
        } else {
            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
            $short_by = 'et_id';
            $order_by = 'asc';
        }

        $this->data['offset'] = $offset;
        $contition_array=array();        
        $this->data['emailformat_list'] = $this->common->select_data_by_condition('email_templates', $contition_array, '*', $short_by, $order_by, $limit, $offset);
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['base_url'] = site_url("email_format/index/" . $short_by . "/" . $order_by);
        } else {
            $this->paging['base_url'] = site_url("email_format/index/");
        }
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['uri_segment'] = 5;
        } else {
            $this->paging['uri_segment'] = 3;
        }
        
        $this->paging['total_rows'] = count($this->common->select_data_by_condition('email_templates', $contition_array, 'et_id'));
        $this->data['total_rows']=$this->paging['total_rows'];
        $this->data['limit']=$limit;
        //$this->paging['per_page'] = 2;

        $this->pagination->initialize($this->paging);
        $this->data['search_keyword'] = '';
        $this->load->view('email_format/index', $this->data);
    }


    //update the user detail
    public function edit($id = '') {
       $id = base64_decode($id);
        if ($this->input->post()) {
            
            //$get_uniquename = $this->common->select_data_by_id('email_templates', 'uniquename', $this->input->post('uniquename'));                     
            
            $update_array = array(                
                'et_subject'=>trim($this->input->post('varsubject')),
                'et_description'=>  htmlentities($this->input->post('varmailformat')),                          
           
            );
           
            
            $update_result = $this->common->update_data($update_array, 'email_templates', 'et_id', $this->input->post('emailid'));
           
           
            if ($this->input->post('redirect_url')) {
                $redirect_url = $this->input->post('redirect_url');
            } else {
                $redirect_url = site_url('email_format') ;
            }

            if ($update_result) {
                
                $this->session->set_flashdata('success', 'Email Format successfully updated.');
                redirect($redirect_url, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');
                redirect($redirect_url, 'refresh');
            }
        }

        $emailformat_detail = $this->common->select_data_by_id('email_templates', 'et_id', $id, '*');
        
        
        if ($emailformat_detail) {
            $this->data['module_name'] = 'Email Format';
            $this->data['section_title'] = 'Edit Email Format';
            
            $this->data['emailformat_detail'] = $emailformat_detail;
            $this->load->view('email_format/edit', $this->data);
        } else {
            $this->session->set_flashdata('error', 'Errorout Occurred. Try Again.');
            redirect('email_format', 'refresh');
        }
    }


}

?>