<?php
// pages/messages.php
require_once 'db/db.php';

if (!isset($_SESSION['user'])) {
  echo "<p>Az üzenetek megtekintéséhez be kell jelentkeznie.</p>";
  return;
}

$stmt = $pdo->query("SELECT name, email, message, sent_at, sender FROM messages ORDER BY sent_at DESC");
$messages = $stmt->fetchAll();
?>

<h2>Kapcsolati űrlap üzenetei</h2>
<table border="1" cellpadding="5" cellspacing="0">
  <tr>
    <th>Küldő</th>
    <th>Név</th>
    <th>Email</th>
    <th>Üzenet</th>
    <th>Küldés ideje</th>
  </tr>
  <?php foreach ($messages as $m): ?>
    <tr>
      <td><?= htmlspecialchars($m['sender']) ?></td>
      <td><?= htmlspecialchars($m['name']) ?></td>
      <td><?= htmlspecialchars($m['email']) ?></td>
      <td><?= nl2br(htmlspecialchars($m['message'])) ?></td>
      <td><?= $m['sent_at'] ?></td>
    </tr>
  <?php endforeach; ?>
</table>
