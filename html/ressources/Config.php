<?php
// notification
$notification = "";
// Parametre d'environnement de travail
require 'envi.php';
// Fonction
require 'function.php';
// Fichier de CLasse
require 'Objects.php';
// Protocole de connection à la base de données
require 'DataBaseConnection.php';
// Derniere Connection
define('LAST_VIEW', date("r"));
// date du jour
define('TODAY', date("Y-m-d"));
// Chemin des Logos
define('LOGOPATH', '../assets/images/logo.png');
// Récupération des données de session
require 'SessionData.php';
// <!-- verification de l'utilisateur -->
isset($_GET['verifyNow'])? include './userverification.php': '';
// Tous les formulaires
include './Form.php';