<?php
class Conexion
{
  private $server;
  private $user;
  private $pass;
  private $data_base;
  private $conexion;
  private $flag;
  private $error_conexion;

  function __construct()
  {
    $this->server = "mysql:host=localhost;dbname=base4";
    $this->user = "root";
    $this->pass = "";
    $this->data_base = "base4";
    $this->conexion = null;
    $this->flag = false;
    $this->error_conexion = "Error en la conexion a MYSQL";
  }
  function __destruct()
  {
    $this->server = "";
    $this->user = "";
    $this->pass = "";
    $this->data_base = "";
    $this->conexion = null;
    $this->flag = false;
    $this->error_conexion = "";
  }
  public function Conexion()
  {
    try {
      $this->conexion = new PDO($this->server, $this->user, $this->pass);
      $this->flag = true;
    } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
    }
    return $this->conexion;
  }
  function close()
  {
    $this->conexion = null;
  }

  function generarMatricula()
  {
    $matricula = mt_rand(100000000, 999999999);
    return $matricula;
  }
  function create($nombre, $apellido, $edad, $direccion)
  {
    $matricula = $this->generarMatricula();
    try {
      $this->conexion->query("INSERT INTO aspirantes (id, nombre, apellido,edad,direccion ) VALUES ('$matricula', '$nombre', '$apellido', '$edad', '$direccion')");
    } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
    }
  }
  function read($Id)
  {
    try {
      $statement = $this->conexion->prepare("SELECT Id,nombre,apellido,edad,direccion FROM aspirantes WHERE Id = ?");
      $statement->execute([$Id]);
      $result = $statement->fetch(PDO::FETCH_ASSOC);
      return $result;
    } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
    }
  }
  function delete($SKU)
  {
    try {
      $statement = $this->conexion->prepare("DELETE FROM aspirantes WHERE Id = ?");
      $statement->execute([$SKU]);
      if ($statement->rowCount() == 0) {
        throw new Exception("El registro con el ID $SKU no existe en la base de datos.");
      }

      echo "El registro con el ID $SKU se ha eliminado correctamente.";
    } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  function update($direccion, $Id)
  {
    try {
      $statement = $this->conexion->prepare("UPDATE aspirantes SET direccion = ? WHERE Id = ?");
      $statement->execute([$direccion, $Id]);
    } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
    }
  }
}
