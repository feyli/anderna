<?php
class Patient {
    public $id;
    public $first_name;
    public $last_name;
    public $gender;
    public $birth_date;
    public $email;
    public $phone;
    public $address;
    public $medical_info;
    public $doctor_id;

    public function __construct($data = []) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
?>