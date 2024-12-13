<?php

function getConnexion()
{
    try {
        return new PDO(
            'mysql:host=localhost;dbname=thc;charset=UTF8',
            'root',
            ''
        );
    } catch (PDOException $e) {
        // Handle database connection error
        die("Connection failed: " . $e->getMessage());
    }
}