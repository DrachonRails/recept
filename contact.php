<?php
// pages/contact.php
require_once 'db/db.php';

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $message = trim($_POST['message']);

  // Szerveroldali ellenőrzés (HTML5 nélkül)
  if ($name === '' || $email === '' || $message === '') {
    $errors[] = "Minden mező kitöltése kötelező.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Hibás e-mail cím formátum.";
  }

  if (empty($errors)) {
    $stmt = $pdo->prepare("INSERT INTO messages (name, email, message, sent_at, sender) VALUES (?, ?, ?, NOW(), ?)");
    $sender = $_SESSION['user']['name'] ?? 'Vendég';
    $stmt->execute([$name, $email, $message, $sender]);
    $success = true;
  }
}
?>

<h2>Kapcsolatfelvétel</h2>
<form method="post" onsubmit="return validateContactForm()">
  <label>Név: <input type="text" name="name"></label><br>
  <label>Email: <input type="text" name="email"></label><br>
  <label>Üzenet:<br><textarea name="message" rows="5" cols="40"></textarea></label><br>
  <button type="submit">Küldés</button>
</form>

<div id="errorBox" style="color:red;"></div>

<?php
if ($success) echo "<p style='color:green;'>Az üzeneted sikeresen elküldve.</p>";
if ($errors) {
  echo "<ul style='color:red;'>";
  foreach ($errors as $e) echo "<li>$e</li>";
  echo "</ul>";
}
?>

<script>
function validateContactForm() {
  const name = document.querySelector('[name=name]').value.trim();
  const email = document.querySelector('[name=email]').value.trim();
  const message = document.querySelector('[name=message]').value.trim();
  const box = document.getElementById('errorBox');
  box.innerHTML = "";

  if (!name || !email || !message) {
    box.innerText = "Minden mező kitöltése kötelező.";
    return false;
  }
  if (!email.includes("@") || !email.includes(".")) {
    box.innerText = "Érvénytelen e-mail cím.";
    return false;
  }
  return true;
}
</script>
