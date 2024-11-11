<?php

function handleEmails() {

	$server = 'imap.servidor.com';
	$user = 'seugmail@gmail.com';
	$pass = '';
	$port = 993;

	// Conexão com o servidor IMAP
	$conn = null;

	// Armazenamento de e-mails e contagem de mensagens
	$inbox = [];
	$msg_cnt = 0;

	// Conectar ao servidor IMAP
	$imapPath = "{" . $server . ":" . $port . "/imap/ssl/novalidate-cert}INBOX";
	$conn = imap_open($imapPath, $user, $pass);


	// Contar o número de e-mails
	$msg_cnt = imap_num_msg($conn);

	// Limitar a leitura a no máximo 10 e-mails
	$msg_cnt = min($msg_cnt, 5);

	// Ler e armazenar os e-mails
	for ($i = 1; $i <= $msg_cnt; $i++) {
		$header = imap_headerinfo($conn, $i); // Cabeçalho do e-mail
		$body = imap_body($conn, $i);         // Corpo do e-mail

		// Armazena o e-mail lido em um array
		$inbox[] = [
			'index' => $i,
			'from' => $header->fromaddress,
			'subject' => $header->subject,
			'date' => $header->date,
			'body' => $body
		];
	}

	// Exibir os e-mails lidos
	if (empty($inbox)) {
		echo "<p>Caixa de entrada vazia.</p>";
	} else {
		echo "<h2>E-mails Recebidos:</h2><ul>";
		foreach ($inbox as $email) {
			echo "<li>";
			echo "<strong>De:</strong> " . htmlspecialchars($email['from']) . "<br>";
			echo "<strong>Assunto:</strong> " . htmlspecialchars($email['subject']) . "<br>";
			echo "<strong>Data:</strong> " . htmlspecialchars($email['date']) . "<br>";
			echo "<strong>Corpo:</strong> " . nl2br(htmlspecialchars(substr($email['body'], 0, 200))) . "...<br>";
			echo "</li><hr>";
		}
		echo "</ul>";
	}

	// Fechar a conexão
	imap_close($conn);
}
