<?php
phpinfo();
exit;
require '../src/EmailHandler.php';
require '../config/EmailConfig.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Leitura de E-mails</title>
</head>

<body>
	<h1>Leitura de E-mails</h1>
	<?php
	try {
		global $config;
		$server = $config['server'];
		$user = $config['user'];
		$pass = $config['pass'];

		$emailHandler = new EmailHandler($server, $user, $pass);
		$emailHandler->displayEmails();
		$emailHandler->close();
	} catch (Exception $e) {
		echo "<p>Erro ao ler os e-mails: " . $e->getMessage() . "</p>";
	}
	?>
</body>

</html>