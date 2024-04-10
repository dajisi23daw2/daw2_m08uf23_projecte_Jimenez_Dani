<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_POST['uid'];
    $ou = $_POST['ou'];
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
    
    $ldap->delete($dn);
    echo "Usuario borrado<br>";
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	UID: <input type="text" name="uid"><br> OU: <input type="text"
		name="ou"><br> <input type="submit" value="Borrar Usuario">
</form>

<form action="menu.php">
	<input type="submit" value="Volver al menú">
</form>
