<?php
require_once "const_MYSQL.php";
class Connection
{

  private $driver = DRIVER;
  private $host = HOST;
  private $user = USER;
  private $password = PASSWORD;
  private $dbName = DB;
  private $dbPort = PORT;
  private $charset = "utf8";
  protected function connect()
  {
    try {
      $pdo = new PDO("{$this->driver}:host={$this->host};port={$this->dbPort};dbname={$this->dbName};charset={$this->charset}", $this->user, $this->password);
     
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    } catch (\PDOException $e) {
       //echo $e->getMessage();
       echo "No se pudo realizar la conexión, revisa o crea el fichero const_MYSQL.php";
       exit;
    }
  }
}