<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muzicka skola</title>
</head>

<body>
<?php
    // spremi bazu za koriscenje
    require('database.php'); //dostupnost database.php ovde
    $db = new Database('muzickaskola');

    // proveri da li je bio neki POST
    if (isset($_POST['akcija'])) {
        switch ($_POST['akcija']) {
        case 'ucenik':
            $columns = ['ime', 'prezime', 'datum_rodjenja', 'telefon', 'datum_upisa'];
            $values = [$_POST['ime'], $_POST['prezime'], $_POST['datum_rodjenja'], $_POST['telefon'], $_POST['datum_upisa']];
            if (! $db->insert('ucenici', $columns, $values)) {
                echo 'Greska u: ' . $db->getError();
            }

            if (isset($_POST['kursevi'])) {
                $ucenik_id = $db->getInsertId();
                $columns = ['u_id', 'k_id', 'datum_upisa' ];
                foreach ($_POST['kursevi'] as $kurs_id) {
                    if (! $db->insert('ucenici_kursevi', $columns, [$ucenik_id, $kurs_id, date('Y-m-d')])) {
                        echo 'Greska u_k: ' . $db->getError();
                    }
                }
            }
        break;
        case 'kurs':
            $columns = ['instrument_ime', 'profesor_ime'];
            $values = [$_POST['instrument_ime'], $_POST['profesor_ime']];
            if (! $db->insert('kursevi', $columns, $values)) {
                echo 'Greska k: ' . $db->getError();
            }
        break;
        case 'delete_ucenik':
            if (! $db->delete('ucenici', $_POST['u_id'])) {
                echo 'Greska delete u: ' . $db->getError();
            }
        break;
        default: echo "def"; 
        break;
        }
    }

    // dohvati sve kurseve
    $db->select('kursevi');
    $kursevi = $db->getResult();
?>
    <form action="" method="POST">
        <h1>➕ Dodaj novi kurs 🎻</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Instrument</th>
                    <th>Ime profesora</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <input type="hidden" name="akcija" value="kurs" />
                    <td><input type="text" name="instrument_ime" /></td>
                    <td><input type="text" name="profesor_ime" /></td>
                </tr>
        </table>
        <input type="submit" value="Dodaj" />
    </form>

    <form action="" method="POST">
        <h1>➕ Dodaj novog ucenika 👩‍🎓</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Datum rodjenja</th>
                    <th>Kontakt telefon</th>
                    <th>Datum upisa</th>
                    <th>Kursevi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <input type="hidden" name="akcija" value="ucenik" />
                    <td><input type="text" name="ime" /></td>
                    <td><input type="text" name="prezime" /></td>
                    <td><input type="text" name="datum_rodjenja" /></td>
                    <td><input type="text" name="telefon" /></td>
                    <td><input type="text" name="datum_upisa" value="<?php echo date('Y-m-d');?>"/></td>
                    <td>
                        <?php foreach ($kursevi as $kurs) : ?>
                            <input type="checkbox" id="<?php echo $kurs['id']; ?>" name="kursevi[]" value="<?php echo $kurs['id'] ?>">
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

<?php
    // dohvati sve ucenike i njihove kurseve
    $db->executeQuery('
        select u.*, group_concat(k.instrument_ime, " @ ", k.profesor_ime) as kursevi
        from ucenici u
          left join ucenici_kursevi uk
                    on u.id = uk.u_id
               join kursevi k
                    on uk.k_id = k.id 
        group by u.id;
    ');
    $ucenici = $db->getResult();
?>
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
        // ispisi sve ucenike
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
                        foreach (explode(',', $ucenik['kursevi']) as $kurs) :
                            [$instrument_ime, $profesor_ime] = explode('@', $kurs);
                            echo "<li>" . $instrument_ime . " @ " . $profesor_ime . "</li>";
                        endforeach;
                        ?>
                    </ul>
                </td>
                <td>
                  <form action="" method="POST" onsubmit="return confirm('Da li ste sigurni?');">
                    <input type="hidden" name="akcija" value="delete_ucenik" />
                    <input type="hidden" name="u_id" value="<?php echo $ucenik['id']; ?>" />
                    <input type="submit" value="Ispisi iz skole" />
                  </form>
                </td>
            </tr>

        <?php endforeach; ?>

        </tbody>
    </table>
</body>

</html>

