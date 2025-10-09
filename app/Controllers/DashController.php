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

        // Traiter la suppression de patient
        if (isset($_POST['delete_patient'])) {
            $patient_id = intval($_POST['patient_id']);

            // Vérifier que le patient appartient bien au médecin connecté
            $patient = $patientManager->getPatientById($patient_id);

            if ($patient && $patient->doctor_id == $_SESSION['user_id']) {
                $patientManager->deletePatient($patient_id);
            }

            // Rediriger pour éviter la resoumission du formulaire
            header('Location: /dash');
            exit;
        }
        
        // Traiter l'ajout de patient AVANT de récupérer la liste
        if (isset($_POST['submit'])) {
            $patient = new stdClass();
            $patient->first_name = trim($_POST['first_name']);
            $patient->last_name = trim($_POST['last_name']);
            $patient->birth_date = $_POST['birth'];

            // Normalisation et validation du genre
            $rawGender = null;
            if (!empty($_POST['gender'])) {
                $rawGender = $_POST['gender'];
            } elseif (!empty($_POST['genre'])) {
                // Fallback si ancien formulaire envoie encore 'genre'
                $rawGender = $_POST['genre'];
            }

            $rawGender = $rawGender !== null ? strtoupper(trim($rawGender)) : '';

            // Mapping pour correspondre à ENUM('M','F','O')
            $genderMap = [
                'H' => 'M', // au cas où
                'M' => 'M',
                'F' => 'F',
                'A' => 'O',
                'O' => 'O'
            ];

            $patient->gender = $genderMap[$rawGender] ?? 'O';

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