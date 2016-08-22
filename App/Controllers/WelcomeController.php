<?php namespace App\Controllers;

use Core\Factory;
use App\Models\Styles;
use App\Models\Files;

class WelcomeController extends BaseController
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $files = $_FILES;
            $posts = $_POST;
//            echo "<pre>";
//            print_r($files);
//            print_r($posts);
//            die;
            header('Content-type: application/json');
            exit(json_encode($this->upload($files, $posts)));
        }

        $this->view->template('welcome/welcome');
    }

    public function newStyle()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $data = [
                'style_name' => strip_tags($_POST['style_name']),
                'style_text' => strip_tags($_POST['style_text'])
            ];

            Factory::make(Styles::class)->insertData($data);

            header('Content-type: application/json');
            exit(json_encode($data));
        }
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

    public function getStyles()
    {
        $data = Factory::make(Styles::class)->getAll();
        header('Content-type: application/json');
        exit(json_encode($data));
    }

    public function getImages()
    {
        $data = Factory::make(Files::class)->getAll();
        header('Content-type: application/json');
        exit(json_encode($data));
    }

    private function upload($files, $posts)
    {
        $error = '';
        $success = '';
        if (isset($files)) {
            $target_dir = ASSETS_PATH . "img" . DS;
            foreach ($files as $key => $value) {
                $file_name = sha1(basename($value['name'])) . "." . pathinfo(basename($value['name']), PATHINFO_EXTENSION);
                $target_file = $target_dir . $file_name;
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

                $check = getimagesize($value["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                }

                if ($value["size"] > 2097152) {
                    $uploadOk = 0;
                }

                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    $uploadOk = 0;
                }

                if ($uploadOk == 0) {
                    $error .= "Sorry, your file was not uploaded.<br>";
                } else {
                    if (move_uploaded_file($value["tmp_name"], $target_file)) {
                        $files = [
                            'image_name' => $file_name,
                            'image_path' => BASE_URL . "assets/img/" . $file_name,
                            'image_style' => $posts[$key] == 'undefined' ? '' : $posts[$key]
                        ];
                        Factory::make(Files::class)->insertData($files);
//
                        $success .= "The file " . basename($value["name"]) . " has been uploaded.";
                    } else {
                        $error .= "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }
    }
}