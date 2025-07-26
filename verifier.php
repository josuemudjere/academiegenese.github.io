<?php
session_start();
$error = "";

// Matricule et mot de passe corrects à modifier selon ton besoin
$matricule_correct = "12345";
$motdepasse_correct = "MonMotDePasse123";

// Si formulaire soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $matricule = $_POST["matricule"] ?? '';
    $password = $_POST["password"] ?? '';

    // Vérification
    if ($matricule === $matricule_correct && $password === $motdepasse_correct) {
        $_SESSION["logged_in"] = true;
        header("Location: communique.php");
        exit();
    } else {
        $error = "Matricule ou mot de passe incorrect";
    }
}
session_start();

$utilisateurs = [
    "GENESE2025" => "admin2025",
    "MAT001" => "1234",
    "MAT002" => "abcd"
];

$matricule = $_POST['matricule'] ?? '';
$password = $_POST['password'] ?? '';

if (isset($utilisateurs[$matricule]) && $utilisateurs[$matricule] === $password) {
    $_SESSION['logged_in'] = true;
    $_SESSION['matricule'] = $matricule;
    header('Location: index.php'); // vers la page des communiqués
    exit();
} else {
    header('Location: login.html?erreur=1');
    exit();
}
