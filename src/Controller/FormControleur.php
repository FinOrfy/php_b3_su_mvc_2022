<?php
include_once(“model/ModelUser”);

class FormController {
    public $model;
        public function __construct()
            {
                $this->model = new Model();
            }
        public function invoke()
            {
                $reslt = $this->model->getlogin();
                    if($reslt == ‘login’)
                    {
                        include ‘views/ViewUser.php’;
                    }
                    else
                    {
                        include ‘views/AfterLogin.php’;
                    }
            }
}
?>