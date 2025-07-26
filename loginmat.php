<?php
session_start();
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"];
    if ($password === "MonMotDePasse123") { // <-- modifie ton mot de passe ici
        $_SESSION["logged_in"] = true;
        header("Location: communique.php");
        exit();
    } else {
        $error = "Mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Connexion</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .login-box {
      background: white;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    .login-box h2 {
      color: #1877f2;
      margin-bottom: 20px;
    }

    input[type="password"] {
      width: 90%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
    }

    .toggle-eye {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      font-size: 18px;
      color: #888;
    }

    button {
      padding: 12px 20px;
      font-size: 16px;
      background: #1877f2;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    button:hover {
      background: #145dbf;
    }

    .error {
      color: red;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <form class="login-box" method="POST" action="">
    <h2><i class="fas fa-user-graduate"></i> Connexion</h2>

    <div class="input-group">
      <input type="password" name="password" placeholder="Mot de passe" id="password" required />
      <span class="toggle-eye" onclick="togglePassword()">
        <i id="eye-icon" class="fas fa-eye"></i>
      </span>
    </div>

    <button type="submit">Se connecter</button>

    <!-- Affichage du message d'erreur seulement si $error est défini -->
    <?php if ($error): ?>
      <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
  </form>

  <script>
    function togglePassword() {
      const pwd = document.getElementById("password");
      const eyeIcon = document.getElementById("eye-icon");

      // Change le type de champ de mot de passe et l'icône de l'œil
      if (pwd.type === "password") {
        pwd.type = "text"; // Affiche le mot de passe
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash"); // Icône de l'œil barré
      } else {
        pwd.type = "password"; // Masque le mot de passe
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye"); // Icône de l'œil normal
      }
    }
  </script>
  
  <!-- Intégration de Font Awesome -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
