<?php

class upload {
    private $errors = [];
    private $image_extensions = ['jpeg','jpg','png','gif'];
    private $file_extensions = ['7zip','rar','zip','pdf','mp4'];

    public function go($name, $path) {
        $file_name      = $_FILES[$name]['name'];
        $file_size      = $_FILES[$name]['size'];
        $file_type      = $_FILES[$name]['type'];
        $file_tmp       = $_FILES[$name]['tmp_name'];
        $file_extension = strtolower(end(explode('.',$file_name)));
        $new_file_name  = sha1(time()) . '.' . $file_extension;
        $upload_path    = $path . basename($new_file_name); 

        if(empty($file_name)) {
            $this->errors[] = "No image selected to upload.";
        }
        if (!in_array($file_extension, $this->image_extensions)) {
            $this->errors[] = "This file extension is not allowed.";
        }
        if ($fileSize > 20000000) {
            $this->errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 20MB.";
        }
        if (empty($this->errors)) {
            $upload = move_uploaded_file($file_tmp, $upload_path);
            if ($upload) {
                return array(
                    "status" => true,
                    "path"   => $path,
                    "file"   => basename($new_file_name)
                );
            } else {
                return array(
                    "status" => false,
                    "errors" => "An error occurred somewhere. Try again or contact the admin"
                    );
                }
        } else {
            return array(
                "status" => false,
                "errors" => $this->errors
            );
        }
    }

    public function file($name, $path) {
        $file_name      = $_FILES[$name]['name'];
        $file_size      = $_FILES[$name]['size'];
        $file_type      = $_FILES[$name]['type'];
        $file_tmp       = $_FILES[$name]['tmp_name'];
        $file_extension = strtolower(end(explode('.',$file_name)));
        $new_file_name  = sha1(time()) . '.' . $file_extension;
        $upload_path    = $path . basename($new_file_name); 

        if(empty($file_name)) {
            $this->errors[] = "No image selected to upload.";
        }
        if (!in_array($file_extension, $this->file_extensions)) {
            $this->errors[] = "This file extension is not allowed.";
        }
        if ($fileSize > 20000000) {
            $this->errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 20MB.";
        }
        if (empty($this->errors)) {
            $upload = move_uploaded_file($file_tmp, $upload_path);
            if ($upload) {
                return array(
                    "status" => true,
                    "path"   => $path,
                    "file"   => basename($new_file_name)
                );
            } else {
                return array(
                    "status" => false,
                    "errors" => "An error occurred somewhere. Try again or contact the admin"
                    );
                }
        } else {
            return array(
                "status" => false,
                "errors" => $this->errors
            );
        }
    }

}