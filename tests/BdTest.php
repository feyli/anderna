<?php
require_once __DIR__.'/../modules/Database.php';
require_once __DIR__.'/../modules/User.php';
require_once __DIR__.'/../modules/UserManager.php';

try {
    // Test de connexion à la base de données
    $db = new Database();
    echo "Connexion à la base réussie.<br>";

    // Test d'ajout d'un utilisateur
    $userData = [
        'first_name' => 'Test',
        'last_name' => 'User',
        'gender' => 'M',
        'email' => 'test.user@example.com',
        'pwd' => 'testpassword'
    ];
    $user = new User($userData);

    $userManager = new UserManager($db);
    $result = $userManager->addUser($user);

    if ($result) {
        echo "Utilisateur ajouté avec succès.<br>";

        // Test de connexion avec le bon mot de passe
        $loginUser = $userManager->login($userData['email'], $userData['pwd']);
        if ($loginUser) {
            echo "Connexion réussie avec le bon mot de passe.<br>";
        } else {
            echo "Échec de connexion avec le bon mot de passe.<br>";
        }

        // Test de connexion avec un mauvais mot de passe
        $wrongLogin = $userManager->login($userData['email'], 'wrongpassword');
        if (!$wrongLogin) {
            echo "Connexion refusée avec mauvais mot de passe (comportement attendu).<br>";
        } else {
            echo "Connexion réussie avec mauvais mot de passe (comportement inattendu).<br>";
        }

        // On récupère l'ID du nouvel utilisateur
        $userId = $db->getConnection()->insert_id;
        echo "ID ajouté : " . $userId . "<br>";

        // Suppression de l'utilisateur
        $delete = $userManager->deleteUser($userId);
        if ($delete) {
            echo "Utilisateur supprimé avec succès.<br>";
        } else {
            echo "Échec de la suppression de l'utilisateur.<br>";
        }
    } else {
        echo "Échec de l'ajout de l'utilisateur.<br>";
    }

    // Fermer la connexion
    $db->close();
    echo "Connexion fermée.<br>";

} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>