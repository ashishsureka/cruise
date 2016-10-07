<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Profile extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();
        
        $page_data = $this->common->select_data_by_id('pages', 'page_id', '4', '*');
        
        $this->data['metatag_title'] = $metatag_title = $page_data[0]['page_meta_title'];
        $this->data['metatag_keywords'] = $metatag_keywords = $page_data[0]['page_meta_keywords'];
        $this->data['metatag_description'] = $metatag_description = $page_data[0]['page_meta_descriptions'];        
        $this->data['page_title'] = $page_title = $page_data[0]['page_title'];                
                
        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        
        $this->data['title'] = $site_name.' | '.$page_title;
        
        require_once 'include.php';
        $this->config->load('paging', TRUE);
        $this->paging = $this->config->item('paging');
//        echo $page_title; die();
        
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    //display Login form
    public function index() {

        if($this->input->post()){
//            echo '<pre>';
//            print_r($this->input->post());
//            die();
            
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['name'] != '')  {
                
                $profile['upload_path'] = $this->config->item('profile_main_image');
                $profile['allowed_types'] = 'jpg|jpeg|png|gif';

                $this->load->library('upload');
                $this->upload->initialize($profile);
                //Uploading Image
                $this->upload->do_upload('profile_image');
                //Getting Uploaded Image File Data
                $filedata = $this->upload->data();
                $filerror = $this->upload->display_errors();
                if($this->upload->data()) {
                    $fileName=$this->upload->data()['file_name'];
                    $imgdata = $this->upload->data();
                    $filename = $imgdata['file_name'];
                    $config['source_image'] = $this->upload->upload_path . $this->upload->file_name;
                    $config['new_image'] = $this->config->item('profile_thumb_image') . $this->upload->file_name;
                    $config['upload_path'] = $this->config->item('profile_thumb_image');
                    $config['maintain_ratio'] = true;
                    $config['width'] = 150;
                    $config['height'] = 150;

                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                 }
                $datafile = $filedata['file_name'];

                if ($filerror != '') {
                    $error[0] = $filerror;
                    
                } else {
                    $error = array();
                }

                if ($error) {
                    $this->session->set_flashdata('error', $error[0]);
                    $redirect_url = site_url('profile');
                    redirect($redirect_url, 'refresh');
                } else {
                    $hidden_image = $this->input->post('profile_image_hide');
                    $hidden_image_path = $this->config->item('profile_main_image') . $hidden_image;                    
                    
                    if (file_exists($hidden_image_path) && $hidden_image) {
                        unlink($hidden_image_path);
                    }
                }
            } elseif($this->input->post('profile_image_hide')) {
                $datafile = $this->input->post('profile_image_hide');
            } else {
                $datafile = "";
            }
            
            $update_array = array(
                'user_first_name'=>trim($this->input->post('fname')),
                'user_last_name'=>trim($this->input->post('lname')),
                'user_email'=>trim($this->input->post('email')),                                
                'user_profile_image'=>$datafile,                                
                'editdatetime' => date('Y-m-d H:i:s'),
                'editip' => $_SERVER['REMOTE_ADDR'],           
            );
           
            
            $update_result = $this->common->update_data($update_array, 'users', 'user_id', $this->data['user_id']);
            
            if ($update_result) {                
                $this->session->set_flashdata('success', 'Profile successfully updated.');
                redirect(site_url('profile'), 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                redirect(site_url('profile'), 'refresh');
            }
        }
        
        $this->data['profile_detail'] = $this->common->select_data_by_id('users', 'user_id', $this->data['user_id'], '*');
        $this->load->view('profile/index',$this->data);
    }
    
    
    //check old password
    public function check_email() {
        if ($this->input->is_ajax_request() && $this->input->post('email')) {
            
            $contition_array = array('user_status !=' => 'delete', 'user_email' => $this->input->post('email'),'user_id !=' => $this->data['user_id']);
            $check_result = $this->common->select_data_by_condition('users', $contition_array);
            
            if ($check_result) {
                echo 'false';
                die();
            } else {
                echo 'true';
                die();
            }
        }
    }
    
}

?>