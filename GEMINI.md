📘 GEMINI.md — Plateforme pédagogique (MVP Laravel)
🧭 Vision

NEFFACE PAS LES DONNEES DEJA INSERES DANS LA DB !!!!

Plateforme web simple permettant :

consultation des cours par niveau et matière
accès aux exercices et corrigés
upload de contenus par les enseignants
extraction OCR des PDF pour indexation et recherche
🏗️ Stack technique
Backend : Laravel (API REST + Blade)
Frontend : Blade (MVP simple et rapide)
Base de données : MySQL
OCR (gratuit) : Tesseract OCR
Storage : local (dev) → S3 compatible (prod)
Auth : Laravel Breeze / Sanctum
🧱 Architecture (modulaire inspirée microservices, simplifiée)

Organisation par modules métiers :

app/
├── Modules/
│ ├── Auth/
│ ├── User/
│ ├── Course/
│ ├── Level/
│ ├── Subject/
│ ├── Document/
│ └── OCR/
├── Http/
├── Services/
├── Repositories/
└── DTOs/

Chaque module contient :

Controllers/
Models/
Services/
Repositories/
Routes/
👥 Rôles
USER (élève)
TEACHER (professeur)
🔐 Authentification

Inscription :

nom
email
mot de passe
rôle (user / teacher)

Connexion :

email + mot de passe

Middleware :

auth
role
🏠 Page Home (MVP principal)

Objectif :
Lister tous les contenus pédagogiques avec filtres

Filtres :

Niveau (Seconde, Première, Terminale)
Matière (Maths, Français…)
Type :
cours
exercices
corrigés

Affichage :

liste paginée
tri simple
recherche (phase 2 avec OCR)
📚 Module Course

Table courses :

id
title
description
level_id
subject_id
type (course | exercise | correction)
file_path
uploaded_by (teacher_id)
created_at
🏷️ Module Level

Table levels :

id
name
🧪 Module Subject

Table subjects :

id
name
📄 Module Document

Gestion des fichiers :

upload PDF uniquement (MVP)
stockage disque
lien avec course
🧠 Module OCR

Objectif :
Extraire le texte des PDF pour :

recherche
indexation

Flow :

Upload PDF
Validation
Stockage
Création course
Dispatch Job OCR
Extraction texte
Sauvegarde DB

Table documents_text :

id
course_id
extracted_text (LONGTEXT)
🔄 Pipeline Upload Professeur

Teacher upload PDF
→ Validation (type, size)
→ Stockage fichier
→ Create Course record
→ Dispatch OCR Job
→ OCR processing
→ Save extracted text

⚙️ Services

CourseService :

createCourse()
filterCourses()
listCourses()

OCRService :

extractTextFromPDF($path)
🧵 Jobs (Queue)

ProcessOCRJob :

prend un fichier
lance OCR
stocke résultat
📡 API Endpoints

Auth :

POST /api/register
POST /api/login

Courses :

GET /api/courses
GET /api/courses/{id}
POST /api/courses (teacher only)

Filtres :

GET /api/levels
GET /api/subjects
🧩 Repository Pattern

CourseRepository :

findAll(filters)
findById(id)
create(data)
📦 Validation
type : PDF uniquement
taille max : 10MB
champs obligatoires :
title
level
subject
🔎 Recherche (phase 2)
LIKE sur texte OCR
Full-text MySQL (optionnel)
🚀 Roadmap

Phase 1 (MVP) :

Auth
Upload PDF
Listing + filtres
OCR async

Phase 2 :

recherche avancée
optimisation mobile
UX améliorée
⚠️ Contraintes
connexion faible → optimiser fichiers
mobile first
UX simple
OCR en background obligatoire
📁 Exemple routes Laravel
Route::middleware('auth')->group(function () {
    Route::get('/courses', [CourseController::class, 'index']);
    Route::post('/courses', [CourseController::class, 'store'])->middleware('role:teacher');
});
🧪 Exemple Service OCR
class OCRService
{
    public function extractTextFromPDF($path)
    {
        $command = "tesseract " . escapeshellarg($path) . " stdout";
        return shell_exec($command);
    }
}