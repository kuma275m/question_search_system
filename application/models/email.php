<?php

class Email extends CI_Model {
	
	public function send_email($mailto, $topic, $content)  
    {  
        $this->load->library('email');            //加载CI的email类  
          
        //以下设置Email参数  
        $config['protocol'] = 'smtp';  
        $config['smtp_host'] = 'smtp.sina.com';  
        $config['smtp_user'] = 'kuma275m';  
        $config['smtp_pass'] = 'kuma840224xzD';  
        $config['smtp_port'] = '25';  
        $config['charset'] = 'utf-8';  
        $config['wordwrap'] = TRUE;  
        $config['mailtype'] = 'html';  
        $this->email->initialize($config);              
          
        //以下设置Email内容  
        $this->email->from('kuma275m@sina.com', 'kuma275m');  
        $this->email->to($mailto);  
        $this->email->subject($topic);  
        $this->email->message($content);   
  
        $this->email->send();  
  
        //echo $this->email->print_debugger();        //返回包含邮件内容的字符串，包括EMAIL头和EMAIL正文。用于调试。  
    }
	}

