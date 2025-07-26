<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

// Dossier des photos
$photoDir = 'uploads/';
if (!is_dir($photoDir)) {
    mkdir($photoDir, 0775, true);
}

// Nom du fichier Excel
$fichierExcel = 'inscriptions.xlsx';

// Chargement ou création
if (file_exists($fichierExcel)) {
    $spreadsheet = IOFactory::load($fichierExcel);
    $sheet = $spreadsheet->getActiveSheet();
    $ligne = $sheet->getHighestRow() + 1;
} else {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->fromArray([
        'Nom', 'Prénom', 'Post-nom', 'Lieu et date de naissance', 'Classe',
        'École de provenance', 'Nom du père', 'Profession père', 'Nom de la mère', 'Profession mère',
        'Adresse parents', 'Tuteur', 'Profession tuteur', 'Téléphone',
        'Province', 'Territoire', 'Nationalité',
        'État de santé', 'Aptitude physique', 'Dossiers déposés', 'Nom photo'
    ], null, 'A1');
    $ligne = 2;
}

// Enregistrement de la photo
$nomPhoto = '';
if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
    $nomPhoto = uniqid('eleve_') . '.' . $extension;
    move_uploaded_file($_FILES['photo']['tmp_name'], $photoDir . $nomPhoto);
}

// Récupération des données
$data = [
    $_POST['nom'] ?? '',
    $_POST['prenom'] ?? '',
    $_POST['postnom'] ?? '',
    $_POST['lieu_naissance'] ?? '',
    $_POST['classe'] ?? '',
    $_POST['ecole_provenance'] ?? '',
    $_POST['nom_pere'] ?? '',
    $_POST['profession_pere'] ?? '',
    $_POST['nom_mere'] ?? '',
    $_POST['profession_mere'] ?? '',
    $_POST['adresse_parents'] ?? '',
    $_POST['tuteur'] ?? '',
    $_POST['profession_tuteur'] ?? '',
    $_POST['telephone'] ?? '',
    $_POST['province'] ?? '',
    $_POST['territoire'] ?? '',
    $_POST['nationalite'] ?? '',
    $_POST['etat_sante'] ?? '',
    $_POST['aptitude_physique'] ?? '',
    $_POST['dossiers_deposes'] ?? '',
    $nomPhoto
];

// Écriture dans Excel
$sheet->fromArray($data, null, 'A' . $ligne);
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save($fichierExcel);

// ✅ Accusé de réception
echo "<h2> Inscription réussie</h2>";
echo "<p>Merci <strong>{$_POST['prenom']} {$_POST['nom']}</strong>, votre fiche a été enregistrée avec succès.</p>";
if ($nomPhoto) {
    echo "<p>📷 Photo enregistrée sous : <code>$nomPhoto</code></p>";
}
echo "<a href='index.html'>Retour au formulaire</a>";
?>
use Dompdf\Dompdf;
use Dompdf\Options;

// Contenu HTML à convertir en PDF
$html = "
  <h2>Fiche d'inscription</h2>
  <p><strong>Nom :</strong> {$data[0]}</p>
  <p><strong>Prénom :</strong> {$data[1]}</p>
  <p><strong>Classe :</strong> {$data[4]}</p>
  <p><strong>École de provenance :</strong> {$data[5]}</p>
  <p><strong>Téléphone :</strong> {$data[13]}</p>
  <p><strong>Province :</strong> {$data[14]}</p>
";

// Initialiser Dompdf
$options = new Options();
$options->set('defaultFont', 'Arial');
$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Enregistrer ou afficher le PDF
$pdfOutput = $dompdf->output();
file_put_contents("uploads/apercu_{$data[0]}_{$data[1]}.pdf", $pdfOutput);

// Message de fin
echo "<h2> Fiche enregistrée et PDF généré</h2>";
echo "<p><a href='uploads/apercu_{$data[0]}_{$data[1]}.pdf' target='_blank'>📄 Voir le PDF</a></p>";
