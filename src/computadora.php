<?php
require_once 'database.php';

class Computadora {
  public $id;
  public $marca;
  public $modelo;
  public $ram;
  public $procesador;
  public $almacenamiento;

  public function __construct($marca, $modelo, $ram, $procesador, $almacenamiento) {
    $this->marca = $marca;
    $this->modelo = $modelo;
    $this->ram = $ram;
    $this->procesador = $procesador;
    $this->almacenamiento = $almacenamiento;
  }

  public static function all() {
    global $conn;
    $sql = "SELECT * FROM computadoras";
    $result = $conn->query($sql);
    $computadoras = [];
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $computadora = new Computadora($row["marca"], $row["modelo"], $row["ram"], $row["procesador"], $row["almacenamiento"]);
        $computadora->id = $row["id"];
        array_push($computadoras, $computadora);
      }
    }
    return $computadoras;
  }

  public static function find($id) {
    global $conn;
    $sql = "SELECT * FROM computadoras WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $computadora = new Computadora($row["marca"], $row["modelo"], $row["ram"], $row["procesador"], $row["almacenamiento"]);
      $computadora->id = $row["id"];
      return $computadora;
    } else {
      return null;
    }
  }

  public function save() {
    global $conn;
    if ($this->id) {
      $sql = "UPDATE computadoras SET marca='$this->marca', modelo='$this->modelo', ram='$this->ram', procesador='$this->procesador', almacenamiento='$this->almacenamiento' WHERE id=$this->id";
      if ($conn->query($sql) === TRUE) {
        return true;
      } else {
        return false;
      }
    } else {
      $sql = "INSERT INTO computadoras (marca, modelo, ram, procesador, almacenamiento) VALUES ('$this->marca', '$this->modelo', '$this->ram', '$this->procesador', '$this->almacenamiento')";
      if ($conn->query($sql) === TRUE) {
        $this->id = $conn->insert_id;
        return true;
      } else {
        return false;
      }
    }
  }

  public function delete() {
    global $conn;
    $sql = "DELETE FROM computadoras WHERE id=$this->id";
    if ($conn->query($sql) === TRUE) {
      return true;
    } else {
      return false;
    }
  }
}
?>