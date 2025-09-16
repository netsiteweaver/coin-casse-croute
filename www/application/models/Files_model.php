<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Files_model extends CI_Model{

    private function rawUpload($fieldName="photos",$destinationFolder="photos")
    {
        $base_folder = realpath('.');
        // $base_folder = substr($base_folder,0,strlen($base_folder)-5);
        $upload_folder = $base_folder . DIRECTORY_SEPARATOR . $destinationFolder;

        if(isset($_FILES[$fieldName])){
            $errors= array();
            $file_name = $_FILES[$fieldName]['name'];
            $file_size = $_FILES[$fieldName]['size'];
            $file_tmp = $_FILES[$fieldName]['tmp_name'];
            $file_type = $_FILES[$fieldName]['type'];
            $x = explode('.',$_FILES[$fieldName]['name']);
            $file_ext = strtolower(end($x));

            // $file_ext = strtolower(end(explode('.',$_FILES[$fieldName]['name'])));

            $extensions= array("jpeg","jpg","png");
      
            if(in_array($file_ext,$extensions)=== false){
               $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }
            
            if(empty($errors)==true) {
               move_uploaded_file($file_tmp,$upload_folder. "/".$file_name);
            }else{
               print_r($errors);
            }
         }
    }

    public function uploadImage($fieldName="photos",$destinationFolder="photos",$resize=false,$allowedFileTypes=array('jpg','jpeg','png','gif','mp4','mov'))
    {
        $base_folder = realpath('.');
        // $base_folder = substr($base_folder,0,strlen($base_folder)-5);
        $upload_folder = $base_folder . DIRECTORY_SEPARATOR . $destinationFolder;

        $config['upload_path']          = $upload_folder;
        $config['allowed_types']        =  '*';
        $this->upload->initialize($config);
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload($fieldName))
        {
            // return $this->upload->display_errors();
            $this->rawUpload($fieldName,$destinationFolder);
        }
        else
        {
            $data = $this->upload->data();
            debug($data);
            if( (isset($resize)) && is_array($resize) ){
                $width = isset($resize['width']) ? $resize['width'] : 100;
                $height = isset($resize['height']) ? $resize['height'] : 100;
                $thumb_name = isset($resize['thumb_name']) ? $resize['thumb_name'] : "resized";

                $this->resizeImage($destinationFolder.'/'.$data['file_name'], $width, $height, $thumb_name);
                $data['image_'.$thumb_name] = $data['raw_name'] . "_" . $thumb_name . $data['file_ext'];

            }
            //$this->resizeImage('photos/'.$data['file_name'],100,100);
            //$data = array('upload_data' => $this->upload->data());
            return $data;
        }


    }

    public function uploadPDF($fieldName="document",$destinationFolder="photos")
    {
        $base_folder = realpath('.');
        $base_folder = substr($base_folder,0,strlen($base_folder)-5);
        $upload_folder = $base_folder . 'uploads/brochures/';
        
        $config['upload_path']          = $upload_folder;
        $config['allowed_types']        = 'pdf';

        $this->upload->initialize($config);
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload($fieldName))
        {
            return $this->upload->display_errors();
        }else{
            $data = $this->upload->data();
            return $data;
        }


    }

    public function uploadCSV($fieldName="document")
    {
        $base_folder = realpath('.');
        // $base_folder = substr($base_folder,0,strlen($base_folder)-5);
        $upload_folder = $base_folder . '/uploads/';
        
        $config['upload_path']          = $upload_folder;
        $config['allowed_types']        = 'csv';

        $this->upload->initialize($config);
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload($fieldName))
        {
            return $this->upload->display_errors();
        }else{
            $data = $this->upload->data();
            return $data;
        }


    }
    public function uploadImages($fieldName="photos",$destinationFolder="photos",$resize=false)
    {
        $uploadFolder = realpath('.');//$this->config->item("upload_folder");
        $uploadFolder = $uploadFolder . DIRECTORY_SEPARATOR.$destinationFolder;
        if(!file_exists($uploadFolder)){
            mkdir($uploadFolder,0777);
        }
        $config['upload_path']          = $uploadFolder;
        $config['allowed_types']        = "*";//array('gif','jpg','jpeg','png');
        $config['encrypt_name']         = true;
        $config['file_ext_tolower']     = true;

        // $count          = count($_FILES[$fieldName]['size']);
        $uploadedFile   = $_FILES[$fieldName];
        $filesUploaded  = array();
        $errors          = array();

        // for($s=0; $s<$count; $s++) {
        foreach($_FILES[$fieldName]['name'] as $id => $image){
            $_FILES[$fieldName]['name']     =$uploadedFile['name'][$id];
            $_FILES[$fieldName]['type']     = $uploadedFile['type'][$id];
            $_FILES[$fieldName]['tmp_name'] = $uploadedFile['tmp_name'][$id];
            $_FILES[$fieldName]['error']    = $uploadedFile['error'][$id];
            $_FILES[$fieldName]['size']     = $uploadedFile['size'][$id];
            // $uploadFolder   = $this->getUploadFolder($destinationFolder);
            // $uploadFolder = str_replace('/',DIRECTORY_SEPARATOR,$uploadFolder);
            $config['upload_path'] = $uploadFolder;
            $config['allowed_types'] = 'gif|jpg|png';

            if(!empty($_FILES[$fieldName]['name'])) {
                $this->upload->initialize($config);
                $this->load->library('upload', $config);
                if(! $this->upload->do_upload($fieldName) ){
                    $this->rawUpload($fieldName,$destinationFolder);
                    $errors[$id] = strip_tags($this->upload->display_errors());
                }else{
                    $data = $this->upload->data();
                    $filesUploaded[$id] = $data['file_name'];
                }
            }
        }

        return array('filesUploaded'=>$filesUploaded,'errors'=>$errors);

    }

    public function uploadMultipleImages($fieldname="photos",$destinationFolder="photos") {

        $uploadFolder   = $this->getUploadFolder($destinationFolder);
        $count          = count($_FILES[$fieldname]['size']);
        $uploadedFile   = $_FILES[$fieldname];
        $filesUploaded  = array();
        $errors          = array();

        for($s=0; $s<$count; $s++) {

            $_FILES[$fieldname]['name']     =$uploadedFile['name'][$s];
            $_FILES[$fieldname]['type']     = $uploadedFile['type'][$s];
            $_FILES[$fieldname]['tmp_name'] = $uploadedFile['tmp_name'][$s];
            $_FILES[$fieldname]['error']    = $uploadedFile['error'][$s];
            $_FILES[$fieldname]['size']     = $uploadedFile['size'][$s];
            $uploadFolder   = $this->getUploadFolder($destinationFolder);
            $uploadFolder = str_replace('/',DIRECTORY_SEPARATOR,$uploadFolder);
            $config['upload_path'] = $uploadFolder;
            $config['allowed_types'] = 'gif|jpg|png';

            $this->upload->initialize($config);
            $this->load->library('upload', $config);
            if(! $this->upload->do_upload($fieldname) ){
                $errors[] = strip_tags($this->upload->display_errors());
            }else{
                $data = $this->upload->data();
                $filesUploaded[] = $data['file_name'];
            }

        }

        return array('filesUploaded'=>$filesUploaded,'errors'=>$errors);
    }

    public function resizeImage($image, $width=100,$height=100, $thumb_name="resized")
    {
        $imageToProcess = $this->getUploadFolder($image);
        $imageToProcess = str_replace('/',DIRECTORY_SEPARATOR,$imageToProcess);

        $config['image_library'] = 'gd2';
        $config['source_image'] = $imageToProcess;
        $config['create_thumb'] = TRUE;
        $config['thumb_marker'] = '_' . $thumb_name;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = $width;
        $config['height']       = $height;
        $config['quality']      = 90;

        $this->load->library('image_lib', $config);

        if ( ! $this->image_lib->resize())
        {
            echo $this->image_lib->display_errors();
        }

    }

    public function uploadImages2($fieldName="photos",$destinationFolder="photos",$resize=false)
    {
        $base_folder = realpath('.');
        $upload_folder = $base_folder . DIRECTORY_SEPARATOR . $destinationFolder;

        if(!file_exists($upload_folder)){
            mkdir($upload_folder,0777);
        }

        $uploadedFile   =   $_FILES[$fieldName];
        $filesUploaded  =   array();
        $errors         =   array();

        foreach($_FILES[$fieldName]['name'] as $id => $image){
            $_FILES[$fieldName]['name']     =$uploadedFile['name'][$id];
            $_FILES[$fieldName]['type']     = $uploadedFile['type'][$id];
            $_FILES[$fieldName]['tmp_name'] = $uploadedFile['tmp_name'][$id];
            $_FILES[$fieldName]['error']    = $uploadedFile['error'][$id];
            $_FILES[$fieldName]['size']     = $uploadedFile['size'][$id];
            $config['upload_path'] = $upload_folder;
            $config['allowed_types'] = array('jpg','jpeg','png');
            $config['encrypt_name']         = true;
            $config['file_ext_tolower']     = true;

            if(!empty($_FILES[$fieldName]['name'])) {
                $this->upload->initialize($config);
                $this->load->library('upload', $config);
                if(! $this->upload->do_upload($fieldName) ){
                    $errors[$id] = strip_tags($this->upload->display_errors());
                }else{
                    $filesUploaded[$id] = $this->upload->data();
                }
            }
        }

        return array('filesUploaded'=>$filesUploaded,'errors'=>$errors);

    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function getUploadFolder($folder='photos')
    {

        return substr( realpath('.'), 0, strrpos(realpath('.'), DIRECTORY_SEPARATOR) ) . DIRECTORY_SEPARATOR . $folder;

    }

}