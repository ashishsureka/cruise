<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Myaccount extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();
        
        if(!$this->session->userdata('aangan_customer')){
            redirect(site_url('home'), 'refresh');
        }
        
//        for cart session
        $this->load->library('cart');
//        $this->cart->destroy();
        $page_data = $this->common->select_data_by_id('pages', 'page_id', '6', '*');
        
        $this->data['metatag_title'] = $metatag_title = $page_data[0]['metatag_title'];
        $this->data['metatag_keywords'] = $metatag_keywords = $page_data[0]['metatag_keywords'];
        $this->data['metatag_description'] = $metatag_description = $page_data[0]['metatag_description'];
        $this->data['page_image'] = $image = $page_data[0]['image'];
        
        include_once 'include.php';

        //paging
        $this->load->library('pagination');
        $this->config->load('paging', TRUE);
        $this->paging = $this->config->item('paging');
        
        //set header, footer and leftmenu
        $this->data['title'] = 'Menu | Aangan Express';

        //remove catch so after logout cannot view last visited page if that page is this
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    //display Login form
    public function index() {

        $contition_array = array('order.is_deleted' => '0', 'order.customerid' => $this->session->userdata('aangan_customer'));
        $short_by = "order_date_time";
        $order_by = "desc";
        $limit = "5";
        $offset = "";
        
            $join_str1[0]['table'] = 'cust_address';
            $join_str1[0]['join_table_id'] = 'cust_address.addressid';
            $join_str1[0]['from_table_id'] = 'order.addressid';
            $join_str1[0]['join_type'] = 'left';

        $this->data['recent_order_list'] = $this->common->select_data_by_condition('order', $contition_array, 'cust_address.*,order.status as order_status,order.*', $short_by, $order_by, $limit, $offset, $join_str1);
        
        // ---------------------------------------- //
        
        $contition_array = array('is_deleted' => '0', 'status' => 'Enable', 'customerid' => $this->session->userdata('aangan_customer') );
        $this->data['user_detail'] = $this->common->select_data_by_condition('customer', $contition_array, '*', 'edit_date', 'desc');
        
        $contition_array = array('is_deleted' => '0', 'status' => 'Enable', 'customerid' => $this->session->userdata('aangan_customer') );
        $this->data['address_list'] = $this->common->select_data_by_condition('cust_address', $contition_array, '*', 'edit_date', 'desc');
        
        $contition_array = array('is_deleted' => '0', 'status' => 'Enable', 'customerid' => $this->session->userdata('aangan_customer'), 'set_default' => 'yes' );
        $this->data['address_default'] = $this->common->select_data_by_condition('cust_address', $contition_array, '*', 'edit_date', 'desc');
        
       
        
        // ---------------------------------------- //                        
        
        $this->paging['per_page'] = 10;
        $limit = $this->paging['per_page'];
        
            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
            $order_by = "desc";
        $this->data['offset'] = $offset;
        $this->paging['uri_segment'] = 3;

        $contition_array = array('order.is_deleted' => '0', 'order.customerid' => $this->session->userdata('aangan_customer'));                                   
        $this->data['order_lists'] = $this->common->select_data_by_condition('order', $contition_array, 'cust_address.*,order.status as order_status,order.*', $short_by, $order_by, $limit, $offset, $join_str1);
    
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['base_url'] = site_url("myaccount/index/" . $short_by . "/" . $order_by);
        } else {
            $this->paging['base_url'] = site_url("myaccount/index/");
        }
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['uri_segment'] = 5;
        } else {
            $this->paging['uri_segment'] = 3;
        }
        $this->paging['total_rows']= $this->data['count'] = count($this->common->select_data_by_condition('order', $contition_array, '*', $short_by, $order_by, '', '', $join_str1));
        
        $this->pagination->initialize($this->paging);
        
        
        $this->load->view('myaccount/index',$this->data);
    }
    
    
    //display Order Details
    public function view_order() {
            

        if ($this->input->is_ajax_request() && $this->input->post('orderid')) {
        
             
             $short_by = "insert_date";
             $order_by = "desc";
             $limit = "";
             $offset = "";
             
        $contition_array = array('orderid' => $this->input->post('orderid'),'order_item.is_deleted' => '0');
        
            $join_str[0]['table'] = 'menu';
            $join_str[0]['join_table_id'] = 'menu.menuid';
            $join_str[0]['from_table_id'] = 'order_item.menuid';
            $join_str[0]['join_type'] = '';
            
        $order_item_details = $this->common->select_data_by_condition('order_item', $contition_array, '*', $short_by, $order_by, $limit, $offset, $join_str);        
        
        $contition_array = array('orderid' => $this->input->post('orderid'),'order.is_deleted' => '0');
        $short_by = "order_date_time";
        
            $join_str1[0]['table'] = 'cust_address';
            $join_str1[0]['join_table_id'] = 'cust_address.addressid';
            $join_str1[0]['from_table_id'] = 'order.addressid';
            $join_str1[0]['join_type'] = 'left';
        
        $order_detail = $this->common->select_data_by_condition('order', $contition_array, 'cust_address.*,order.status as order_status,order.*', $short_by, $order_by, $limit, $offset, $join_str1);
        
        $contition_array = array('eventid' => $order_item_details[0]['eventid']);
        $order_event = $this->common->select_data_by_condition('cust_event', $contition_array, '*');
       
        
        $data="<p class='pull-left'>Order No : ".$order_detail[0]['order_no']."</p>";
        $data.="<p class='pull-right'>Order Date : ".date('d-m-Y',  strtotime($order_detail[0]['order_date_time']))."</p>";
        $data.="<table border='1' class='table'>";        
        $data.="<tr>";
        $data.="<th>Item Name</th>";        
        $data.="<th>Taste</th>";
        if($order_item_details[0]['dish'] != 'null'){
        $data.="<th>Tray Size</th>";  
        }
        $data.="<th style='text-align: right'>Quantity</th>";
        $data.="<th style='text-align: right'>Unit Price</th>";
        $data.="<th style='text-align: right'>Total Price</th>";
        $data.="</tr>";
        
        
        foreach($order_item_details as $order_item_detail) {
            
            //$data="<table>";
            $colspan=5;
            $data.="<tr>";
            $data.="<td>".$order_item_detail['menu_title']."</td>";            
            if($order_item_detail['type'] != 'null'){
                $data.="<td>".$order_item_detail['type']."</td>";
            } else {
                $data.="<td>normal</td>";
            }
            if($order_item_detail['dish'] != 'null'){
                $data.="<td>".$order_item_detail['dish']."</td>";                
            } else {
                $colspan=4;
            }
            $data.="<td style='text-align: right'>".$order_item_detail['qty']."</td>";
            $data.="<td style='text-align: right'>$ ".$order_item_detail['price']."</td>";
            $data.="<td style='text-align: right'>$ ".$order_item_detail['total']."</td>";                        
            $data.="</tr>";            
        }
        
        $data.="<tr>";
        if($order_detail[0]['delivery'] == 'pickup') {
            $time = date('h:i a',  strtotime($order_detail[0]['pickup_time']));
            
            $data.="<td>Pickup Time</td>";
            $data.="<td colspan='".$colspan."' >".$time."</td>";
            
            
        } elseif ($order_detail[0]['delivery'] == 'delivery') {
            $time = date('h:i a',  strtotime($order_detail[0]['delivery_time']));
            $data.="<td>Delivery Time</td>";
            $data.="<td colspan='".$colspan."' >".$time."</td>";
            $data.="</tr><tr>";
            $data.="<td>Delivery Address</td>";
            if(isset($order_detail[0]['daddress_2'])){
                $data.="<td colspan='".$colspan."' >".$order_detail[0]['daddress_1'].",".$order_detail[0]['daddress_2'].",".$order_detail[0]['dcity'].",".$order_detail[0]['dstate']."</td>";    
            } else {
                $data.="<td colspan='".$colspan."' >".$order_detail[0]['daddress_1'].",".$order_detail[0]['dcity'].",".$order_detail[0]['dstate']."</td>";    
            }
        
        }
        $data.="</tr>";
        $data.="</table>";

        if($order_event) {
            $data.="Event Name : ".$order_event[0]['event_name']."<br>";
            $data.="Event Date : ". date('d M Y',  strtotime($order_event[0]['event_date']))."<br>";
            $data.="People Count : ".$order_event[0]['adult']."<br>";
            $data.="Children Count : ".$order_event[0]['child']."<br>";
        $data.="<table border='1' class='table'>";      
        $data.="<tr><td colspan='3' style='text-align:center'>Contact Person Detail</td></tr>";
        $data.="<tr>";
        $data.="<th>Name</th>";        
        $data.="<th>Email</th>";
        $data.="<th>Contact No</th>";          
        $data.="</tr>";
        $data.="<tr>";
        $data.="<td>".$order_event[0]['con_per_1']."</td>";        
        $data.="<td>".$order_event[0]['con_email_1']."</td>";
        $data.="<td>".$order_event[0]['con_mob_1']."</td>";          
        $data.="</tr>";            
            if(isset($order_event[0]['con_per_2']) && $order_event[0]['con_per_2'] != '') {
                $data.="<tr>";
                $data.="<td>".$order_event[0]['con_per_2']."</td>";        
                $data.="<td>".$order_event[0]['con_email_2']."</td>";
                $data.="<td>".$order_event[0]['con_mob_2']."</td>";          
                $data.="</tr>"; 
            }
        }
        $data.="</table>";
        echo $data;
        die();
        
        }
        
        
    }
   
    
        //Reorder
    public function reorder($id = '') {
                
             $short_by = "insert_date";
             $order_by = "desc";
             $limit = "";
             $offset = "";
             
        $contition_array = array('orderid' => $id,'order_item.is_deleted' => '0');
        
            $join_str[0]['table'] = 'menu';
            $join_str[0]['join_table_id'] = 'menu.menuid';
            $join_str[0]['from_table_id'] = 'order_item.menuid';
            $join_str[0]['join_type'] = '';
            

        $order_item_details = $this->common->select_data_by_condition('order_item', $contition_array, '*', $short_by, $order_by, $limit, $offset, $join_str);        
        
        foreach($order_item_details as $order_item_detail) {
            
            if($order_item_detail['type'] == 'null'){
                $dish_type = 0;
            } else {
                $dish_type = 1;
            }
            
                $option=array('dish_type'=>$dish_type,'type'=>$order_item_detail['type'],'dish'=>$order_item_detail['dish']);
                
                $cart_data = array(
                    'id'      => $order_item_detail['menuid'],
                    'qty'     => $order_item_detail['qty'],
                    'price'   => $order_item_detail['price'],
                    'name'    => $order_item_detail['menu_title'],
                    'options' => $option
                );
                $this->cart->insert($cart_data);
        }        
        if($this->cart->contents()){
            //$this->session->set_flashdata('success', 'Registration successful, Please check your mail for varification !!!');
            redirect(site_url('menu'), 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect(site_url('myaccount'), 'refresh');
        }
        
    }
    
        //Cancel Order
    public function cancel_order($id = '') {
                
        
    if($this->input->post('delete_item')){
        
        foreach($this->input->post('delete_item') as $delete_id) {                
        
        $update_array = array(
                
                'is_deleted' =>'1',                
                
            );
            
            $delete_order_item = $this->common->update_data($update_array, 'order_item', 'order_item_id', $delete_id);
        }
        
            $contition_array = array('orderid' => $this->input->post('orderid'),'order_item.is_deleted' => '0');
        
            $get_order_item = $this->common->select_data_by_condition('order_item', $contition_array, '*');
            
        if(!$get_order_item) {
            $update_array = array(
                
                'is_deleted' =>'1',                
                
            );
            
            $delete_order = $this->common->update_data($update_array, 'order', 'orderid', $this->input->post('orderid'));
        }
        
if($delete_order_item) {      
    
            $setting = $this->common->select_data_by_condition('settings', array(), '*');
        
            $emailsetting = $this->common->select_data_by_condition('emailsetting', array(), '*');

            $condition_array=array('emailid' => '5');
            $emailformat = $this->common->select_data_by_condition('emails', $condition_array, '*');

        $contition_array = array('orderid' => $this->input->post('orderid'));
        
        
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
        
        $contition_array = array('is_deleted' => '0', 'status' => 'Enable', 'addressid' => $order_detail[0]['addressid'] );
        $address_detail = $this->common->select_data_by_condition('cust_address', $contition_array, '*', 'edit_date', 'desc');
           
        $contition_array = array('is_deleted' => '0', 'status' => 'Enable', 'customerid' => $order_detail[0]['customerid'] );
        $user_detail = $this->common->select_data_by_condition('customer', $contition_array, '*', 'edit_date', 'desc');   
        
        $orderitems='<table border="1" cellpadding="0" cellspacing="0"><tbody><tr><td><p><strong>Item Name</strong></p></td><td style="text-align: right;"><p><strong>Item Price</strong></p></td><td style="text-align: right;"><p><strong>Qty</strong></p></td><td style="text-align: right;"><p><strong>Subtotal</strong></p></td></tr>';
	
        foreach($order_item_details as $order_item) {
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
		
	$orderitems.='<tr><td style="text-align: right;"><p>Order total</p></td><td colspan="3" style="text-align: right;"><p>$ '.$order_detail[0]['total_amount'].'</p></td></tr></tbody></table>';	
	
        $name = $user_detail[0]['customername'];
        
        if(isset($user_detail[0]['contact_no'])){
            $contact = $user_detail[0]['contact_no'];
        } else {
            $contact = '';
        }
        
        if(count($address_detail) > 0) {
            $type = 'Address';
            if(isset($address_detail[0]['daddress_2'])){
                $address = $address_detail[0]['daddress_1'].",".$address_detail[0]['daddress_2'].",".$address_detail[0]['dcity'].",".$address_detail[0]['dstate'];
            } else {
                $address = $address_detail[0]['daddress_1'].",".$address_detail[0]['dcity'].",".$address_detail[0]['dstate'];
            }
            $delivery_date = "Delivery Date: ".date('d-M-Y',  strtotime($order_detail[0]['delivery_time']));
            $delivery_time = "Delivery Time: ".date('h:i a',  strtotime($order_detail[0]['delivery_time']));
        } else {
            $address = date('h:i a',  strtotime($order_detail[0]['pickup_time']));
            $type = 'Pickup Time';
            $delivery_date = '';
            $delivery_time = '';
        }        
        
        $mail_body = $emailformat[0]['varmailformat'];
        
        $mail_body = str_replace("%name%", ucfirst($name), str_replace("%contact%", $contact, str_replace("%cust_address%", $address, str_replace("%order_delivery_date%", $delivery_date, str_replace("%order_delivery_time%", $delivery_time, str_replace("%cust_type%", $type, str_replace("%orderno%", $order_detail[0]['order_no'], str_replace("%orderitems%", $orderitems, stripslashes($mail_body)))))))));
        
        $cc=$emailsetting[4]['settingvalue'];       
        
        $this->sendEmail($name,$emailsetting[5]['settingvalue'],$emailformat[0]['varsubject'],$mail_body,$cc);
        
        $mail_sent=$this->sendEmail($name,$user_detail[0]['email'],$emailformat[0]['varsubject'],$mail_body);       

            //$this->session->set_flashdata('success', 'Registration successful, Please check your mail for varification !!!');
            redirect(site_url('myaccount'), 'refresh');
            
        } else {
  
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect(site_url('myaccount'), 'refresh');
        }

    }                                  
        
             $short_by = "insert_date";
             $order_by = "desc";
             $limit = "";
             $offset = "";
             
        $contition_array = array('orderid' => $id,'order_item.is_deleted' => '0');
        
            $join_str[0]['table'] = 'menu';
            $join_str[0]['join_table_id'] = 'menu.menuid';
            $join_str[0]['from_table_id'] = 'order_item.menuid';
            $join_str[0]['join_type'] = '';
            

            $this->data['order_item_details'] = $this->common->select_data_by_condition('order_item', $contition_array, '*', $short_by, $order_by, $limit, $offset, $join_str);
        
        $contition_array = array('orderid' => $id,'order.is_deleted' => '0');
        $short_by = "order_date_time";
        
            $join_str1[0]['table'] = 'cust_address';
            $join_str1[0]['join_table_id'] = 'cust_address.addressid';
            $join_str1[0]['from_table_id'] = 'order.addressid';
            $join_str1[0]['join_type'] = '';
        
        $this->data['order_detail'] = $this->common->select_data_by_condition('order', $contition_array, 'cust_address.*,order.status as order_status', $short_by, $order_by, $limit, $offset, $join_str1);
        
        $this->load->view('myaccount/cancel',$this->data);
        
    }    
    
        //Reorder
    public function update_profile() {
        
        
        if($this->input->post())  {   
            
            $customername=trim($this->input->post('firstname')).' '.trim($this->input->post('lastname'));
            $user_id = ($this->session->userdata('aangan_customer'));
            
            if($this->input->post('old_password') && $this->input->post('new_password') && $this->input->post('confirm_password')) {
                                        
            $old_password=$this->input->post('old_password');
            $new_password=  $this->input->post('new_password');
            $check_result = $this->common->select_data_by_id('customer','customerid', $user_id);
            if($check_result[0]['password'] === md5($old_password)){                
                $update_array = array(
                
                'customername' => $customername,
                'password'=>  md5($new_password),
                'email' => trim($this->input->post('email')),                
                'edit_date' => date('Y-m-d H:i:s'),
                'editip' => getHostByName(getHostName())
                //'level' => ($this->input->post('level')),
                
                );
            }
                
            } else {            
                                         
            $update_array = array(
                
                'customername' => $customername,
                'email' => trim($this->input->post('email')),                
                'edit_date' => date('Y-m-d H:i:s'),
                'editip' => getHostByName(getHostName())
                //'level' => ($this->input->post('level')),
                
                );
            
            }
                        
            $update_result = $this->common->update_data($update_array, 'customer','customerid',$user_id);
            
        if($update_result){
            //$this->session->set_flashdata('success', 'Registration successful, Please check your mail for varification !!!');
            redirect(site_url('myaccount'), 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect(site_url('myaccount'), 'refresh');
        }
            
        }
 
    }  
    
    
    //check old password
    public function check_old_pass() {
        if ($this->input->is_ajax_request() && $this->input->post('old_password')) {
           
            $user_id = ($this->session->userdata('aangan_customer'));
            $old_pass = $this->input->post('old_password');
            
            $check_result = $this->common->select_data_by_id('customer','customerid',$this->session->userdata('aangan_customer'));
            if ($check_result[0]['password'] === md5($old_pass)) {
                echo 'true';
                die();
            } else {
                echo 'false';
                die();
            }
        }
    }    
    
        //Set Default Address
    public function set_default_addr() {
                
        if ($this->input->is_ajax_request() && $this->input->post('addressid')) {
            
            $contition_array = array('is_deleted' => '0', 'status' => 'Enable', 'customerid' => $this->session->userdata('aangan_customer') );
            $address_list = $this->common->select_data_by_condition('cust_address', $contition_array, '*', 'edit_date', 'desc');
           
            foreach($address_list as $address){
                
                $update_array1 = array(
                
                'set_default' => 'no',
                
                );
            
            $update_result1 = $this->common->update_data($update_array1, 'cust_address','addressid',$address['addressid']);
            }
            
            $update_array = array(
                
                'set_default' => 'yes',
                
                );
            
            $update_result = $this->common->update_data($update_array, 'cust_address','addressid',$this->input->post('addressid'));
            
            if ($update_result) {
                echo 'true';
                die();
            } else {
                echo 'false';
                die();
            }
        }
        
    }    
    
    public function get_address() {
        
    if ($this->input->is_ajax_request() && $this->input->post('id')) {
        
            
        
        $contition_array = array('addressid' => $this->input->post('id'),'is_deleted' => '0');                
        $address_detail = $this->common->select_data_by_condition('cust_address', $contition_array, '*');    
        
        $data=$address_detail[0]['addressid']."||";
        $data.=$address_detail[0]['daddress_1']."||";
        $data.=$address_detail[0]['daddress_2']."||";
        $data.=$address_detail[0]['dcity']."||";
        $data.=$address_detail[0]['dstate']."||";
        $data.=$address_detail[0]['post_code'];
        
        print_r($data);
        die();
        
    } 

        
     
    }  
    
    public function update_address() {
        
        
        if($this->input->post('address_id'))  {   
            
            
                $update_array = array(
                
                'daddress_1' => trim($this->input->post('daddress_1')),
                'daddress_2'=>  trim($this->input->post('daddress_2')),
                'dcity' => trim($this->input->post('dcity')),
                'dstate' => trim($this->input->post('dstate')),
                'post_code' => trim($this->input->post('post_code')),
                'edit_date' => date('Y-m-d H:i:s'),
                'editip' => getHostByName(getHostName())                
                
                );
            
                        
            $update_result = $this->common->update_data($update_array, 'cust_address','addressid',$this->input->post('address_id'));
            
        if($update_result){
            //$this->session->set_flashdata('success', 'Registration successful, Please check your mail for varification !!!');
            redirect(site_url('myaccount'), 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect(site_url('myaccount'), 'refresh');
        }
            
        }
 
    }      
    
}

?>