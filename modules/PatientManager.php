<?php
require_once 'Database.php';
require_once 'Patient.php';

class PatientManager {
    private mysqli $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    // Ajouter un patient
    public function addPatient($patient): mysqli_result|bool
    {
        $fn = $this->db->real_escape_string($patient->first_name);
        $ln = $this->db->real_escape_string($patient->last_name);
        $gender = $this->db->real_escape_string($patient->gender);
        $birth_date = $this->db->real_escape_string($patient->birth_date);
        $email = $this->db->real_escape_string($patient->email);
        $phone = $this->db->real_escape_string($patient->phone);
        $address = $this->db->real_escape_string($patient->address);
        $medical_info = $this->db->real_escape_string($patient->medical_info);
        $doctor_id = intval($patient->doctor_id);

        $sql = "INSERT INTO patients (first_name, last_name, gender, birth_date, email, phone, address, medical_info, doctor_id)
                VALUES ('$fn', '$ln', '$gender', '$birth_date', '$email', '$phone', '$address', '$medical_info', $doctor_id)";
        return $this->db->query($sql);
    }

    // Supprimer un patient
    public function deletePatient($id): mysqli_result|bool
    {
        $id = intval($id);
        $sql = "DELETE FROM patients WHERE id=$id";
        return $this->db->query($sql);
    }

    // Récupérer tous les patients d'un médecin
    public function getPatientsByDoctor($doctor_id): array
    {
        $doctor_id = intval($doctor_id);
        $sql = "SELECT * FROM patients WHERE doctor_id=$doctor_id";
        $result = $this->db->query($sql);
        $patients = [];
        while ($row = $result->fetch_assoc()) {
            $patients[] = new Patient($row);
        }
        return $patients;
    }

    // Récupérer un patient par son id
    public function getPatientById($id): ?Patient
    {
        $id = intval($id);
        $sql = "SELECT * FROM patients WHERE id=$id";
        $result = $this->db->query($sql);
        if ($result && $result->num_rows > 0) {
            return new Patient($result->fetch_assoc());
        }
        return null;
    }
}
