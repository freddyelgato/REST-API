<?php

$host = "db";  // Cambiar de localhost a db
$usuario="root";
$password="";
$basededatos="api_rest";
$mysqli = new mysqli("db", "root", "rootpassword", "api_rest");

if ($mysqli->connect_error) {
    die("Conexión no establecida: " . $mysqli->connect_error);
}

header("Content-Type: application/json");

// Obtener el método de la solicitud
$metodo = $_SERVER['REQUEST_METHOD'];  // Corregir la clave a REQUEST_METHOD

$path= isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:'/';
$buscarId= explode('/',$path);
$id =($path!=='/')? end ($buscarId):null;

switch($metodo){
    // Select Usuarios
    case 'GET':
        consultaSelect($mysqli,$id);
        break;
    // Insert
    case 'POST':
        insertarDato($mysqli);
        break;
    // Update
    case 'PUT':
        actualizarDato($mysqli,$id);
        break;
    // Delete
    case 'DELETE':
        borrarDato($mysqli,$id);
        break;
    default:
        echo "Método no permitido";
        break;
}

function consultaSelect($mysqli,$id){
    $sql=($id===null)?"SELECT * FROM friends": "SELECT * FROM friends WHERE id=$id";
    $resultado= $mysqli->query($sql);

    if($resultado){
        $datos=array();
        while($fila=$resultado->fetch_assoc()){
            $datos[]=$fila;
        }
        echo json_encode($datos);
    }
}

function insertarDato($mysqli){
    $dato = json_decode(file_get_contents('php://input'),true);
    $nombre=$dato['nombre'];
    print_r($nombre);

    $sql="INSERT INTO friends(nombre) VALUES ('$nombre')";
    $resultado= $mysqli->query($sql);

    if($resultado){
        $dato['id']=$mysqli->insert_id; // Corregir la variable
        echo json_encode($dato);
    }else{
        echo json_encode(array('error'=> 'Error al crear el usuario'));
    }
}

function borrarDato($mysqli,$id){
    $sql="DELETE FROM friends WHERE id = $id";
    $resultado= $mysqli->query($sql);

    if($resultado){
        echo json_encode(array('mensaje'=>'Usuario ELIMINADO'));
    }else{
        echo json_encode(array('error'=> 'Error al borrar el usuario'));
    }
}

function actualizarDato($mysqli, $id) {
    $dato = json_decode(file_get_contents('php://input'), true);
    $nombre = $dato['nombre'];
    
    $sql = "UPDATE friends SET nombre = '$nombre' WHERE id = $id";
    $resultado = $mysqli->query($sql);

    if ($resultado) {
        echo json_encode(array('mensaje' => 'Usuario ACTUALIZADO', 'id' => $id, 'nombre' => $nombre));
    } else {
        echo json_encode(array('error' => 'Error al ACTUALIZAR DATO', 'id' => $id));
    }
}

?>
