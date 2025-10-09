<!DOCTYPE html>
<html lang="fr">
<head>
    <title>DashMed</title>
    <link rel="stylesheet" href="/_assets/includes/styles/styles.css">
    <link rel="stylesheet" href="/_assets/includes/styles/styles-dash.css">
    <link rel="stylesheet" href="/_assets/includes/styles/styles-footer.css">
    <?php include __DIR__ . '/../../modules/controllers/views/templates/head.php'; ?>
</head>
<body>
    <?php include __DIR__ . '/../../modules/controllers/views/templates/header.php'; ?>
    <main>
        <div class="dashboard-container">
            <div class="header-user-section">
                <h2>Bonjour <?= htmlspecialchars($user_name) ?></h2>
                <a href="/logout" class="btn-logout">
                    Déconnexion
                </a>
            </div>
            <br>
            <div class="dash-head">
                <h1>Gestion des Patients</h1>
                <button class="btn-add" onclick="openModal()">
                    <span class="btn-add-text">Ajouter un Patient</span>
                    <span class="btn-add-icon">+</span>
                </button>
            </div>

            <div id="patientsContainer" class="patients-grid">
                <?php if (empty($patients)): ?>
                    <div class="empty-state">
                        <div class="empty-state-icon">👥</div>
                        <h3>Aucun patient enregistré</h3>
                        <p style="color: #9ca3af; margin-top: 0.5rem;">Cliquez sur "Ajouter un Patient" pour commencer</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($patients as $patient): ?>
                        <div class="patient-card">
                            <div class="patient-avatar">
                                <?php
                                $first = !empty($patient->first_name) ? $patient->first_name[0] : '';
                                $last = !empty($patient->last_name) ? $patient->last_name[0] : '';
                                echo strtoupper($first . $last);
                                ?>
                            </div>
                            <div class="patient-name"><?= htmlspecialchars($patient->first_name . ' ' . $patient->last_name) ?></div>
                            <span class="patient-genre"><?= htmlspecialchars($patient->gender) ?></span>
                            <div class="patient-actions">
                                <form method="POST" action="/dash" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce patient ?');">
                                    <input type="hidden" name="patient_id" value="<?= $patient->id ?>">
                                    <button type="submit" name="delete_patient" class="btn-action btn-delete">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>



    <!-- Modal d'ajout de patient -->
    <div id="modalOverlay" class="modal-overlay" onclick="closeModal()"></div>
    <div id="modal" class="modal" style="display: none;">
    <h2>Nouveau Patient</h2>
    <form method="POST" id="patientForm" action="">
        <div class="form-group">
            <label for="last_name" class="form-label">Nom*</label>
            <input
                type="text"
                id="last_name"
                name="last_name"
                class="form-input"
                placeholder="Entrez le nom"
                required
            >
            <label for="first_name" class="form-label">Prénom*</label>
            <input
                type="text"
                id="first_name"
                name="first_name"
                class="form-input"
                placeholder="Entrez le prénom"
                required
            >
        </div>
        
        <div class="form-group">
            <label for="birth" class="form-label">Date de naissance*</label>
            <input
                type="date"
                id="birth"
                name="birth"
                class="form-input"
                required
            >
        </div>
        
        <div class="form-group">
            <label class="form-label">Genre</label>
            <div class="gender-group">
                <div class="gender-option">
                    <input type="radio" id="genreF" name="gender" value="F" checked>
                    <label for="genreF">Femme</label>
                </div>
                <div class="gender-option">
                    <input type="radio" id="genreM" name="gender" value="M">
                    <label for="genreM">Homme</label>
                </div>
                <div class="gender-option">
                    <input type="radio" id="genreA" name="gender" value="O">
                    <label for="genreA">Autre</label>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                class="form-input"
                placeholder="exemple@email.com"
            >
        </div>
        
        <div class="form-group">
            <label for="phone" class="form-label">Téléphone</label>
            <input
                type="tel"
                id="phone"
                name="phone"
                class="form-input"
                placeholder="06 12 34 56 78"
            >
        </div>
        
        <div class="form-group">
            <label for="address" class="form-label">Adresse</label>
            <input
                type="text"
                id="address"
                name="address"
                class="form-input"
                placeholder="Entrez l'adresse"
            >
        </div>
        
        <div class="form-group">
            <label for="info" class="form-label">Informations médicales</label>
            <textarea
                id="info"
                name="info"
                class="form-input"
                placeholder="Allergies, antécédents médicaux, etc."
                rows="4"
            ></textarea>
        </div>
        
        <div class="modal-buttons">
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Annuler</button>
            <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </form>
    </div>
    </main>
    <script>
        // Uniquement pour ouvrir/fermer le modal
        function openModal() {
            document.getElementById('modalOverlay').style.display = 'block';
            document.getElementById('modal').style.display = 'block';
            document.getElementById('last_name').focus();
        }

        function closeModal() {
            document.getElementById('modalOverlay').style.display = 'none';
            document.getElementById('modal').style.display = 'none';
        }

        // Fermer le modal avec Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
    <?php include __DIR__ . '/../../modules/controllers/views/templates/footer.php'; ?>
</body>
</html>