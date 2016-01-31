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
 
if ( ! function_exists('sendmail'))
{	
	function sendmail($recipient, $template, $content){
        return true;
		$CI =& get_instance();

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => '465',
            'smtp_user' => 'quocvu88@gmail.com',
            'smtp_pass' => '*****'
        );

        $CI->load->library('email', $config);
        $CI->load->helper('file');

        $CI->email->from('quocvu88@gmail.com', 'Y4A Admin');
        foreach($recipient as $receiver)
            $CI->email->to($receiver);
        //$CI->email->cc('another@another-example.com');
        //$CI->email->bcc('them@their-example.com');

        $CI->email->subject($content['subject']);
        $message = read_file('files/emailtemplates/'.$template.'.txt');
        foreach($content as $key => $contentReplacement){
            $message = str_replace('-@='.$key.'=@-', $contentReplacement, $message);
        }
        $CI->email->message($message);

        $CI->email->send();

        //echo $CI->email->print_debugger();
        return true;
	}
}
