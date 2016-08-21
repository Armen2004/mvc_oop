<?php namespace App\Controllers;

use Core\Factory;
use App\Models\Files;

class WelcomeController extends BaseController
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->upload();
            header('Location:' . $_SERVER['REQUEST_URI']);
        }

        $this->view->template('welcome/welcome');
    }

    public function upload()
    {
        $error = '';
        $success = '';
        if (isset($_FILES["file"])) {
            $target_dir = ASSETS_PATH . "img\\";
            foreach ($_FILES["file"]["name"] as $key => $value) {
                $target_file = $target_dir . basename($value);
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

                if (isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["file"]["tmp_name"][$key]);
                    if ($check !== false) {
                        $uploadOk = 1;
                    } else {
                        $uploadOk = 0;
                    }
                }

                if (file_exists($target_file) || $_FILES["file"]["size"][$key] > 500000) {
                    $uploadOk = 0;
                }

                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    $uploadOk = 0;
                }

                if ($uploadOk == 0) {
                    $error .= "Sorry, your file was not uploaded.<br>";
                } else {
                    if (move_uploaded_file($_FILES["file"]["tmp_name"][$key], $target_file)) {
                        $files = [
                            'image_name' => strip_tags($value),
                            'image_path' => strip_tags(BASE_PATH . basename($value))
                        ];

                        Factory::make(Files::class)->insertData($files);

                        $success .= "The file " . basename($_FILES["file"]["name"][$key]) . " has been uploaded.";
                    } else {
                        $error .= "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }
    }
}