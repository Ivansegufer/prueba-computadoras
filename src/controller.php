<?php
require_once 'database.php';
require_once 'computadora.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $computadoras = Computadora::all();
  header('Content-Type: application/json');
  echo json_encode($computadoras);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $inputJSON = file_get_contents('php://input');
  $input = json_decode($inputJSON, true);

  $marca = $input['marca'];
  $modelo = $input['modelo'];
  $ram = $input['ram'];
  $procesador = $input['procesador'];
  $almacenamiento = $input['almacenamiento'];

  $computadora = new Computadora($marca, $modelo, $ram, $procesador, $almacenamiento);
  $computadora->save();

  http_response_code(200);
  echo "OK";
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  $id = $_GET['id'];
  
  $computadora = Computadora::find($id);
  $computadora->delete();

  http_response_code(200);
  echo "OK";
}
?>