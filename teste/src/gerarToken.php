<?php
session_start();
require 'enviarEmail.php';


function gerarToken() {
	return bin2hex(random_bytes(16));
}


$email = $_POST['email'];
$token = gerarToken();
$_SESSION['token'] = $token;

enviarEmail($email, "Token de Validação", "Seu token é: $token");
echo "Token enviado para $email";
?>