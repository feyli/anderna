<?php
class User {
    public $id;
    public $first_name;
    public $last_name;
    public $gender;
    public $email;
    public $pwd;
    public $reset_token;
    public $reset_expires;

    public function __construct($data = []) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
?>