<?php

session_start();

if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header("Location: login.php");
    exit();
}

require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_POST['uid'];
    $unorg = $_POST['ou'];
    $num_id = $_POST['uidNumber'];
    $grup = $_POST['gidNumber'];
    $dir_pers = $_POST['homeDirectory'];
    $sh = $_POST['loginShell'];
    $cn = $_POST['cn'];
    $sn = $_POST['sn'];
    $nom = $_POST['givenName'];
    $mobil = $_POST['mobile'];
    $adressa = $_POST['postalAddress'];
    $telefon = $_POST['telephoneNumber'];
    $titol = $_POST['title'];
    $descripcio = $_POST['description'];
    $objcl = [
        'inetOrgPerson',
        'organizationalPerson',
        'person',
        'posixAccount',
        'shadowAccount',
        'top'
    ];
    
    $domini = 'dc=fjeclot,dc=net';
    $opcions = [
        'host' => 'zend-dajisi.fjeclot.net',
        'username' => "cn=admin,$domini",
        'password' => 'clotfje',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net'
    ];
    $ldap = new Ldap($opcions);
    $ldap->bind();
    $nova_entrada = [];
    Attribute::setAttribute($nova_entrada, 'objectClass', $objcl);
    Attribute::setAttribute($nova_entrada, 'uid', $uid);
    Attribute::setAttribute($nova_entrada, 'uidNumber', $num_id);
    Attribute::setAttribute($nova_entrada, 'gidNumber', $grup);
    Attribute::setAttribute($nova_entrada, 'homeDirectory', $dir_pers);
    Attribute::setAttribute($nova_entrada, 'loginShell', $sh);
    Attribute::setAttribute($nova_entrada, 'cn', $cn);
    Attribute::setAttribute($nova_entrada, 'sn', $sn);
    Attribute::setAttribute($nova_entrada, 'givenName', $nom);
    Attribute::setAttribute($nova_entrada, 'mobile', $mobil);
    Attribute::setAttribute($nova_entrada, 'postalAddress', $adressa);
    Attribute::setAttribute($nova_entrada, 'telephoneNumber', $telefon);
    Attribute::setAttribute($nova_entrada, 'title', $titol);
    Attribute::setAttribute($nova_entrada, 'description', $descripcio);
    $dn = 'uid=' . $uid . ',ou=' . $unorg . ',' . $domini;
    if ($ldap->add($dn, $nova_entrada))
        echo "Usuario creado";
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	UID: <input type="text" name="uid"><br> OU: <input type="text"
		name="ou"><br> UID Number: <input type="text" name="uidNumber"><br>
	GID Number: <input type="text" name="gidNumber"><br> Home Directory: <input
		type="text" name="homeDirectory"><br> Login Shell: <input type="text"
		name="loginShell"><br> CN: <input type="text" name="cn"><br> SN: <input
		type="text" name="sn"><br> Given Name: <input type="text"
		name="givenName"><br> Mobile: <input type="text" name="mobile"><br>
	Postal Address: <input type="text" name="postalAddress"><br> Telephone
	Number: <input type="text" name="telephoneNumber"><br> Title: <input
		type="text" name="title"><br> Description: <input type="text"
		name="description"><br> <input type="submit" value="Crear Usuario">
</form>

<form action="menu.php">
	<input type="submit" value="Volver al menú">
</form>