<?php

session_start();
if (!isset($_SESSION['tomb'])) {
    // $_SESSION["tomb"] = ["", "", "", ""];
    $_SESSION["tomb"] = ["", "", "", "", ""];
}
if (!isset($_SESSION['hiba'])) {
    $_SESSION["hiba"] = 0;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>PHP gyakorlás</title>
</head>

<body>
    <main class="container-lg py-5">
        <section class="row">
            <article class="col">
                <form method="post" class="container-lg">
                    <?php

                    $hiba = $_SESSION["hiba"];

                    // hibapontok számolása
                    // isset($_POST["data"]) && $_SESSION["szamlalo"] === false
                    if ($_SESSION["szamlalo"] === false) {
                        $_SESSION["hiba"] += 1;
                    }


                    echo ($hiba > 5 ? '<div>Vesztettél!</div>' : '<div>Hibapontok: ' . $hiba . '</div>');

                    echo '<hr>';

                    $gombok = [
                        ['a', 'b', 'c', 'd', 'e', 'f', 'g'],
                        ['h', 'i', 'j', 'k', 'l', 'm', 'n'],
                        ['o', 'p', 'q', 'r', 's', 't', 'u'],
                        ['v', 'w', 'x', 'y', 'z', 'á', 'é'],
                        ['í', 'ó', 'ö', 'ő', 'ú', 'ü', 'ű'],
                        ['törlés']
                    ];

                    foreach ($gombok as $sor) {
                        echo '<section class="row gy-3">';
                        foreach ($sor as $gomb) {
                            echo '<article class="col"><div class="p-2"><input type="submit" class="form-control" name="data" id="' . $gomb . '" value="' . $gomb . '"></div></article>';
                        }
                        echo '</section>';
                    }

                    // $_SESSION["szo"] = ['a', 'l', 'm', 'a'];
                    $_SESSION["szo"] = ['m', 'á', 'l', 'n', 'a'];
                    $tomb = $_SESSION["tomb"];

                    // frissítési gondok vannak
                    // header("location: tombos.php");
                    if ($_SERVER["REQUEST_METHOD"] === 'POST') {

                        if ($_POST["data"] === "törlés") {
                            unset($_SESSION["tomb"]);
                            $_SESSION["hiba"] = 0;
                            $_SESSION["szamlalo"] === true;
                        } else {
                            if (isset($_POST["data"])) {
                                // ciklus kezdete
                                for ($i = 0; $i < count($_SESSION["szo"]); $i++) {
                                    // egyezőség feltétele
                                    if ($_SESSION["szo"][$i] === $_POST["data"]) {
                                        // kiírás feltétele
                                        if (mb_strlen(trim($_SESSION["tomb"][$i])) === 0) {
                                            $_SESSION["tomb"][$i] = $_POST["data"];
                                        }
                                        // kiírás vége
                                        $_SESSION["szamlalo"] = true;
                                    } else {
                                        $_SESSION["szamlalo"] = false;
                                        //
                                        // $_SESSION["hiba"] += 1;
                                    }
                                }
                                // ciklus vége

                            }
                        }
                    }

                    // print_r($tomb);

                    for ($i = 0; $i < count($tomb); $i++) {
                        echo '<li>' . $tomb[$i] . '</li>';
                    }

                    ?>
                </form>
            </article>
        </section>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/js/bootstrap.bundle.min.js" integrity="sha512-9GacT4119eY3AcosfWtHMsT5JyZudrexyEVzTBWV3viP/YfB9e2pEy3N7WXL3SV6ASXpTU0vzzSxsbfsuUH4sQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>