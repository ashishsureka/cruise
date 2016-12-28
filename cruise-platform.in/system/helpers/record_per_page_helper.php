<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * get_paging_info
 *
 * Returns the pagination info
 * @param int
 * @param int
 * @param int
 * @access  public
 * @return  string
 */
if ( ! function_exists('get_paging_info'))
{
    function get_paging_info($offset, $limit, $fetched_rows, $found_rows)
    {
        $X = $offset + 1;
        $Y = $offset + $limit;
        if($fetched_rows < $limit)
        {
            $Y -= ($limit - $fetched_rows); 
        }
        $CI =& get_instance();
        $CI->lang->load('common', 'english');
        return sprintf($CI->lang->line('common_paging_info'), $X , $Y, $found_rows);
    }
}


// ------------------------------------------------------------------------

/**
 * get_paging_limit_options
 *
 * Returns the pagination limit drop down 
 * @param int
 * @param int
 * @param int
 * @access  public
 * @return  string
 */
if ( ! function_exists('get_paging_limit_options'))
{
    function get_paging_limit_options($url, $limit = '')
    {
        $CI =& get_instance();
        $CI->load->helper('form');
        $dropdown = form_open($url);
        $options = array(
                    '' => 'Select',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '10' => '10',
                    '20' => '20'
                    );
        $dropdown .= form_dropdown('paging_limit', $options, $limit);
        $dropdown .= form_submit('submit', 'Go');
        return $dropdown;
    }
}