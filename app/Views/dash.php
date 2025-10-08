<!DOCTYPE html>
<html lang="fr">
<head>
    <title>DashMed</title>
    <link rel="stylesheet" href="/_assets/includes/styles/styles.css">
    <link rel="stylesheet" href="/_assets/includes/styles/styles-dash.css">
    <link rel="stylesheet" href="/_assets/includes/styles/styles-footer.css">
    <?php include __DIR__ . '/../../modules/controllers/views/templates/head.php'; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include __DIR__ . '/../../modules/controllers/views/templates/header.php'; ?>
    <main>
        <div class="dashboard-container">
        <div class="dash-head">
            <h1>Gestion des Patients</h1>
            <button class="btn-add" onclick="openModal()">Ajouter un Patient</button>
        </div>

        <div id="patientsContainer" class="patients-grid"></div>
    </div>

    <!-- Modal d'ajout de patient -->
    <div id="modalOverlay" class="modal-overlay" onclick="closeModal()"></div>
    <div id="modal" class="modal" style="display: none;">
        <h2>Nouveau Patient</h2>
        <form id="patientForm">
            <div class="form-group">
                <label for="patientNom" class="form-label">Nom complet</label>
                <input 
                    type="text" 
                    id="patientNom" 
                    class="form-input"
                    placeholder="Ex: Jean Dupont"
                    required
                >
            </div>

            <div class="form-group">
                <label class="form-label">Genre</label>
                <div class="gender-group">
                    <div class="gender-option">
                        <input type="radio" id="genreF" name="genre" value="Femme" checked>
                        <label for="genreF">Femme</label>
                    </div>
                    <div class="gender-option">
                        <input type="radio" id="genreM" name="genre" value="Homme">
                        <label for="genreM">Homme</label>
                    </div>
                    <div class="gender-option">
                        <input type="radio" id="genreA" name="genre" value="Autre">
                        <label for="genreA">Autre</label>
                    </div>
                </div>
            </div>

            <div class="modal-buttons">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Annuler</button>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>
    </div>
    </main>
    <script>
        let patients = [];

        // Charger les patients au démarrage
        function init() {
            renderPatients();
        }

        function openModal() {
            document.getElementById('modalOverlay').style.display = 'block';
            document.getElementById('modal').style.display = 'block';
            document.getElementById('patientNom').focus();
        }

        function closeModal() {
            document.getElementById('modalOverlay').style.display = 'none';
            document.getElementById('modal').style.display = 'none';
            document.getElementById('patientForm').reset();
        }

        function getInitials(name) {
            return name
                .split(' ')
                .map(word => word[0])
                .join('')
                .toUpperCase()
                .substring(0, 2);
        }

        function addPatient(e) {
            e.preventDefault();
            
            const nom = document.getElementById('patientNom').value.trim();
            const genre = document.querySelector('input[name="genre"]:checked').value;
            
            if (nom) {
                const patient = {
                    id: Date.now(),
                    nom: nom,
                    genre: genre
                };
                
                patients.push(patient);
                renderPatients();
                closeModal();
                
                // Animation de succès
                const cards = document.querySelectorAll('.patient-card');
                const lastCard = cards[cards.length - 1];
                if (lastCard) {
                    lastCard.style.animation = 'none';
                    setTimeout(() => {
                        lastCard.style.animation = 'scaleIn 0.5s ease-out';
                    }, 10);
                }
            }
        }

        function deletePatient(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce patient ?')) {
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
                    <div class="patient-avatar">${getInitials(patient.nom)}</div>
                    <div class="patient-name">${patient.nom}</div>
                    <span class="patient-genre">${patient.genre}</span>
                    <div class="patient-actions">
                        <button class="btn-action btn-delete" onclick="deletePatient(${patient.id})">
                            Supprimer
                        </button>
                    </div>
                </div>
            `).join('');
        }

        // Event listeners
        document.getElementById('patientForm').addEventListener('submit', addPatient);

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