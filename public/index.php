<?php

// Execute database management scripts

function runScript($fileName)
{
    $cmd = "cd .. && sh ./scripts/" . $fileName;
    shell_exec($cmd);
}

$importDone = false;
$exportDone = false;
$restoreDone = false;

if ($_POST['import'] == 1) {
    runScript("import_dbs.sh");
    $importDone = true;
}

if ($_POST['export'] == 1) {
    runScript("export_dbs.sh");
    $exportDone = true;
}

if ($_POST['restore_default'] == 1) {
    runScript("restore_default_dbs.sh");
    $restoreDone = true;
}

?>
<!doctype html>
<html lang="nl">

<head>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Databases Module</title>
</head>

<body class="container">
    <main class="mx-5 p-5">
        <div class="text-center">
            <h1 class="fw-bold">Databases Module</h1>
            <p class="lead">Maak een dynamische website met een database.</p>
        </div>
        <div class="row mx-5 p-5">
            <div class="col">
                <h3>phpMyAdmin</h3>
                <p>Login met <strong>root</strong> als gebruikersnaam zonder wachtwoord.</p>
                <a class="btn btn-outline-primary" href="/phpmyadmin" title="phpMyAdmin" target="_blank">Open phpMyAdmin</a>
                <br>
                <h3>MySQL Querier</h3>
                <p>Voer queries uit op de MySQL-database.</p>
            <a class="btn btn-outline-primary" href="/mysql-querier" title="MySQL Querier" target="_blank">Open MySQL Querier</a>
            </div>
            <div class="col">
                <h2>Database Beheer</h2>
                <?php
                $mysqli = new mysqli("localhost", "root");
                if ($result = $mysqli->query("SHOW databases")) {
                    $databases = array();
                    while ($row = $result->fetch_row()) {
                        $dbName = $row[0];
                        // Filter out default databases
                        if ($dbName != "information_schema" && $dbName != "performance_schema" && $dbName != "sys" && $dbName != "mysql") {
                            $databases[] = $dbName;
                        }
                    }
                    $result->free_result();
                }
                echo "<b>" .count($databases) . " databases: </b>";
                echo "<ul>";
                foreach ($databases as $dbName) {
                    echo "<li>".$dbName."</li>";
                }
                echo "</ul>";
                ?>
                <?php
                function info($msg)
                {
                    echo '<div id="result-msg" class="alert alert-success" role="alert">' . $msg . '</div>';
                }

                if ($importDone) {
                    info("Databases geïmporteerd.");
                }
                if ($exportDone) {
                    info("Databases gëexporteerd.");
                }
                if ($restoreDone) {
                    info("Standaard databases hersteld.");
                }
                ?>
                <div id="loading" class="alert alert-info" style="display: none;" role="alert">
                    <div class="d-flex align-items-center">
                        <p id="loading-msg">Aan het laden..</p>
                        <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                    </div>
                </div>
                <form id="db-man-form" action="index.php" method="post">
                    <div class="vstack gap-2 me-5">
                        <button class="btn btn-primary" name="export" value="1">Exporteer databases</button>
                        <button class="btn btn-outline-primary" name="import" value="1">Importeer databases</button>
                        <button class="btn btn-outline-danger" name="restore_default" value="1">Herstel standaard</button>
                    </div>
                </form>
                <script>
                    document.getElementById("db-man-form").addEventListener('submit', () => {
                        document.getElementById("loading").style.display = "";
                        if (document.getElementById("result-msg") != null) {
                            document.getElementById("result-msg").style.display = "none";
                        }
                    });
                </script>
            </div>

        </div>
    </main>
    <div class="container mt-5">
        <footer class="d-flex flex-wrap align-items-center py-3 my-4 border-top">
            <?php
            echo '<span class="text-muted mx-5">PHP versie: ' . phpversion() . '</span>';
            echo '<span class="text-muted">MySQL versie: ' . $mysqli->server_version . '</span>';
            ?>
        </footer>
    </div>
</body>

</html>