<?php
    require_once __DIR__ . '/migration.php';


    $config = require_once __DIR__ . '/../config/database.php';
    $db = new mysqli($config['host'], $config['username'], $config['password'], $config['database']);
    

    $migration = new Migration($db);
    $migration->up();