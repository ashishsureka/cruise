<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages extends MY_Controller {

    public $data;
   

    public function __construct() {

        parent::__construct();
        
        //$GLOBALS['record_per_page']=10;
        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        //set header, footer and leftmenu
        $this->data['title'] = 'Pages : ' . $site_name;
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

        $this->data['module_name'] = 'Page Management';
        $this->data['section_title'] = 'Page List';
        
        $limit =$this->paging['per_page'];
        
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
            $short_by = $this->uri->segment(3);
            $order_by = $this->uri->segment(4);
        } else {
            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
            $short_by = 'page_title';
            $order_by = 'asc';
        }

        $this->data['offset'] = $offset;
        $contition_array=array();
        //$contition_array = array('username != ' => 'client');
        
        
        
        
        
        $this->data['pages_list'] = $this->common->select_data_by_condition('pages', $contition_array, '*', $short_by, $order_by, $limit, $offset);
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['base_url'] = site_url("pages/index/" . $short_by . "/" . $order_by);
        } else {
            $this->paging['base_url'] = site_url("pages/index/");
        }
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['uri_segment'] = 5;
        } else {
            $this->paging['uri_segment'] = 3;
        }
        //for my use
        
        //$this->data['offset']=$offset;
        
        
        
        
        $this->paging['total_rows'] = count($this->common->select_data_by_condition('pages', $contition_array, 'page_id'));
        $this->data['total_rows']=$this->paging['total_rows'];
        $this->data['limit']=$limit;
        //$this->paging['per_page'] = 2;

        $this->pagination->initialize($this->paging);
        $this->data['search_keyword'] = '';
        $this->load->view('pages/index', $this->data);
    }
    
    //update page
    public function edit($id = '') {
       
        if ($this->input->post('page_id')) {
           
            
            $update_array = array(
                'page_title'=>trim($this->input->post('page_title')),
                'page_description'=>trim($this->input->post('page_description')),
                'page_meta_title'=>trim($this->input->post('metatag_title')),
                'page_meta_keywords'=>trim($this->input->post('metatag_keywords')),
                'page_meta_descriptions'=>trim($this->input->post('metatag_description')),
                //'short_description'=>trim($this->input->post('shortdescription')),                
           
            );
           
            
            $update_result = $this->common->update_data($update_array, 'pages', 'page_id', $this->input->post('page_id'));
           
            if ($this->input->post('redirect_url')) {
                $redirect_url = $this->input->post('redirect_url');
            } else {
                $redirect_url = site_url('pages') ;
            }

            if ($update_result) {
                
                $this->session->set_flashdata('success', 'Pages successfully updated.');
                redirect($redirect_url, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');
                redirect($redirect_url, 'refresh');
            }
        }

        $pages_detail = $this->common->select_data_by_id('pages', 'page_id', $id, '*');
        
        if (!empty($pages_detail)) {
            $this->data['module_name'] = 'Page Management';
            $this->data['section_title'] = 'Edit Page';
            
            $this->data['pages_detail'] = $pages_detail;
            $this->load->view('pages/edit', $this->data);
        } else {
            $this->session->set_flashdata('error', 'Errorout Occurred. Try Again.');
            redirect('pages', 'refresh');
        }
    }    

}

?>