<?php
class Database
{
    const HOST = "localhost",
          DBNAME = "phpgame",
          LOGIN = "root",
          PWD = '';

    public static function BDD()
    {
        try {
            $bdd = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::DBNAME . ';charset=utf8', self::LOGIN, self::PWD);
            return $bdd;
        } catch (Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
    }
}
