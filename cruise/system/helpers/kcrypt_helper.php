<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 
 * @author		Kishan Patel
 
 
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Array Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Kishan Patel
 
 */

// ------------------------------------------------------------------------

if ( ! function_exists('str_encrypt'))
{
	function str_encrypt($id='')
	{
            $CI =& get_instance();
            $CI->load->library(array('encrypt'));
		$id_val='SideWinder-'.$id;
                return base64_encode($CI->encrypt->encode($id_val));
		
	}
}

if ( ! function_exists('str_decrypt'))
{
	function str_decrypt($id='')
	{
            $CI =& get_instance();
            $CI->load->library(array('encrypt'));
            $id=$CI->encrypt->decode(base64_decode($id));
            $id_val=  explode('-', $id);
            if(!empty($id_val))
            {
                if($id_val[0]==='SideWinder')
                {
                    return $id_val[1];
                }
                else
                {
                    return 0;
                }
            }
            else
            {
                return 0;
            }
		
	}
}



/* End of file kcrypt_helper.php */
/* Location: ./system/helpers/kcrypt_helper.php */