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

            <div id="patientsContainer" class="patients-grid"></div>
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
        <?php if (!empty($patients)): ?>
        let patients = <?php echo json_encode($patients); ?>;
        <?php else: ?>
        let patients = []; 
        <?php endif; ?>

        console.log(patients);

        // Charger les patients au démarrage
        function init() {
            renderPatients();
        }

        function openModal() {
            document.getElementById('modalOverlay').style.display = 'block';
            document.getElementById('modal').style.display = 'block';
            document.getElementById('last_name').focus();
        }

        function closeModal() {
            document.getElementById('modalOverlay').style.display = 'none';
            document.getElementById('modal').style.display = 'none';
        }

        function getInitials(firstName, lastName) {
            const first = firstName ? firstName[0] : '';
            const last = lastName ? lastName[0] : '';
            return (first + last).toUpperCase();
        }

        function deletePatient(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce patient ?')) {
                // Ici vous devrez faire un appel AJAX pour supprimer côté serveur
                // Pour l'instant, on supprime juste côté client
                patients = patients.filter(p => p.id !== id);
                renderPatients();
            }
        }

        function renderPatients() {
            const container = document.getElementById('patientsContainer');
            
            if (patients.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-state-icon">👥</div>
                        <h3>Aucun patient enregistré</h3>
                        <p style="color: #9ca3af; margin-top: 0.5rem;">Cliquez sur "Ajouter un Patient" pour commencer</p>
                    </div>
                `;
                return;
            }
            
            container.innerHTML = patients.map(patient => `
                <div class="patient-card">
                    <div class="patient-avatar">${getInitials(patient.first_name || patient.firstName, patient.last_name || patient.lastName)}</div>
                    <div class="patient-name">${patient.first_name || patient.firstName || ''} ${patient.last_name || patient.lastName || ''}</div>
                    <span class="patient-genre">${patient.gender || patient.genre || ''}</span>
                    <div class="patient-actions">
                        <button class="btn-action btn-delete" onclick="deletePatient(${patient.id})">
                            Supprimer
                        </button>
                    </div>
                </div>
            `).join('');
        }

        // Fermer le modal avec Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Initialiser l'application
        init();
    </script>
    <?php include __DIR__ . '/../../modules/controllers/views/templates/footer.php'; ?>
</body>
</html>