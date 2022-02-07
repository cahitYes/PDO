<?php

/**
 * Chargement des dépendances
 */
require_once "./config.php";
require_once "./model/thesectionManager.php";

/**
 * Connexion PDO
 */
try {
    $db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT . ';charset=' . DB_CHARSET, DB_LOGIN, DB_PWD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Code erreur : " . $e->getCode();
    echo "<br>Message d'erreur : " . $e->getMessage();
    exit("<h3>Site en maintenance</h3>");
}

/**
 * Routeur (index.php est l'unique contrôleur)
 */
$sections = thesectionSelectAll($db);
if (
    isset($_GET["update"]) ||
    isset($_GET["delete"]) ||
    isset($_GET["add"])
) {
    if (key($_GET) === "add" && isset($_POST["thesectiontitle"]) && isset($_POST["thesectiondesc"])) {
        $title = userEntryProtection($_POST["thesectiontitle"]);
        $desc = userEntryProtection($_POST["thesectiondesc"]);
        if (!empty($title) && strlen($title) <= 70 && !empty($desc && strlen($desc) <= 240)) {
            if (thesectionInsert($db, $title, $desc)) {
                header("Location: ./");
                exit();
            } else {
                $error = true;
            }
        } else {
            $error = true;
        }
    }
    if (key($_GET) === "update") {
        if (isset($_POST["thesectiontitle"]) && isset($_POST["thesectiondesc"]) && isset($_POST["idthesection"])) {
            $title = userEntryProtection($_POST["thesectiontitle"]);
            $desc = userEntryProtection($_POST["thesectiondesc"]);
            $id = (int)($_POST["idthesection"]);
            if (!empty($title) && strlen($title) <= 70 && !empty($desc && strlen($desc) <= 240) && $id == $_GET["update"]) {
                if (thesectionUpdate($db, $id, $title, $desc)) {
                    header("Location: ./");
                    die();
                } else {
                    $error = true;
                }
            } else {
                $error = true;
            }
        }

        if (ctype_digit($_GET["update"]) && $_GET["update"]) {
            $id = (int)$_GET["update"];
            $section = thesectionSelectOneById($db, $id);
            if (empty($section)) {
                include_once "./view/thesection404.php";
                die();
            }
        } else {
            include_once "./view/thesection404.php";
            die();
        }
    }
    if (key($_GET) === "delete") {
        if (isset($_GET["confirm"])) {
            $id = (int) $_GET["delete"];
            if (thesectionDelete($db, $id)) {
                header("Location: ./");
                die();
            } else {
                $error = true;
            }
        }

        if (ctype_digit($_GET["delete"]) && $_GET["delete"]) {
            $id = (int)$_GET["delete"];
            $section = thesectionSelectOneById($db, $id);
            if (empty($section)) {
                include_once "./view/thesection404.php";
                die();
            }
        } else {
            include_once "./view/thesection404.php";
            die();
        }
    }
    include_once "./view/thesection" . ucfirst(key($_GET)) . ".php";
} else {
    include_once "./view/thesectionHomePage.php";
}
