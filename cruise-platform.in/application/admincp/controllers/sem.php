<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sem extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        
        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];

        //set header and leftmenu, title
        $this->data['title'] = 'Search Engine Marketing : ' . $site_name;
        $this->data['header'] = $this->load->view('header', $this->data,true);
        $this->data['leftmenu'] = $this->load->view('leftmenu', $this->data,true);
        $this->data['footer'] = $this->load->view('footer', $this->data,true);

        $this->load->model('settings');
        //remove catch so after logout cannot view last visited page if that page is this
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {
        $this->data['module_name'] = 'Search Engine Marketing';
        $this->data['section_title'] = 'Search Engine Marketing';
        $this->data['setting_list'] = $this->settings->getSemDetails();
        
        $this->data['limit']=$this->data['total_rows']=count($this->settings->getSemDetails());
        $this->data['offset']=0;
        $this->load->view('sem/index', $this->data);
    }

    public function editform() {
        if ($this->input->is_ajax_request() && $this->input->post('semid')) {
            $setting_id = ($this->input->post('semid'));

            $setting_id = $setting_id;
            $setting_detail = $this->settings->getSemById($setting_id);

            //create html of edit form
            $editform = '';
            $editform.='<div class="modal-header" id="model_header">
                    <button data-dismiss="modal" class="close" type="button">×</button>
                    <h3 id="setting_title">' . $setting_detail[0]['semfieldname'] . '</h3>
                </div><div class="modal-body">';
            $editform.='<form class="form_textarea" id="editform" method="post" action="sem/update">';
            $editform.='<div style="display:none;"><input name="' . $this->security->get_csrf_token_name() . '" value="' . $this->security->get_csrf_hash() . '" /></div>';
            $editform.='<input type="hidden" id="setting_edit" name="setting_edit" value="' . ($setting_detail[0]['semid']) . '" />';
            $editform.='<div class="col-sm-9 col-md-9 col-lg-10">';
			if($setting_id==100)
			{
				$editform.='<textarea class="form-control " rows="4" id="setting_val" name="setting_val">' . $setting_detail[0]['semfieldvalue'] . '</textarea>';
			}
			else
			{
				$editform.='<input class="form-control" type="text" id="setting_val" name="setting_val" value="' . $setting_detail[0]['semfieldvalue'] . '"/>';
			}
            
            $editform.='<span class="help-inline" style="color:#f00;display:none;" id="email_err">Please Enter Valied Email Id.</span>
                            <span class="help-inline" style="display:none;" id="numeric_err">Only Numeric Value Allowed.</span></div>';
            $editform.='<input class="btn btn-success" onclick="validate_submit(event);" type="submit" id="btn_save" name="btn_save" value="Save" />';
            $editform.='<div style="display:none; color:#f00;" id="errorMsg">Please enter ' . $setting_detail[0]['semfieldname'] . '</div>';

            $editform.='</form></div>';

            //  $editform.='<script><script>';

            echo $editform;
            die();
        } else {
            redirect('login', 'refresh');
        }
    }

    public function update() {
        if ($this->input->post()) {
            $setting_id = $this->input->post('setting_edit');
            $setting_val = $this->input->post('setting_val');

            $setting_id = ($setting_id);

            $this->load->model('settings');
            $settingdetail = $this->settings->getSemById($setting_id);

            $setting_array = array('semfieldvalue' => $setting_val);
            $update_result = $this->settings->update_sem($setting_id, $setting_array);

            if ($update_result == 1) {
                $this->session->set_flashdata('success', $settingdetail[0]['semfieldname'] . ' Updated Successfully.');
                redirect('sem', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again.');
                redirect('dashboard', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again.');
            redirect('login', 'refresh');
        }
    }

}


