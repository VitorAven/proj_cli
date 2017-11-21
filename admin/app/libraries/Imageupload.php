<?php  
    if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Imageupload {
    
        function doupload() {
            $CI = &get_instance();
            $name_array = array();
            $count = count($_FILES['userfile']['size']);
            foreach($_FILES as $key=>$value)
            for($s=0; $s<=$count-1; $s++) {
            $_FILES['userfile']['name']=$value['name'][$s];
            $_FILES['userfile']['type']    = $value['type'][$s];
            $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
            $_FILES['userfile']['error']       = $value['error'][$s];
            $_FILES['userfile']['size']    = $value['size'][$s];  
                $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $CI->load->library('upload', $config);
            $CI->upload->do_upload();
            $data = $CI->upload->data();
            $name_array[] = $data['file_name'];
            }
            return $name_array;
        }
    }