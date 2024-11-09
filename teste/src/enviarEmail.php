<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
require '../config/emailConfig.php';

function enviarEmail($to, $subject, $message) {
	$config = require '../config/emailConfig.php';
	$mail = new PHPMailer(true);

	try {
		$mail-isSMTP();
		$mail->Host = $config['smtp']['host'];
		$mail->SMTPAuth = true;
		$mail->Username = $config['smtp']['username'];
		$mail->Password = $config['smtp']['senha_app'];
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$mail->Port = $config['smtp']['port'];

		$mail->setFrom($config['smtp']['username'], 'Roberto Pires');
		$mail->addAddress($to);
		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $message;

		$mail->send();
		echo "E-mail enviado com sucesso!";
	} catch (Exception $e) {
		echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
	}
}
?>
