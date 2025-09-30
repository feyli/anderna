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
    public $user_id; // médecin responsable

    public function __construct($data = []) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
?>