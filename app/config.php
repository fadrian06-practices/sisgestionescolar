<?php

const DB_SERVER = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'sisgestionescolar';

const APP_NAME = 'Sistema de Gestión Escolar';
const APP_URL = 'http://localhost/proyectos/sisgestionescolar';
const KEY_API_MAPS = '';

$dsn = 'mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME . ';charset=utf8';

try {
  $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
} catch (PDOException $exception) {
  header('Content-type: text/plain');
  exit($exception);
}

date_default_timezone_set('America/Caracas');

$currentDatetime = date('Y-m-d H:i:s');
$currentDate = date('Y-m-d');
$currentMonth = date('m');
$currentYear = date('Y');
$currentDay = date('d');

session_start();
