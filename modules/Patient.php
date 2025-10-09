<?php
class Patient {
    public int $id;
    public string $first_name;
    public string $last_name;
    public string $gender;
    public string $birth_date;
    public string $email;
    public string $phone;
    public string $address;
    public string $medical_info;
    public int $doctor_id;

    public function __construct($data = []) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
