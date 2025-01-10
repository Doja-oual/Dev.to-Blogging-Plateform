<?php
$password = 'admin123'; // Mot de passe en texte brut
$hash = password_hash($password, PASSWORD_DEFAULT); // Générer le hash
echo "Hash pour admin123 : " . $hash;
?>