<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Site URL
 *
 * Create a local URL based on your basepath. Segments can be passed via the
 * first parameter either as a string or an array.
 *
 * @access	public
 * @param	string
 * @return	string
 */
 
if ( ! function_exists('check_role'))
{	
	function check_role($module, $action){
		$CI =& get_instance();
		$CI->load->library('session');
        return true;
		$userID = $CI->session->userdata('user_id');
		$userUsername = $CI->session->userdata('user_username');
		$userUserGroupID = $CI->session->userdata('user_usergroupid');
		
		if(!$userID)
            return 0;
		$CI->load->model('usergroup/musergroup', 'UserGroup_Model');
		$userGroupRole = $CI->UserGroup_Model->getUserGroupRole($userUserGroupID);

		if($action == 'view'){
            if(($userGroupRole['canview'] != '') && ($module != '')){
                if(strpos($userGroupRole['canview'], $module) === false)
                    return false;
            }else
                return false;
		}
		if($action == 'edit')
            if(($userGroupRole['canedit'] != '') && ($module!='')){
                if(strpos($userGroupRole['canedit'], $module) === false)
                    return false;
            }else
                return false;
        return true;
	}
}

if ( ! function_exists('getUserID'))
{
    function getUserID(){
        $CI =& get_instance();
        $CI->load->library('session');
        if($CI->session)
            return $CI->session->userdata('user_id');
        else
            return 0;

    }
}

if ( ! function_exists('getUserName'))
{
    function getUserName(){
        $CI =& get_instance();
        $CI->load->library('session');
        if($CI->session)
            return $CI->session->userdata('user_name');
        else
            return 0;

    }
}
if ( ! function_exists('store_session'))
{
	function store_session($params)
	{
		$CI =& get_instance();
		$CI->load->library('session');
		$result = NULL;
		$post = $CI->input->post();
        $get = $CI->input->get();
		foreach($params as $key => $param){
			if(isset($post[$key])){
				$CI->session->set_userdata($key, $post[$key]);
				$result[$key] = $post[$key];
			}elseif(isset($get[$key])){
                $CI->session->set_userdata($key, $get[$key]);
                $result[$key] = $get[$key];
            }else{
				if(!$CI->session->userdata($key)){	
					$CI->session->set_userdata($key, $param);
					$result[$key] = $param;
				}else{
					$result[$key] = $CI->session->userdata($key);
				}
			}
		}
		return $result;
	}
}

if ( ! function_exists('set_session'))
{
	function set_session($key, $value)
	{
		$CI =& get_instance();
		$CI->load->library('session');
		$CI->session->set_userdata($key, $value);
	}
}


if ( ! function_exists('p'))
{	
	function p($param){
		$caller = debug_backtrace(); 
		
	   //for last caller:
		echo "<pre>";
		print_r($param);
		echo "</pre>";		
		echo '<div class="alert alert-dismissable alert-info">';
	    echo "<strong>Function p() called from</strong> ".$caller[0]['file']." line ".$caller[0]['line'].'';
		echo '</div>';
	 
	   //for all files included before caller, and a lot of other info:
	   //echo "api_function() called from all files:<pre>".print_r($caller,true)."</pre>";
	 
	   //optionall kill script at this point:
	   //exit;
	}
}

if ( ! function_exists('getVar'))
{ 
	function getVar($varKey, $defaultValue = '', $varType = 'string'){
		$CI =& get_instance();

		if($CI->input->post($varKey))
			return $CI->input->post($varKey);
        elseif($CI->input->get($varKey))
            return $CI->input->get($varKey);
		else{
			if(($defaultValue) && ($defaultValue != ''))
				return $defaultValue;
			else{
				switch($varType){
					case 'string':
					return '';
					break;
					case 'int':
					return 0;
					break;
					case 'float':
					return 0;
					break;
					case 'array':
					return array();
					break;
					case 'obj':
					return null;
					break;
				}
			} //End default value
		} // End if post[varKey]
	} // End Function

}


//Function to change array index with item id
if ( ! function_exists('reIndexArray'))
{ 
	function reIndexArray($arraySource, $indexKey = 'id'){
		if(count($arraySource)){
			$arrayReturn = array();
			foreach($arraySource as $item){
				$arrayReturn[$item[$indexKey]] = $item;
			}
			return $arrayReturn;
		}
	}
}

if ( ! function_exists('datediff'))
{
	function datediff($date1, $date2)
	{
		return (strtotime($date1) - strtotime($date2))/86400;
	}
}

if ( ! function_exists('getLinkModule'))
{
	function getLinkModule($link)
	{
		if(strpos($link, '/'))
			return substr($link, 0, strpos($link, '/') - 1);
		else
			return $link;
	}
}

//Function convert date form format yyyy-mm-dd to mm/dd/yyyy 
if ( ! function_exists('dateConvertToPicker'))
{
	function dateConvertToPicker($strDate)
	{
		if(strpos($strDate, '-')){
			$arrDate = explode('-', $strDate);
			return $arrDate[1].'/'.$arrDate[2].'/'.$arrDate[0];
		}else
			return $strDate;
	}
}

//Function convert date form format mm/dd/yyyy to yyyy-mm-dd
if ( ! function_exists('dateConvertToPHP'))
{
	function dateConvertToPHP($strDate)
	{
		if(strpos($strDate, '/')){
			$arrDate = explode('/', $strDate);
			return $arrDate[2].'-'.$arrDate[0].'-'.$arrDate[1];
		}else
			return $strDate;
	}
}

// ------------------------------------------------------------------------
