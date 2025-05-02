<?php // Alkalmazás logika:
include('config.inc.php');
// adatok összegyűjtése egy tömbbe:
// A képek adatait egy tömbben tároljuk kulcs-érték párokban: kulcs: fájlnév, érték: módosítási idő
$kepek = array();
$olvaso = opendir($MAPPA);
while (($fajl = readdir($olvaso)) !== false) {
if (is_file($MAPPA.$fajl)) { // almappákkal nem foglalkozunk, csak fájlokkal
// fájl kiterjesztésének kiolvasása (utolsó 3 karakter), és kisbetűssé alakítása
// substr függvény: 2 paraméter: fájlnév, kezdő karakter.
$vege = strtolower(substr($fajl, strlen($fajl)-4));
if (in_array($vege, $TIPUSOK)) // jpg és png fájlokkal foglalkozunk csak
// $MAPPA.$fajl: összefűzi a két stringet. pl. kepek/DSC_1099.JPG
// filemtime: a fájl módosítás időpontja Unix időként megadva. pl. 1477118030:
// 1970. január 1. éjfél óta eltelt másodpercek száma
// https://hu.wikipedia.org/wiki/Unix-id%C5%91
// http://php.net/manual/en/function.filemtime.php
$kepek[$fajl] = filemtime($MAPPA.$fajl); kulcs: fájlnév, érték: módosítási idő
}
}
closedir($olvaso);