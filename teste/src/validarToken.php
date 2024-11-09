<?php
session_start();

if ($_POST['token'] === $_SESSION['token']) {
    echo "Token válido!";
} else {
    echo "Token inválido!";
}
?>
