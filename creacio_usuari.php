<?php
    require 'vendor/autoload.php';
    use Laminas\Ldap\Attribute;
    use Laminas\Ldap\Ldap;

        $uid = 'test';
        $unorg = 'usuaris';
        $num_id = 2024;
        $grup = 1;
        $dir_pers = '1';
        $sh = '1';
        $cn = "1";
        $sn = '1';
        $nom = '1';
        $mobil = '1';
        $adressa = '1';
        $telefon = '1';
        $titol = '1';
        $descripcio = '1';
        $objcl = ['inetOrgPerson', 'organizationalPerson', 'person', 'posixAccount', 'shadowAccount', 'top'];

        $domini = 'dc=fjeclot,dc=net';
        $opcions = [
            'host' => 'zend-dajisi.fjeclot.net',
            'username' => "cn=admin,$domini",
            'password' => 'clotfje',
            'bindRequiresDn' => true,
            'accountDomainName' => 'fjeclot.net',
            'baseDn' => 'dc=fjeclot,dc=net',
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

        $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
        if($ldap->add($dn, $nova_entrada)) {
            header("Location: menu.php");
        }
?>
