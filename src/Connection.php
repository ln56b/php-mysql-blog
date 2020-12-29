<?php

namespace App;
use \PDO;

class Connection
{

    public static function getPDO(string $db, string $user, string $password): PDO
    {
        return new PDO('mysql:dbname=' . $db . ';host=127.0.0.1', $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
}