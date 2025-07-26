<?php
session_start();
if (!isset($_SESSION["logged_in"])) {
  header("Location: login.html");
  exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Communiqués</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f7f7f7;
      margin: 0;
      padding: 40px;
      text-align: center;
    }

    h2 {
      font-size: 28px;
      color: #0a3d62;
      margin-bottom: 30px;
      font-weight: bold;
    }

    .card {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #fff;
      border-radius: 12px;
      padding: 18px 24px;
      margin: 12px auto;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
      width: 90%;
      max-width: 600px;
      cursor: pointer;
      transition: transform 0.2s ease;
    }

    .card:hover {
      transform: translateY(-2px);
    }

    .title {
      font-size: 18px;
      color: #003366;
      text-align: left;
    }

    .arrow {
      font-size: 24px;
      color: #003366;
    }

    .logout {
      position: absolute;
      top: 20px;
      right: 20px;
      background: #e74c3c;
      color: white;
      padding: 8px 16px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
    }

    .logout:hover {
      background: #c0392b;
    }
  </style>
</head>
<body>
  <a class="logout" href="logout.php">Déconnexion</a>
  <h2>Communiqué</h2>

  <div class="card" onclick="window.location.href='detail.html'">
    <span class="title">Communiqué du 14 juillet</span>
    <span class="arrow"></span>
  </div>

  <div class="card" onclick="window.location.href='detail.html'">
    <span class="title">Communiqué du 14 juillet</span>
    <span class="arrow"></span>
  </div>

  <div class="card" onclick="window.location.href='detail.html'">
    <span class="title">Communiqué du 14 juillet</span>
    <span class="arrow"></span>
  </div>

  <div class="card" onclick="window.location.href='detail.html'">
    <span class="title">Communiqué du 14 juillet</span>
    <span class="arrow"></span>
  </div>
</body>
</html>
