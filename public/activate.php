<?php
/**
 * Created by PhpStorm.
 * User: Andrea
 * Date: 29/05/18
 * Time: 23:43
 */
require '../DB/DBQueryManager.php';
require '../DB/DBConnectionManager.php';

$email = $_GET['email'];
$matricola = $_GET['matricola'];

$db = new DBQueryManager();
$esito = "";
($db->confermaProfilo($email, $matricola)) ? $esito = "Email confermata" : $esito = "Non è possibile confermare l'email ora, riprovare più tardi";

?>

<!DOCTYPE html>
<html lang="it">
<header>
    <meta charset="UTF-8">
    <title>Conferma email</title>
</header>
<body>
    <h1><?php echo $esito?></h1>
</body>
</html>
