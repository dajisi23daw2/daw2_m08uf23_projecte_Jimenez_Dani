<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;

function mostrarDetalles($identificador, $ou)
{
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
    $usuari = $ldap->getEntry("uid=$identificador,ou=$ou,$domini");
    
    echo "<b><u>" . $usuari["dn"] . "</b></u><br>";
    foreach ($usuari as $atribut => $dada) {
        if ($atribut != "dn")
            echo $atribut . ": " . $dada[0] . '<br>';
    }
}

if (isset($_GET['identificador']) && isset($_GET['ou'])) {
    $identificador = $_GET['identificador'];
    $ou = $_GET['ou'];
    mostrarDetalles($identificador, $ou);
} else {
    ?>
<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	Identificador: <input type="text" name="identificador"><br> Unidad
	Organizativa: <input type="text" name="ou"><br> <input type="submit"
		value="Mostrar detalles">
</form>
<?php
}
?>
<form action="menu.php">
	<input type="submit" value="Volver al menú">
</form>