<?php
require_once __DIR__.'/../modules/Database.php';
require_once __DIR__.'/../modules/User.php';
require_once __DIR__.'/../modules/UserManager.php';
require_once __DIR__.'/../modules/Patient.php';
require_once __DIR__.'/../modules/PatientManager.php';

try {
    // Connexion à la base de données
    $db = new Database();
    echo "Connexion à la base réussie.<br>";

    $userManager = new UserManager($db);
    $patientManager = new PatientManager($db);

    // Données du médecin de test
    $medecinData = [
        'first_name' => 'DocTest',
        'last_name' => 'Medecin',
        'gender' => 'M',
        'email' => 'doc.medecin.test@example.com',
        'pwd' => 'medecintestpass'
    ];

    // Supprimer le médecin test s'il existe
    $userManager->deleteUserByEmail($medecinData['email']);

    // Ajouter le médecin test
    $medecin = new User($medecinData);
    $resultMedecin = $userManager->addUser($medecin);

    if ($resultMedecin) {
        echo "Médecin ajouté avec succès.<br>";

        // Récupérer l'ID du médecin ajouté
        $medecinId = $db->getConnection()->insert_id;
        echo "ID Médecin ajouté : " . $medecinId . "<br>";

        // Données du patient de test
        $patientData = [
            'first_name' => 'Test',
            'last_name' => 'Patient',
            'gender' => 'F',
            'birth_date' => '1990-01-01',
            'email' => 'test.patient@example.com',
            'phone' => '0601020304',
            'address' => '123 rue du Test',
            'medical_info' => 'Aucun antécédent',
            'doctor_id' => $medecinId
        ];

        // Supprimer le patient test s'il existe déjà
        $existingPatients = $db->getConnection()->query(
            "SELECT id FROM patients WHERE email = '" . $db->getConnection()->real_escape_string($patientData['email']) . "'"
        );
        while ($row = $existingPatients->fetch_assoc()) {
            $patientManager->deletePatient($row['id']);
        }

        // Ajouter le patient
        $patient = new Patient($patientData);
        $resultPatient = $patientManager->addPatient($patient);

        if ($resultPatient) {
            echo "Patient ajouté avec succès.<br>";

            // Récupérer l'ID du patient ajouté
            $patientId = $db->getConnection()->insert_id;
            echo "ID Patient ajouté : " . $patientId . "<br>";

            // Test récupération du patient par ID
            $retrievedPatient = $patientManager->getPatientById($patientId);
            if ($retrievedPatient) {
                echo "Patient récupéré : " . $retrievedPatient->first_name . " " . $retrievedPatient->last_name . "<br>";
            } else {
                echo "Échec de récupération du patient.<br>";
            }

            // Test récupération des patients du médecin
            $patientsOfMedecin = $patientManager->getPatientsByDoctor($medecinId);
            echo "Nombre de patients pour le médecin #" . $medecinId . " : " . count($patientsOfMedecin) . "<br>";

            // Suppression du patient de test
            $deletePatient = $patientManager->deletePatient($patientId);
            if ($deletePatient) {
                echo "Patient supprimé avec succès.<br>";
            } else {
                echo "Échec de la suppression du patient.<br>";
            }
        } else {
            echo "Échec de l'ajout du patient.<br>";
        }

        // Suppression du médecin de test
        $deleteMedecin = $userManager->deleteUser($medecinId);
        if ($deleteMedecin) {
            echo "Médecin supprimé avec succès.<br>";
        } else {
            echo "Échec de la suppression du médecin.<br>";
        }
    } else {
        echo "Échec de l'ajout du médecin.<br>";
    }

    // Fermer la connexion
    $db->close();
    echo "Connexion fermée.<br>";

} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>