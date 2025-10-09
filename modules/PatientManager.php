<?php
require_once 'Database.php';
require_once 'Patient.php';

class PatientManager {
    private mysqli $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    // Ajouter un patient
    public function addPatient(Patient $patient): bool
    {
        $sql = "INSERT INTO patients (first_name, last_name, gender, birth_date, email, phone, address, medical_info, doctor_id)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("ssssssssi",
            $patient->first_name,
            $patient->last_name,
            $patient->gender,
            $patient->birth_date,
            $patient->email,
            $patient->phone,
            $patient->address,
            $patient->medical_info,
            $patient->doctor_id
        );

        return $stmt->execute();
    }

    // Supprimer un patient
    public function deletePatient($id): bool
    {
        $sql = "DELETE FROM patients WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) return false;

        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Récupérer tous les patients d'un médecin
    public function getPatientsByDoctor($doctor_id): array
    {
        $sql = "SELECT * FROM patients WHERE doctor_id = ?";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) return [];

        $stmt->bind_param("i", $doctor_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $patients = [];
        while ($row = $result->fetch_assoc()) {
            $patients[] = new Patient($row);
        }
        return $patients;
    }

    // Récupérer un patient par son id
    public function getPatientById($id): ?Patient
    {
        $sql = "SELECT * FROM patients WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) return null;

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            return new Patient($result->fetch_assoc());
        }
        return null;
    }
}