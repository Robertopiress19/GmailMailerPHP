# GmailMailerPHP

## Descrição
GmailMailerPHP é um projeto em PHP para leitura e exibição de e-mails. Ele usa a biblioteca PHPMailer para facilitar a comunicação com os servidores de e-mail.

## Estrutura do Projeto
- `index.php`: Ponto de entrada do aplicativo que lida com a leitura e exibição de e-mails.
- `composer.json`: Arquivo de configuração do Composer que gerencia as dependências do projeto, incluindo PHPMailer.

## Pré-requisitos
- PHP 7.4 ou superior
- Composer

## Instalação
1. Clone o repositório:
    ```sh
    git clone https://github.com/Robertopiress19/GmailMailerPHP.git
    ```
2. Navegue até o diretório do projeto:
    ```sh
    cd GmailMailerPHP
    ```
3. Instale as dependências usando o Composer:
    ```sh
    composer install
    ```

## Uso
1. Configure as credenciais de e-mail no arquivo `EmailConfig.php`.
2. Execute o servidor PHP:
    ```sh
    php -S localhost:8000 -t public
    ```
3. Acesse `http://localhost:8000` no seu navegador para visualizar a leitura de e-mails.

## Contribuição
Contribuições são bem-vindas! Sinta-se à vontade para abrir issues e enviar pull requests.

## Licença
Este projeto está licenciado sob a Licença MIT. Veja o arquivo `LICENSE` para mais detalhes.
