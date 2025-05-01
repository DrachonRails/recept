<?php
// Az űrlap adatainak szerver oldali validációja
// ha nincs nev mező, vagy a tartalma kevesebb, mint 5 karakter
if(!isset($_POST['nev']) || strlen($_POST['nev']) < 5)
exit("Hibás név: ".$_POST['nev']); // befejezi az alkalmazást
// Itt is a megadott reguláris kifejezéssel ellennőrzi az email-t
$re = '/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/';
if(!isset($_POST['email']) || !preg_match($re,$_POST['email']))
exit("Hibás email: ".$_POST['email']);
// Ha nincs Üzenet szövegterület, vagy üres az adata
if(!isset($_POST['szoveg']) || empty($_POST['szoveg']))
exit("Hibás szöveg: ".$_POST['szoveg']);
echo "Kapott értékek: ";
// Strukturáltan kiírja a $_POST tömb adatait.
echo "<pre>";
var_dump($_POST);
echo "</pre>";
?>