<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Checkout extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

//        for cart session
        $this->load->library('cart');
//        $this->cart->destroy();
        $page_data = $this->common->select_data_by_id('pages', 'page_id', '6', '*');

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
        $this->data['title'] = 'Menu | Aangan Express';
//        $this->load->view('header');

        $this->load->model('logins');
        $this->load->helper('date');

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
        $start_time = $this->common->select_data_by_id('settings', 'setting_id', '12', '*');
        $end_time = $this->common->select_data_by_id('settings', 'setting_id', '13', '*');
        $current_time = now();
        $st_time = strtotime($start_time[0]['setting_value']) . '</br>';
        $end_time = strtotime($end_time[0]['setting_value']) . '</br>';
        $cur_time = time() . '</br>';
        $dw = date( "w", now());
        if ($this->uri->segment(2) != 'closed' && $this->uri->segment(2) != 'eventform' && $this->uri->segment(2) != 'eventadd') {
            if ($st_time <= $cur_time && $end_time >= $cur_time && $dw!=0 ) {}
            elseif ($this->session->userdata('eventid')!='') {}
        else{
           redirect(site_url('checkout/closed'), 'refresh');
        }
        }
    }

    //display Login form
    public function index() {

if (count($this->cart->contents())==0) {
    if(isset($_SERVER['HTTP_REFERER'])){
            redirect($_SERVER['HTTP_REFERER']);
    } else {
        redirect(site_url());
    }
        }
        if ($this->cart->contents()) {

            $customer_id = $this->session->userdata('aangan_customer');

            $contition_array = array('is_deleted' => '0', 'status' => 'Enable', 'customerid' => $customer_id, 'set_default' => 'yes');
            $this->data['default_address'] = $this->common->select_data_by_condition('cust_address', $contition_array, '*', 'edit_date', 'desc');


            $contition_array = array('is_deleted' => '0', 'status' => 'Enable', 'customerid' => $customer_id);
            $this->data['address_list'] = $this->common->select_data_by_condition('cust_address', $contition_array, '*', 'edit_date', 'desc');

            $contition_array = array('is_deleted' => '0', 'status' => 'Enable', 'customerid' => $customer_id);
            $this->data['user_detail'] = $this->common->select_data_by_condition('customer', $contition_array, '*', 'edit_date', 'desc');

            $this->data['setting'] = $this->common->select_data_by_condition('settings', array(), '*');

            $contition_array = array('eventid' => $this->session->userdata('eventid'));
            $this->data['event_detail'] = $this->common->select_data_by_condition('cust_event', $contition_array, '*');

            $this->load->view('checkout/index', $this->data);
        } else {
            redirect(site_url('menu'), 'refresh');
        }
    }

    public function eventform() {


        if (count($this->cart->contents())==0) {
            redirect($_SERVER['HTTP_REFERER']);
        }

        $customer_id = $this->session->userdata('aangan_customer');

        $contition_array = array('is_deleted' => '0', 'status' => 'Enable', 'customerid' => $customer_id);
        $this->data['user_detail'] = $this->common->select_data_by_condition('customer', $contition_array, '*', 'edit_date', 'desc');

        $contition_array = array('is_deleted' => '0', 'status' => 'Enable', 'customerid' => $customer_id, 'set_default' => 'yes');
        $this->data['default_address'] = $this->common->select_data_by_condition('cust_address', $contition_array, '*', 'edit_date', 'desc');

        $contition_array = array('eventid' => $this->session->userdata('eventid'));
        $this->data['event_detail'] = $event_detail = $this->common->select_data_by_condition('cust_event', $contition_array, '*');

//        print_r($event_detail);
//        die();

        $this->load->view('checkout/eventform', $this->data);
    }

    //add new user
    public function eventadd() {

        //check post and save data
        if ($this->input->post('btn_save')) {

            //  echo trim($this->input->post('event_date'));


            $date = date_create($this->input->post('event_date'));

            $event_date = date_format($date, "Y-m-d");


            $insert_array = array(
                'event_name' => trim($this->input->post('event_name')),
                'event_date' => $event_date,
                'event_time' => trim($this->input->post('event_time')),
                'adult' => trim($this->input->post('adult')),
                'child' => trim($this->input->post('child')),
                'con_per_1' => trim($this->input->post('con_per_1')),
                'con_mob_1' => trim($this->input->post('con_mob_1')),
                'con_email_1' => trim($this->input->post('con_email_1')),
                'con_per_2' => trim($this->input->post('con_per_2')),
                'con_mob_2' => trim($this->input->post('con_mob_2')),
                'con_email_2' => trim($this->input->post('con_email_2')),
                'know_about' => trim($this->input->post('know_about')),
                'special_note' => trim($this->input->post('special_note')),
                'insert_date' => date('Y-m-d H:i:s'),
                'insertip' => getHostByName(getHostName()),
                'edit_date' => date('Y-m-d H:i:s'),
                'editip' => getHostByName(getHostName())
            );

            $insert_result = $this->common->insert_data_getid($insert_array, 'cust_event');

            if ($this->input->post('redirect_url')) {
                $redirect_url = $this->input->post('redirect_url');
            } else {
                $redirect_url = site_url('checkout/index');
            }

            if ($insert_result) {
                $this->session->set_userdata('eventid', $insert_result); //session for event id 
                $this->session->set_flashdata('success', 'Event successfully inserted.');
                $redirect_url = site_url('checkout/index');
                redirect($redirect_url, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                $redirect_url = site_url('checkout/eventform');
                redirect($redirect_url, 'refresh');
            }
        }



//        $this->data['module_name'] = 'Event';
//        $this->data['section_title'] = 'Add New';
//
//        $this->load->view('checkout/index', $this->data);
    }

    public function user_address_add() {

        //check post and save data
        if ($this->input->is_ajax_request() && $this->input->post('first_name')) {
            $customername = trim($this->input->post('first_name')) . ' ' . trim($this->input->post('last_name'));

            $insert_array = array(
                'customer_name' => $customername,
                'contact_no' => trim($this->input->post('contact_no')),
                'post_code' => trim($this->input->post('post_code')),
                'daddress_1' => trim($this->input->post('daddress_1')),
                'daddress_2' => trim($this->input->post('daddress_2')),
                'dcity' => trim($this->input->post('dcity')),
                'dstate' => trim($this->input->post('dstate')),
                'insert_date' => date('Y-m-d H:i:s'),
                'insertip' => getHostByName(getHostName()),
                'edit_date' => date('Y-m-d H:i:s'),
                'editip' => getHostByName(getHostName())
                    //'level' => ($this->input->post('level')),
            );

            $insert_result = $this->common->insert_data_getid($insert_array, 'cust_address');

            if ($insert_result) {
                echo $insert_result;
            } else {
                echo "error";
            }
        } else {
            echo "mainelse";
        }
    }

    public function orderadd() {

        
        
        if ($this->input->post('first_name')) {

            $customername = trim($this->input->post('first_name')) . ' ' . trim($this->input->post('last_name'));

            $customerid = $this->session->userdata('aangan_customer');


            $address_id = '';
            if ($this->input->post('delivery') == 'delivery') {

                $time = $this->input->post('deliverytime');
                $finaldate = date('Y-m-d H:i:s', strtotime($time));
                
                if (!$this->input->post('address')) {

                    //insert record in address table                                    
                    $insert_array = array(
                        'customerid' => $customerid,
                        'customer_name' => $customername,
                        'contact_no' => trim($this->input->post('contact_no')),
                        'post_code' => trim($this->input->post('post_code')),
                        'daddress_1' => trim($this->input->post('daddress_1')),
                        'daddress_2' => trim($this->input->post('daddress_2')),
                        'dcity' => trim($this->input->post('dcity')),
                        'dstate' => trim($this->input->post('dstate')),
                        'insert_date' => date('Y-m-d H:i:s'),
                        'insertip' => getHostByName(getHostName()),
                        'edit_date' => date('Y-m-d H:i:s'),
                        'editip' => getHostByName(getHostName())
                            //'level' => ($this->input->post('level')),
                    );

                    $address_id = $this->common->insert_data_getid($insert_array, 'cust_address');
                } else {

                    $address_id = $this->input->post('address');
                }


                //insert record in order table
                $insert_array = array(
                    'order_no' => $this->order_no(5),
                    'customerid' => $customerid,
                    'addressid' => $address_id,
                    'total_amount' => $this->cart->total(),
                    'delivery_time' => $finaldate,
                    'order_date_time' => date('Y-m-d H:i:s'),
                    'delivery' => $this->input->post('delivery'),
                    'insert_date' => date('Y-m-d H:i:s'),
                    'insertip' => getHostByName(getHostName()),
                    'edit_date' => date('Y-m-d H:i:s'),
                    'editip' => getHostByName(getHostName())
                        //'level' => ($this->input->post('level')),
                );

                $insert_order = $this->common->insert_data_getid($insert_array, 'order');
            } elseif ($this->input->post('delivery') == 'pickup') {

                $time = $this->input->post('time');
                $finaldate = date('Y-m-d H:i:s', strtotime($time));
                
                //insert record in order table
                $insert_array = array(
                    'order_no' => $this->order_no(5),
                    'customerid' => $customerid,
                    'total_amount' => $this->cart->total(),
                    'pickup_time' => $finaldate,
                    'order_date_time' => date('Y-m-d H:i:s'),
                    'delivery' => $this->input->post('delivery'),
                    'insert_date' => date('Y-m-d H:i:s'),
                    'insertip' => getHostByName(getHostName()),
                    'edit_date' => date('Y-m-d H:i:s'),
                    'editip' => getHostByName(getHostName())
                        //'level' => ($this->input->post('level')),
                );

                $insert_order = $this->common->insert_data_getid($insert_array, 'order');
            }

            $update_array = array(
                'contact_no' => trim($this->input->post('contact_no')),
            );

            $update_contact = $this->common->update_data($update_array, 'customer', 'customerid', $this->session->userdata('aangan_customer'));




            //insert record in order_item table

            foreach ($this->cart->contents() as $item) {

                if ($item['options']['dish'] == "null") {
                    $eventid = 0;
                } else {
                    $eventid = $this->session->userdata('eventid');
                }

                $insert_array1 = array(
                    'orderid' => $insert_order,
                    'menuid' => $item['id'],
                    'eventid' => $eventid,
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'total' => $item['subtotal'],
                    'type' => $item['options']['type'],
                    'dish' => $item['options']['dish'],
                    'insert_date' => date('Y-m-d H:i:s'),
                    'insertip' => getHostByName(getHostName()),
                    'edit_date' => date('Y-m-d H:i:s'),
                    'editip' => getHostByName(getHostName())
                        //'level' => ($this->input->post('level')),
                );

                $insert_item = $this->common->insert_data($insert_array1, 'order_item');
            }

            if ($insert_order) {

                $setting = $this->common->select_data_by_condition('settings', array(), '*');

                $emailsetting = $this->common->select_data_by_condition('emailsetting', array(), '*');

                $condition_array = array('emailid' => '4');
                $emailformat = $this->common->select_data_by_condition('emails', $condition_array, '*');



                $contition_array = array('is_deleted' => '0', 'status' => 'Enable', 'addressid' => $address_id);
                $address_detail = $this->common->select_data_by_condition('cust_address', $contition_array, '*', 'edit_date', 'desc');

                $contition_array = array('is_deleted' => '0', 'status' => 'Enable', 'customerid' => $this->session->userdata('aangan_customer'));
                $user_detail = $this->common->select_data_by_condition('customer', $contition_array, '*', 'edit_date', 'desc');

                $contition_array = array('orderid' => $insert_order);


                $short_by = "insert_date";
                $order_by = "desc";
                $limit = "";
                $offset = "";

                $join_str[0]['table'] = 'menu';
                $join_str[0]['join_table_id'] = 'menu.menuid';
                $join_str[0]['from_table_id'] = 'order_item.menuid';
                $join_str[0]['join_type'] = '';


                $order_item_details = $this->common->select_data_by_condition('order_item', $contition_array, '*', $short_by, $order_by, $limit, $offset, $join_str);

                $order_detail = $this->common->select_data_by_condition('order', $contition_array, '*');

                $orderitems = '<table border="1" cellpadding="0" cellspacing="0"><tbody><tr><td><p><strong>Item Name</strong></p></td><td style="text-align: right;"><p><strong>Item Price</strong></p></td><td style="text-align: right;"><p><strong>Qty</strong></p></td><td style="text-align: right;"><p><strong>Subtotal</strong></p></td></tr>';

                foreach ($order_item_details as $order_item) {
                    $orderitems.='<tr><td><p><strong>';
                    $orderitems.=$order_item['menu_title'];
                    if($order_item['type'] != 'null'){
                        $orderitems.='<br>('.$order_item['type'].')';
                    } else { $orderitems.='<br>'; }
                    if($order_item['dish'] != 'null'){
                        $orderitems.='('.$order_item['dish'].')';
                    }
                    $orderitems.='</strong></p></td><td style="text-align: right;"><p>$ ';
                    $orderitems.=$order_item['price'];
                    $orderitems.='</p></td><td style="text-align: right;"><p>';
                    $orderitems.=$order_item['qty'];
                    $orderitems.='</p></td><td style="text-align: right;"><p>$ ';
                    $orderitems.=$order_item['total'];
                    $orderitems.='</p></td></tr>';
                }

                $orderitems.='<tr><td style="text-align: right;"><p>Order total</p></td><td colspan="3" style="text-align: right;"><p>$ ' . $order_detail[0]['total_amount'] . '</p></td></tr></tbody></table>';

                $name = $user_detail[0]['customername'];

                if (isset($user_detail[0]['contact_no'])) {
                    $contact = $user_detail[0]['contact_no'];
                } else {
                    $contact = '';
                }
                if (count($address_detail) > 0) {
                    $type = 'Address';
                    if (isset($address_detail[0]['daddress_2'])) {
                        $address = $address_detail[0]['daddress_1'] . "," . $address_detail[0]['daddress_2'] . "," . $address_detail[0]['dcity'] . "," . $address_detail[0]['dstate'];
                    } else {
                        $address = $address_detail[0]['daddress_1'] . "," . $address_detail[0]['dcity'] . "," . $address_detail[0]['dstate'];
                        
                    }
                    $delivery_date = "Delivery Date: ".date('d-M-Y',  strtotime($order_detail[0]['delivery_time']));
                    $delivery_time = "Delivery Time: ".date('h:i a',  strtotime($order_detail[0]['delivery_time']));
                } else {
                    $address = date('h:i a',  strtotime($order_detail[0]['pickup_time']));
                    $type = 'Pickup Time';
                    $delivery_date = '';
                    $delivery_time = '';
                }
                
                $time = date('M d, Y h:i:s A T');        
                
                $mail_body = $emailformat[0]['varmailformat'];

                $mail_body = str_replace("%name%", ucfirst($name), str_replace("%contact%", $contact, str_replace("%cust_address%", $address, str_replace("%order_delivery_date%", $delivery_date, str_replace("%order_delivery_time%", $delivery_time, str_replace("%cust_type%", $type, str_replace("%orderno%", $order_detail[0]['order_no'], str_replace("%time%", $time, str_replace("%orderitems%", $orderitems, stripslashes($mail_body))))))))));

                $cc = $emailsetting[4]['settingvalue'];

                $this->sendEmail($name, $emailsetting[5]['settingvalue'], $emailformat[0]['varsubject'], $mail_body, $cc);
                
                $mail_sent = $this->sendEmail($name, $user_detail[0]['email'], $emailformat[0]['varsubject'], $mail_body);


                if ($mail_sent) {
                    $this->cart->destroy();
                    $this->session->set_flashdata('orderid', $insert_order);
                    $redirect_url = site_url('checkout/thankyou/');
                    redirect($redirect_url, 'refresh');
                } else {
                    $this->cart->destroy();
                    $this->session->set_flashdata('orderid', $insert_order);
                    $redirect_url = site_url('checkout/thankyou/');
                    redirect($redirect_url, 'refresh');
                }
            }
        }
    }

    public function getaddress() {

        if ($this->input->is_ajax_request() && $this->input->post('addressid')) {

            $contition_array = array('is_deleted' => '0', 'status' => 'Enable', 'addressid' => $this->input->post('addressid'));
            $address_detail = $this->common->select_data_by_condition('cust_address', $contition_array, '*', 'edit_date', 'desc');

            $contactno = $address_detail[0]['contact_no'];
            $street1 = $address_detail[0]['daddress_1'];
            $street2 = $address_detail[0]['daddress_2'];
            $city = $address_detail[0]['dcity'];
            $state = $address_detail[0]['dstate'];
            $post_code = $address_detail[0]['post_code'];
            echo $contactno . "||" . $street1 . "||" . $street2 . "||" . $city . "||" . $state . "||" . $post_code;

            die();
        }
    }

    public function captcha() {

        $this->load->view('checkout/captcha', $this->data);
    }

    public function validate_capcha() {

        if ($this->input->is_ajax_request() && $this->input->post('capcha')) {

            session_start();
            $cap = $this->input->post('capcha');
            if (!empty($cap)) {

                if ($_SESSION['captcha'] == $this->input->post('capcha')) {
                    echo 'true';
                    die();
                } else {
                    echo 'false';
                    die();
                }
            }
        }
    }

    public function thankyou() {
        //$id='';
        //$this->session->set_flashdata('orderid', '26');
        $id = $this->session->flashdata('orderid');
        if ($id != '') {
            $short_by = "insert_date";
            $order_by = "desc";
            $limit = "";
            $offset = "";

            $contition_array = array('order_item.orderid' => $id, 'order_item.is_deleted' => '0');

            $join_str[0]['table'] = 'menu';
            $join_str[0]['join_table_id'] = 'menu.menuid';
            $join_str[0]['from_table_id'] = 'order_item.menuid';
            $join_str[0]['join_type'] = '';


            $this->data['order_item_details'] = $this->common->select_data_by_condition('order_item', $contition_array, '*', $short_by, $order_by, $limit, $offset, $join_str);

            $contition_array = array('orderid' => $id, 'order.is_deleted' => '0');
            $this->data['order_detail'] = $order_detail = $this->common->select_data_by_condition('order', $contition_array, '*');

            $this->data['address_detail'] = '';
            $contition_array = array('addressid' => $order_detail[0]['addressid'], 'is_deleted' => '0');
            $this->data['address_detail'] = $this->common->select_data_by_condition('cust_address', $contition_array, '*');

            $contition_array = array('customerid' => $order_detail[0]['customerid'], 'is_deleted' => '0');
            $this->data['customer_detail'] = $this->common->select_data_by_condition('customer', $contition_array, '*');

            $contition_array = array();
            $this->data['admin_detail'] = $this->common->select_data_by_condition('settings', $contition_array, '*');

            $contition_array = array('eventid' => $this->session->userdata('eventid'));
            $this->data['event_detail'] = $this->common->select_data_by_condition('cust_event', $contition_array, '*');

            $this->session->unset_userdata('eventid');

            if (!$this->data['order_item_details']) {
                redirect(site_url(), 'refresh');
            }

            $this->load->view('checkout/thankyou', $this->data);
        } else {
            redirect(site_url(), 'refresh');
        }
    }

    public function order_no($length = '5') {
        $contition_array = array('id' => '1');
        $last_order_no = $this->common->select_data_by_condition('last_order_id', $contition_array, '*');
        if (isset($last_order_no[0]['last_order_id'])) {
            $order_no = $last_order_no[0]['last_order_id'];
        } else {
            $order_no = 0;
        }
        $order_no = $order_no + 1;
        $order_no = str_pad($order_no, $length, "0", STR_PAD_LEFT);  // produces "0001"
        $update_array = array(
            'last_order_id' => $order_no,
        );

        $update_contact = $this->common->update_data($update_array, 'last_order_id', 'id', '1');
        return 'AGN-' . $order_no;
    }

    public function closed() {
        $this->data['page_data'] = $this->common->select_data_by_id('pages', 'page_id', '7', '*');
        $this->load->view('checkout/closed', $this->data);
    }

}

?>