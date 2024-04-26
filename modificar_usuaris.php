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
    $ou = $_POST['ou'];
    $atribut = $_POST['atribut'];
    $nou_valor = $_POST['nou_valor'];
    
    $dn = 'uid=' . $uid . ',ou=' . $ou . ',dc=fjeclot,dc=net';
    
    $opciones = [
        'host' => 'zend-dajisi.fjeclot.net',
        'username' => 'cn=admin,dc=fjeclot,dc=net',
        'password' => 'clotfje',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net'
    ];
    
    $ldap = new Ldap($opciones);
    $ldap->bind();
    
    $entrada = $ldap->getEntry($dn);
    
    Attribute::setAttribute($entrada, $atribut, $nou_valor);
    $ldap->update($dn, $entrada);
    echo "Usuario modificado";
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	UID: <input type="text" name="uid"><br> OU: <input type="text"
		name="ou"><br> Atribut a modificar:<br> <input type="radio"
		name="atribut" value="uidNumber"> UID Number<br> <input type="radio"
		name="atribut" value="gidNumber"> GID Number<br> <input type="radio"
		name="atribut" value="homeDirectory"> Directori personal<br> <input
		type="radio" name="atribut" value="loginShell"> Shell<br> <input
		type="radio" name="atribut" value="cn"> CN<br> <input type="radio"
		name="atribut" value="sn"> SN<br> <input type="radio" name="atribut"
		value="givenName"> Given Name<br> <input type="radio" name="atribut"
		value="postalAddress"> Postal Address<br> <input type="radio"
		name="atribut" value="mobile"> Mobile<br> <input type="radio"
		name="atribut" value="telephoneNumber"> Telephone Number<br> <input
		type="radio" name="atribut" value="title"> Title<br> <input
		type="radio" name="atribut" value="description"> Description<br> Nou
	valor: <input type="text" name="nou_valor"><br> <input type="submit"
		value="Modificar Atribut">
</form>


<form action="menu.php">
	<input type="submit" value="Volver al menú">
</form>