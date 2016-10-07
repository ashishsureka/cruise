<?php

    //site setting details
    $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
    $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];

    $this->data['user_id'] = $this->session->userdata('cruise_user');
    
    $this->data['head'] = $this->load->view('common/head', $this->data, true);
    $this->data['header'] = $this->load->view('common/header', $this->data, true);
    $this->data['footer'] = $this->load->view('common/footer', $this->data, true);

    
    
?>
