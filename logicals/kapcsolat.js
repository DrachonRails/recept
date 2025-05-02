window.onload = function() {
    var kuld = document.getElementById("kuld");
    if (kuld) // Ha a "kuld" ID-jű elem létezik
    kuld.disabled = true; // A disabled element is unusable and un-clickable.
    };
    // Kliens oldali ellenőrzés
    function ellenoriz() { // Két helyen hívjuk meg a HTML fájlban
    // A következő két változó helyett meg lehet oldani egy változóval is. HF: oldják meg egy változóval
    // A metódus végén (return rendben) a rendben változó értéke kerül visszaadásra.
    // Itt true-ra állítjuk. Ha hibát találunk az ellenőrzés során, akkor azt false értékre állítjuk.
    var rendben = true;
    // Ha hiba történik, akkor vigye a fókuszt az első hibás elemre [focus() függvény]
    // Ha nincs hiba, akkor a fókusz változó null marad:
    var fokusz = null;
    // Miért fordított sorrendben ellenőrzi a 3 elemet? Üzenet, Email, Név
    var szoveg = document.getElementById("szoveg");
    if (szoveg) { // ha létezik az üzenet rész
    if (szoveg.value.length==0) { // ha üresen hagytuk az üzenetet
    rendben = false;
    szoveg.style.background = '#f99'; // pirosra színezi az üzenet mező hátterét
    fokusz = szoveg; // az üzenet mezőre helyezi a fókuszt
    } else
    szoveg.style.background = '#9f9'; // zöldre színezi az üzenet mező hátterét
    }
    var email = document.getElementById("email");
    if (email) { // reguláris kifejezés a helyes email-re. https://regex101.com/
    var checkPattern = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (!checkPattern.test(email.value)) { // ha nem helyes az email
    rendben = false;
    email.style.background = '#f99';
    fokusz = email;
    } else
    email.style.background = '#9f9';
    }
    var nev = document.getElementById("nev");
    if (nev) {
    if (nev.value.length<5) { // Ha a név karaktereinek száma kisebb mint 5
    rendben = false;
    nev.style.background = '#f99';
    fokusz = nev;
    } else
    nev.style.background = '#9f9'; }
    // Eredetileg a fokusz értékét null-ra állítottuk. Ha állítottuk a fókuszt az ellenőrzés közben:
    if (fokusz)
    // A fokusz által jelölt objektumra állítja a fókuszt:
    fokusz.focus();
    var kuld = document.getElementById("kuld");
    if (kuld)
    // Ha minden adat jó volt, akkor rendben=true => !rendben=false => kuld.disabled = false
    // Ha nem volt minden adat jó, akkor rendben=false => !rendben=true => kuld.disabled = true
    kuld.disabled = !rendben;
    return rendben;
    }