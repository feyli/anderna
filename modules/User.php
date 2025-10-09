<?php
class User {
    public int $id;
    public string $first_name;
    public string $last_name;
    public string $gender;
    public string $email;
    public string $pwd;
    public ?string $reset_token;
    public ?string $reset_expires;

    public function __construct(array $data = []) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
