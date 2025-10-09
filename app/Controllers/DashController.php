<?php
require_once dirname(__DIR__, 2) . '/modules/Database.php';
require_once dirname(__DIR__, 2) . '/modules/PatientManager.php';

class DashController
{
    public function dash()
    {
        // Renvoyer l'utilisateur sur la page de login si pas connecté
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $database = new DataBase();
        $patientManager = new PatientManager($database);
        
        // Récuperer le nom pour l'afficher
        $user_name = $_SESSION['user_name'];
        
        // Traiter l'ajout de patient AVANT de récupérer la liste
        if (isset($_POST['submit'])) {
            $patient = new stdClass();
            $patient->first_name = trim($_POST['first_name']);
            $patient->last_name = trim($_POST['last_name']);
            $patient->birth_date = $_POST['birth'];
            $patient->gender = $_POST['genre'];
            $patient->email = trim($_POST['email']);
            $patient->phone = trim($_POST['phone']);
            $patient->address = trim($_POST['address']);
            $patient->medical_info = trim($_POST['info']);
            $patient->doctor_id = $_SESSION['user_id'];
            
            $result = $patientManager->addPatient($patient);
            
            // Rediriger pour éviter la resoumission du formulaire
            header('Location: /dash');
            exit;
        }
        
        // Récupérer les patients après le traitement du POST
        $patients = $patientManager->getPatientsByDoctor($_SESSION['user_id']);
        
        require __DIR__ . '/../Views/dash.php';
    }
}