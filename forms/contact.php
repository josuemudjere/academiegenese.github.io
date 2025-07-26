<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $to = "josuemudjere5@gmail.com";  // Ton adresse e-mail
  $name    = htmlspecialchars($_POST['name'] ?? '');
  $email   = htmlspecialchars($_POST['email'] ?? '');
  $subject = htmlspecialchars($_POST['subject'] ?? '');
  $message = htmlspecialchars($_POST['message'] ?? '');

  if (!$name || !$email || !$subject || !$message) {
    echo json_encode(['success' => false, 'message' => 'Tous les champs sont obligatoires.']);
    exit;
  }

  $fullMessage = "Nom : $name\nEmail : $email\n\nMessage :\n$message";

  //  1. Envoi au responsable du site (toi)
  $headersToAdmin  = "From: $name <$email>\r\n";
  $headersToAdmin .= "Reply-To: $email\r\n";
  $headersToAdmin .= "Content-Type: text/plain; charset=UTF-8\r\n";

  $sentToAdmin = mail($to, $subject, $fullMessage, $headersToAdmin);

  //  2. Envoi de copie à l'expéditeur
  $copySubject = "Copie de votre message : " . $subject;
  $copyMessage = "Bonjour $name,\n\nMerci pour votre message. Voici une copie de ce que vous avez envoyé :\n\n" .
                 "-------------------------\n" .
                 "$message\n\n" .
                 "-------------------------\n" .
                 "Nous vous répondrons dans les plus brefs délais.\n\nCordialement,\nL’équipe de l’école";

  $headersToSender  = "From: École <noreply@votre-site.com>\r\n";
  $headersToSender .= "Reply-To: $to\r\n";
  $headersToSender .= "Content-Type: text/plain; charset=UTF-8\r\n";

  $sentToSender = mail($email, $copySubject, $copyMessage, $headersToSender);

  if ($sentToAdmin && $sentToSender) {
    echo json_encode(['success' => true, 'message' => ' Message envoyé avec succès. Une copie vous a été envoyée.']);
  } else {
    echo json_encode(['success' => false, 'message' => ' Erreur lors de l’envoi du message ou de la copie.']);
  }

} else {
  http_response_code(405);
  echo json_encode(['success' => false, 'message' => 'Méthode non autorisée.']);
}
?>
