<?php

class EmailHandler {

    // Conexão com o servidor IMAP
    private $conn;

    // Armazenamento de e-mails e contagem de mensagens
    private $inbox = [];
    private $msg_cnt = 0;

    // Credenciais de login de e-mail
    private $server;
    private $user;
    private $pass;
    private $port;

    // Construtor para definir as credenciais e conectar ao servidor
    public function __construct($server, $user, $pass, $port = 993) {
        $this->server = $server;
        $this->user = $user;
        $this->pass = $pass;
        $this->port = $port;

        // Conectar ao servidor IMAP e carregar os e-mails da caixa de entrada
        $this->connect();
        $this->getInbox();
    }

    // Método para fechar a conexão
    public function close() {
        $this->inbox = [];
        $this->msg_cnt = 0;
        imap_close($this->conn);
    }

    // Método para conectar ao servidor IMAP
    private function connect() {
        // String de conexão IMAP
        $imapPath = "{" . $this->server . ":" . $this->port . "/imap/ssl}INBOX";
        $this->conn = imap_open($imapPath, $this->user, $this->pass);

        if (!$this->conn) {
            die("Erro ao conectar no servidor IMAP: " . imap_last_error());
        }
    }

    // Método para ler os e-mails da caixa de entrada
    public function getInbox() {
        $this->msg_cnt = imap_num_msg($this->conn); // Conta o número de e-mails

        // Loop para ler cada e-mail
        for ($i = 1; $i <= $this->msg_cnt; $i++) {
            $header = imap_headerinfo($this->conn, $i); // Cabeçalho do e-mail
            $body = imap_body($this->conn, $i);         // Corpo do e-mail

            // Armazena o e-mail lido em um array
            $this->inbox[] = [
                'index' => $i,
                'from' => $header->fromaddress,
                'subject' => $header->subject,
                'date' => $header->date,
                'body' => $body
            ];
        }
    }

    // Método para exibir os e-mails lidos
    public function displayEmails() {
        if (empty($this->inbox)) {
            echo "<p>Caixa de entrada vazia.</p>";
            return;
        }

        echo "<h2>E-mails Recebidos:</h2><ul>";
        foreach ($this->inbox as $email) {
            echo "<li>";
            echo "<strong>De:</strong> " . htmlspecialchars($email['from']) . "<br>";
            echo "<strong>Assunto:</strong> " . htmlspecialchars($email['subject']) . "<br>";
            echo "<strong>Data:</strong> " . htmlspecialchars($email['date']) . "<br>";
            echo "<strong>Corpo:</strong> " . nl2br(htmlspecialchars(substr($email['body'], 0, 200))) . "...<br>";
            echo "</li><hr>";
        }
        echo "</ul>";
    }

    // Método para mover um e-mail para outra pasta
    public function moveEmail($msg_index, $folder = 'INBOX.Processed') {
        imap_mail_move($this->conn, $msg_index, $folder);
        imap_expunge($this->conn);
        $this->getInbox(); // Atualiza a lista de e-mails após mover
    }
}

?>
