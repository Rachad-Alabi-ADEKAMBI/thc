<?php
include 'functions.php';
$action = $_GET['action'] ?? '';


if ($action == 'subscribe') {
    subscribe();
}

if ($action == 'newSurvey') {
    newSurvey();
}

if ($action == 'newsletters') {
    newsletters();
}

if ($action == 'contact') {
    contact();
}

if ($action == 'surveys') {
    surveys();
}

if ($action == 'login') {
    login();
}

if ($action == 'register') {
    register();
}

if ($action == 'logout') {
    logout();
}
