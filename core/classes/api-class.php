<?php

class JX_API {
    private $statuscode, $success = true, $message = null, $data = null, $errors = [], $meta = [];
    public function __construct($statuscode = 200,$success = true,$message = null,$data = null,$errors = null)
    {
        $this->statuscode = $statuscode;
        $this->message = $message;
        $this->success = $success;
        $this->errors = $errors;
        $this->data = $data;

        http_response_code($this->statuscode);
        $this->meta = [
            'API Version' => 1,
            'Author' => 'Muhammad Jamil',
            'Made for' => 'JamilX',
            'Copyright' => 'Jamilx, Muhammad Jamil, Jamilsoft Technologies'
        ];
        header('Content-Type: application/json');

    }

    public function setStatusCode($statuscode){
            $this->statuscode = $statuscode;
    }
    public function setMessage($message){
        $this->message = $message;
    }

    public function setSuccess($success = false){
        $this->success = $success;
    }

    public function setErrors($errors){
            $this->errors = $errors;
    }
    public function data($data){
                $this->data = $data;
    }

    public function Respond(){
         echo json_encode([
            'success' => (bool) $this->success,
            'message' => $this->message,
            'data' => $this->data,
            'errors' => $this->errors,
            'meta' => $this->meta,
        ]);
    }
}