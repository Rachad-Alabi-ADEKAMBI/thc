<?php
include 'functions.php';
$action = $_GET['action'] ?? '';


if ($action == 'getOffer') {
    getOffer();
}

if ($action == 'orderForDay') {
    orderForDay();
}


if ($action == 'contact') {
    contact();
}

if ($action == 'getMyDatas') {
    getMyDatas();
}

if ($action == 'getMySubscription') {
    getMySubscription();
}

if ($action == 'getMyOrders') {
    getMyOrders();
}

if ($action == 'getMyNextOrders') {
    getMyNextOrders();
}

if ($action == 'getSalads') {
    getSalads();
}

if ($action == 'getMyCashback') {
    getMyCashback();
}

if ($action == 'payWithMobile') {
    payWithMobile();
}

if ($action == 'getMyAffiliated') {
    getMyAffiliated();
}

if ($action == 'login') {
    login();
}

if ($action == 'register') {
    register();
}

if ($action == 'updateAccount') {
    updateAccount();
}

if ($action == 'logout') {
    logout();
}