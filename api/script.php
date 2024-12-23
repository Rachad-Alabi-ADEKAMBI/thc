<?php
include 'functions.php';
$action = $_GET['action'] ?? '';


if ($action == 'subscribe') {
    subscribe();
}

if ($action == 'getOffer') {
    getOffer();
}

if (isset($_GET['action']) && $_GET['action'] === 'orderForDay') {
    if (isset($_POST['dayOfWeek'])) {
        $dayOfWeek = strtolower($_POST['dayOfWeek']); // Get the day from POST
        $validDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday']; // Allowed days

        if (in_array($dayOfWeek, $validDays)) {
            orderForDay($dayOfWeek); // Call the function with the valid day
        } else {
            sendJSON(['error' => 'Invalid day provided.']);
        }
    } else {
        sendJSON(['error' => 'No day provided.']);
    }
} else {
    sendJSON(['error' => 'Invalid action.']);
}




if ($action == 'newsletters') {
    newsletters();
}

if ($action == 'contact') {
    contact();
}

if ($action == 'getMyDatas') {
    getMyDatas();
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

if ($action == 'logout') {
    logout();
}