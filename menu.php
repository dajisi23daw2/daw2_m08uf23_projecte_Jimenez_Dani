<?php
session_start();

if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}
?>

<html>
<head>
    <title>PÀGINA WEB DEL MENÚ PRINCIPAL DE L'APLICACIÓ D'ACCÉS A BASES DE DADES LDAP</title>
</head>
<body>
    <h2>MENÚ PRINCIPAL DE L'APLICACIÓ D'ACCÉS A BASES DE DADES LDAP</h2>

    <a href="https://zend-dajisi.fjeclot.net/projecte/index.php">Torna a la pàgina inicial</a><br>
    <a href="https://zend-dajisi.fjeclot.net/projecte/consultar_usuaris.php">Consultar Usuaris</a><br>
    <a href="https://zend-dajisi.fjeclot.net/projecte/afegir_usuaris.php">Afegir Usuaris</a><br>
    <a href="https://zend-dajisi.fjeclot.net/projecte/esborrar_usuaris.php">Esborrar Usuaris</a><br>
    <a href="https://zend-dajisi.fjeclot.net/projecte/modificar_usuaris.php">Modificar Usuaris</a><br>
    <a href="https://zend-dajisi.fjeclot.net/projecte/creacio_usuari.php">Creació d'usari test</a><br>

    <form method="post">
        <button type="submit" name="logout">Tancar Sessió</button>
    </form>
</body>
</html>
