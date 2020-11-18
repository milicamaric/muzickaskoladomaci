<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muzicka skola</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous">
    </script>

</head>

<body>
    <?php
    // TODO: uzmi iz baze
    $kursevi = array(
        array(
            'id' => 1,
            'instrument_ime' => 'Gitara',
            'profesor_ime' => 'Jelisaveta Ostojic'
        ),
        array(
            'id' => 2,
            'instrument_ime' => 'Klavir',
            'profesor_ime' => 'Veljko Trifunovic'
        ),
        array(
            'id' => 3,
            'instrument_ime' => 'Violina',
            'profesor_ime' => 'Miona Petrovic'
        ),
        array(
            'id' => 4,
            'instrument_ime' => 'Bubnjevi',
            'profesor_ime' => 'Goran Markovic'
        ), array(
            'id' => 5,
            'instrument_ime' => 'Flauta',
            'profesor_ime' => 'Olga Petrov'
        )
    );
    ?>
    <form action="" method="POST">
        <h1>➕ Dodaj novog ucenika 👩‍🎓</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Datum rodjenja</th>
                    <th>Kontakt telefon</th>
                    <th>Kursevi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="ime" /></td>
                    <td><input type="text" name="prezime" /></td>
                    <td><input type="text" name="datum_rodjenja" /></td>
                    <td><input type="text" name="telefon" /></td>
                    <td>
                        <?php foreach ($kursevi as $kurs) : ?>
                            <input type="checkbox" id="<?php echo $kurs['id']; ?>" name="kursevi" value="<?php echo $kurs['id'] ?>">
                            <label for="<?php echo $kurs['id'] ?>"><?php echo $kurs['instrument_ime'] . " (" . $kurs['profesor_ime'] . ")"; ?></label><br>
                        <?php endforeach; ?>
                    </td>
                </tr>
        </table>
        <input type="submit" value="Dodaj" />
    </form>

    <h1> 📓 Spisak ucenika 👨‍🎓</h1>
    <label for="kursevi">Odaberite kurs:</label>
    <select name="kursevi" id="kursevi">
        <?php foreach ($kursevi as $kurs) : ?>
            <option value=<?php echo $kurs['id']; ?>><?php echo $kurs['instrument_ime'] . " (" . $kurs['profesor_ime'] . ")"; ?></option>
        <?php endforeach; ?>
    </select>
    <p> </p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Datum rodjenja</th>
                <th>Kontakt telefon</th>
                <th>Datum upisa u skolu</th>
                <th>Kursevi i profesori</th>
                <th>✏</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // TODO: uzmi iz baze
            $ucenici = array(
                array(
                    'id' => 1,
                    'ime' => 'Milos',
                    'prezime' => 'Bajagic',
                    'datum_rodjenja' => date('d.m.Y', mktime(0, 0, 0, 4, 5, 2006)),
                    'telefon' => '064999666',
                    'datum_upisa' => date('d.m.Y', mktime(0, 0, 0, 6, 7, 2020)),
                    'kursevi' => array(
                        array(
                            'kurs_ime' => 'Gitara',
                            'profesor_ime' => 'Jelisaveta Ostojic'
                        )
                    )
                ),
                array(
                    'id' => 2,
                    'ime' => 'Milica',
                    'prezime' => 'Jakovljevic',
                    'datum_rodjenja' => date('d.m.Y', mktime(0, 0, 0, 8, 3, 1998)),
                    'telefon' => '063305904',
                    'datum_upisa' => date('d.m.Y', mktime(0, 0, 0, 1, 7, 2020)),
                    'kursevi' => array(
                        array(
                            'kurs_ime' => 'Violona',
                            'profesor_ime' => 'Miona Petrovic'
                        )
                    )
                ),
                array(
                    'id' => 3,
                    'ime' => 'Jana',
                    'prezime' => 'Djurdjevic',
                    'datum_rodjenja' => date('d.m.Y', mktime(0, 0, 0, 5, 10, 1998)),
                    'telefon' => '0649517695',
                    'datum_upisa' => date('d.m.Y', mktime(0, 0, 0, 7, 7, 2020)),
                    'kursevi' => array(
                        array(
                            'kurs_ime' => 'Bubnjevi',
                            'profesor_ime' => 'Goran Markovic'
                        )
                    )
                )
            );

            foreach ($ucenici as $ucenik) :

            ?>
                <tr>
                    <td><?php echo $ucenik['ime']; ?></td>
                    <td><?php echo $ucenik['prezime']; ?></td>
                    <td><?php echo $ucenik['datum_rodjenja']; ?></td>
                    <td><?php echo $ucenik['telefon']; ?></td>
                    <td><?php echo $ucenik['datum_upisa']; ?></td>
                    <td>
                        <ul><?php
                            foreach ($ucenik['kursevi'] as $kurs) :
                                echo "<li>" . $kurs['kurs_ime'] . " (" . $kurs['profesor_ime'] . ")</li>";
                            endforeach;
                            ?>
                        </ul>
                    </td>
                    <td>
                        <a href="obrisi.php?id=<?php echo $ucenik['id']; ?>">
                            <img src="assets/refresh-arrows.png" width="20px" height="20px" />
                        </a>
                        <a href="izmeni.php?id=<?php echo $ucenik['id'] ?>">
                            <img src="assets/refresh-arrows.png" width="20px" height="20px" />
                        </a>
                    </td>
                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>

</body>

</html>

<script>
    // kreiramo niz blokova, odnosno niz svih id vrednosti div sekcija
    var nizBlokova = ["get_odgovor", "novosti_post", "kategorije_post", "brisanje_reda", "kategorije_put", "novosti_put", "greska"];

    //na samom početku želimo da sakrijemo sve blokove, dok korisnik ne odabere tip tabele i HTTP zahteva
    function skloniBlokove() {
        //prolazimo kroz niz blokova
        for (const blok of nizBlokova) {
            //i vrednost display atributa u okviru css-a postavljamo na none, kako se ne bi prikazivali
            document.getElementById(blok).style.display = "none";
        }
    };
    //pozivamo funkciju da se izvrši
    skloniBlokove();

    const httpZahtev = "input[name=http_zahtev]";
    $(httpZahtev).on("click", prikaziBlok);
    $("input[name=odabir_tabele]").on("click", resetHTTP);
    $("button").on("click", posaljiZahtev);

    function prikaziBlok() {
        switch ($("input[name=http_zahtev]:checked")[0].id) {
            case "get":
                // u slučaju da odaberemo get, sakrićemo sve prethodno prikazane div-ove
                skloniBlokove();
                //obrisaćemo unutrašnji HTML get_odgovor bloka 
                document.getElementById("get_odgovor").innerHTML = "";
                // i prikazati ga da bude vidljiv, promenom atributa display sa none na block
                document.getElementById(nizBlokova[0]).style.display = "block";
                break;
            case "post":
                // u slučaju da odaberemo post, sakrićemo sve prethodno prikazane div-ove
                skloniBlokove();
                //proverićemo da li je odabrana tabela novosti ili kategorije
                if ($("input[name=odabir_tabele]:checked").length == 0) {
                    //ako nije, želimo da se prikaže div blok za grešku i ispiše poruka da mora biti obeležena greška tabela 
                    document.getElementById(nizBlokova[6]).innerHTML = "Morate odabrati tabelu za manipulaciju";
                    document.getElementById(nizBlokova[6]).style.display = "block";
                } else {
                    //ako jeste odabrana tabela, odnosno length nije 0
                    //uzećemo koja je to tabela, odnosno id tog radio button-a
                    var tabela = $("input[name=odabir_tabele]:checked")[0].id;
                    if (tabela == "radio_kategorija") {
                        //i u slučaju da je u pitanju tabela kategorije
                        //prikazaćemo post formu za kategorije
                        document.getElementById(nizBlokova[2]).style.display = "block";
                    } else if (tabela == "radio_novosti") {
                        //u suprotnom prikazaćemo post formu za novosti
                        document.getElementById(nizBlokova[1]).style.display = "block";
                    }
                }

                break;
            case "put":
                // u slučaju da odaberemo put, sakrićemo sve prethodno prikazane div-ove
                skloniBlokove();
                //proverićemo da li je odabrana tabela novosti ili kategorije
                if ($("input[name=odabir_tabele]:checked").length == 0) {
                    //ako nije, želimo da se prikaže div blok za grešku i ispiše poruka da mora biti obeležena greška tabela 
                    document.getElementById(nizBlokova[6]).innerHTML = "Morate odabrati tabelu za manipulaciju";
                    document.getElementById(nizBlokova[6]).style.display = "block";
                } else {
                    //ako jeste odabrana tabela, odnosno length nije 0
                    //uzećemo koja je to tabela, odnosno id tog radio button-a
                    var tabela = $("input[name=odabir_tabele]:checked")[0].id;
                    if (tabela == "radio_kategorija") {
                        //i u slučaju da je u pitanju tabela kategorije
                        //prikazaćemo put formu za kategorije
                        document.getElementById(nizBlokova[4]).style.display = "block";
                    } else if (tabela == "radio_novosti") {
                        //u suprotnom prikazaćemo put formu za novosti
                        document.getElementById(nizBlokova[5]).style.display = "block";
                    }
                }
                break;
            case "delete":
                //poslednja opcija nam je prikaz bloka za brisanje elemenata iz određene tabele
                skloniBlokove();
                //proverićemo da li je odabrana tabela novosti ili kategorije
                if ($("input[name=odabir_tabele]:checked").length == 0) {
                    //ako nije, želimo da se prikaže div blok za grešku i ispiše poruka da mora biti obeležena greška tabela 
                    document.getElementById(nizBlokova[6]).innerHTML = "Morate odabrati tabelu za manipulaciju";
                    document.getElementById(nizBlokova[6]).style.display = "block";
                } else {
                    //ako jeste odabrana tabela, odnosno length nije 0
                    //prikazaćemo put formu za kategorije
                    var tabela = $("input[name=odabir_tabele]:checked")[0].id;
                    document.getElementById(nizBlokova[3]).style.display = "block";
                }
                break;
            default:
                break;
        }
    }
    //funkcija resetHTTP nam samo resetuje odabrane HTTP zahteve nakon promene odabrane tabele  
    function resetHTTP() {
        skloniBlokove();
        $("input[name=http_zahtev]").prop('checked', false);
    }


    //funkcija posaljiZahtev obrađuje pomoću AJAX-a zahteve koje šaljemo ka serveru
    function posaljiZahtev() {
        //na samom početku nam je bitno da su selektovani i zahtev i tabela
        if ($("input[name=odabir_tabele]:checked").length != 0 && $("input[name=http_zahtev]:checked").length != 0) {
            //ako jesu nastavljamo sa obradom zahteva
            //pamtimo koja je tabela u pitanju
            var tabela = $("input[name=odabir_tabele]:checked")[0].id;

            //i ponovo kroz switch prolazimo i obrađujemo svaki zahtev
            switch ($("input[name=http_zahtev]:checked")[0].id) {
                case "get":
                    //kada je get u pitanju
                    //proveravamo koja je tabela
                    if (tabela == "radio_novosti") {
                        //i nakon toga pozivamo getJSON funkciju kojoj prosleđujemo link endpoint-a našeg API-a
                        //više od funkciji getJSON https://api.jquery.com/jquery.getjson/

                        //getJSON funkcija ima 2 bitna parametra, a to su url koji prosleđujemo i success funkcija koja kojom obrađujemo podatke koje smo dobili
                        //data parametar u okviru funkcije, predstavlja podatke poslate sa servera u JSON formatu
                        $.getJSON("http://localhost/rest/api/novosti", function(data) {
                            //postavljamo unutrašnji HTML div bloka get_odgovor na pretty string reprezentaciju JSON objekta
                            //string reprezentacija je mogla i da se postavi samo sa JSON.stringify(data)
                            // ali postavljamo i parametre null i 2 kako bi prikaz JSONa bio čitljiv
                            document.getElementById("get_odgovor").innerHTML = JSON.stringify(data, null, 2);
                        });
                    } else {
                        //ponavljamo istu proceduru samo za tabelu kategorije
                        $.getJSON("http://localhost/rest/api/kategorije", function(data) {
                            document.getElementById("get_odgovor").innerHTML = JSON.stringify(data, null, 2);
                        });
                    }
                    break;
                case "post":
                    if (tabela == "radio_novosti") {
                        // kada je post zahtev u pitanju, potrebno je da 
                        // prikupimo podatke koje hoćemo da pošaljemo iz forme
                        var values = {
                            "naslov": $("input[name=naslov_novosti]").val(),
                            "tekst": $("#tekst_novosti").val(),
                            "kategorija_id": parseInt($("#kategorija_odabir").val())
                        };

                        //ispisaćemo te podatke u konzoli kako bismo bili siguri da dobijamo dobar izlaz
                        //konzoli pristupamo u brauzeru sa CTRL+Shift+i i biramo tab Console
                        console.log(values);
                        //post zahtev se obrađuje na sličan način kao get
                        //potrebna su nam dva parametra u funkciji post
                        //url na koji šaljemo podatke
                        //koje podatke šaljemo
                        //i success funkcija u okviru koje prikazujemo odgovor sa servera
                        $.post("http://localhost/rest/api/novosti", JSON.stringify(values), function(data) {
                            alert("Odgovor od servera> " + data['poruka']);
                        });
                    } else {
                        //na isti način radimo sa kategorijama, s tim što je potrebno da pokupimo njene vrednosti iz forme
                        var values = {
                            "kategorija": $("input[name=kategorija_naziv]").val()
                        };
                        console.log(values);
                        $.post("http://localhost/rest/api/kategorije", JSON.stringify(values), function(data) {
                            alert("Odgovor od servera> " + data['poruka']);
                        });
                    }
                    break;
                case "put":
                    if (tabela == "radio_novosti") {
                        var id_stare_novosti = $("input[name=id_stare_novosti]").val()
                        var values = {
                            "naslov": $("input[name=naslov_novosti_put]").val(),
                            "tekst": $("textarea[id=tekst_novosti_put]").val(),
                            "kategorija_id": parseInt($("select[id=kategorija_odabir_put] option:selected").val())
                        };

                        console.log(values);

                        $.ajax({
                            method: "PUT",
                            url: "http://localhost/rest/api/novosti/" + id_stare_novosti,
                            data: JSON.stringify(values)
                        }).done(function(data) {
                            alert("Odgovor od serera> " + data['poruka']);
                        });
                    } else {
                        var id_stare_kategorije = $("input[name=id_stare_kategorije]").val()
                        var values = {
                            "kategorija": $("input[name=kategorija_naziv_put]").val(),
                        };

                        console.log(values);

                        $.ajax({
                            method: "PUT",
                            url: "http://localhost/rest/api/kategorije/" + id_stare_kategorije,
                            data: JSON.stringify(values)
                        }).done(function(data) {
                            alert("Odgovor od serera> " + data['poruka']);
                        });
                    }
                    break;
                case "delete":
                    var brisanje = $("input[name=brisanje]").val();

                    console.log("brisem: " + brisanje);

                    var putanja;
                    if (tabela == "radio_novosti") {
                        putanja = "novosti/";
                    } else {
                        putanja = "kategorije/";
                    }

                    $.ajax({
                        method: "DELETE",
                        url: "http://localhost/rest/api/" + putanja + brisanje
                    }).done(function(data) {
                        alert("Odgovor od servera> " + data['poruka']);
                    });
                    break;
                default:
                    console.log("default");
            }
        }
    }
</script>