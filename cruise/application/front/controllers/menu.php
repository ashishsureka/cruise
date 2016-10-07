<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Menu extends CI_Controller {

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
        
        $this->data['current_page'] = "menu";
//        $this->load->view('header');

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
        
        $contition_array = array('is_deleted' => '0','parent_id'=>'1','status'=>'Enable');

        $this->data['category_list'] = $this->common->select_data_by_condition('category', $contition_array, '*');
        
        
        
//        echo "<pre>";
//        print_r($this->data['category_list']);
//        die();
        
        $this->load->view('menu/index',$this->data);
    }
    public function addcart() {
     
        
//    echo menu_cart($id);
        if ($this->input->is_ajax_request() && $this->input->post('id')) {
           if($this->session->userdata('eventid')!='')
           {
            $this->session->unset_userdata('eventid');
           }
      
            $id=$this->input->post('id');
            
            
            foreach($this->cart->contents() as $cart_list){
                    
                    if ($cart_list['options']['dish']!='null') {
                        
                        echo 'false';
                        die();
                    }
                }
            
            
            $data='menuid,menu_title,dish_type,menu_price';
            $item=$this->common->select_data_by_id('menu', 'menuid', $id,$data);
            
            $exists=1;
            if(count($this->cart->contents())){ //check product all ready exist or not
               
                foreach($this->cart->contents() as $cart_item){

                    if ($id==$cart_item['id']) {
                        $qty=++$cart_item['qty'];

                        $cart_data=array(
                             'rowid' => $cart_item['rowid'],
                             'qty'   => $qty

                        );
                        $this->cart->update($cart_data);
                        $exists =0;
                    }
                }
            }
            
            

            if($exists){
                
                if($item[0]['dish_type']){
                    $option=array('dish_type'=>$item[0]['dish_type'],'type'=>'normal','dish'=>'null');
                }else{
                    $option=array('dish_type'=>$item[0]['dish_type'],'type'=>'null','dish'=>'null');
                }
                
                
                $cart_data = array(
                    'id'      => $item[0]['menuid'],
                    'qty'     => 1,
                    'price'   => $item[0]['menu_price'],
                    'name'    => $item[0]['menu_title'],
                    'options' => $option
                );
                $this->cart->insert($cart_data);
                
            }
//         
            if(0){
                echo '<pre>';
                print_r($this->cart->contents());
            }else{
                echo menu_cart(1);
            }
            die();
        }
    }
    
    public function change_type() {
    
        if ($this->input->is_ajax_request() && $this->input->post('id')) {
            $id=$this->input->post('id');
            $array=explode('_', $id);
            $dish=$this->cart->contents()[$array[1]]['options']['dish'];
          
            $cart_data=array(
                'rowid' => $array[1],
                'qty'=>$this->cart->contents()[$array[1]]['qty'],
                'options'   => $this->cart->_cart_contents[$array[1]]['options'] = array('dish_type'=>'1','type'=>$array[0],'dish'=>$dish)
            );
            $this->cart->update($cart_data);
            
           
            if(0){
                echo '<pre>';
                print_r($this->cart->contents());
            }else{
                echo menu_cart(1);
            }
            die();
        }
    }
    public function changeqty() {
        if ($this->input->is_ajax_request() && $this->input->post('id') && $this->input->post('value')) {
            $id=$this->input->post('id');
            $value=$this->input->post('value');
           
            if($value=='+'){
                $qty=$this->cart->contents()[$id]['qty'] + 1;
            }elseif($value=='-'){
                $qty=$this->cart->contents()[$id]['qty'] - 1;
            } else {                
                $qty = $value;                
            }
            $cart_data=array(
                'rowid' => $id,
                'qty'=>$qty,
            );
            $this->cart->update($cart_data);

            if(0){
                echo '<pre>';
                print_r($this->cart->contents());
            }else{
                echo menu_cart(1);
            }
            die();
        }
    }
    public function deleteitem() {
        if ($this->input->is_ajax_request() && $this->input->post('id')) {
            $id=$this->input->post('id');
            $value=$this->input->post('value');
           
           
            $cart_data=array(
                'rowid' => $id,
                'qty'=>0,
            );
            $this->cart->update($cart_data);

            if(0){
                echo '<pre>';
                print_r($this->cart->contents());
            }else{
                echo menu_cart(1);
            }
            die();
        }
    }

    
}

?>