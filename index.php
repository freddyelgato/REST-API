<?php

$host="localhost";
$usuario="root";
$password="";
$basededatos="api_rest";



$conexion= new mysqli($host,$usuario,$password,$basededatos);

if($conexion->connect_error){
    die("Conexión no establecida".$conexion->connect_error);

}


header("Content-Type: application/json");

// Obtener el método de la solicitud
$metodo = $_SERVER['REQUEST_METHOD'];  // Corregir la clave a REQUEST_METHOD

$path= isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:'/';

$buscarId= explode('/',$path);

$id =($path!=='/')? end ($buscarId):null;
switch($metodo){
    //Select Usuarios
    case 'GET':
        consultaSelect($conexion,$id);
        break;
    //Insert
    case 'POST':
        insertarDato($conexion);
        break;
    //Update
    case 'PUT':
        actualizarDato($conexion,$id);
        break;
    //Delete
    case 'DELETE':
        borrarDato($conexion,$id);
        break;
    default:
        echo "Método no permitido";
        break;
    
}

function consultaSelect($conexion,$id){
    $sql=($id===null)?"SELECT * FROM friends": "SELECT * FROM friends WHERE id=$id";
    $resultado= $conexion->query($sql);

    if($resultado){
        $datos=array();
        while($fila=$resultado->fetch_assoc()){
            $datos[]=$fila;
        }
        echo json_encode($datos);
    }
}

function insertarDato($conexion){
    $dato = json_decode(file_get_contents('php://input'),true);
    $nombre=$dato['nombre'];
    print_r($nombre);

    $sql="INSERT INTO friends(nombre) VALUES ('$nombre')";
    $resultado= $conexion->query($sql);

    if($resultado){
        $dato['id']=$conexion->insert_id;
        echo json_encode($dato);
    }else{
        echo json_encode(array('error'=> 'Error al crear el usuario'));
    }

}

function borrarDato($conexion,$id){

    
    $sql="DELETE FROM friends WHERE id = $id";
    $resultado= $conexion->query($sql);

    if($resultado){
        echo json_encode(array('mensaje'=>'Usuario ELIMINADO'));
    }else{
        echo json_encode(array('error'=> 'Error al borrar a el usuario'));
    }

}

function actualizarDato($conexion, $id) {
    $dato = json_decode(file_get_contents('php://input'), true);
    $nombre = $dato['nombre'];
    
    $sql = "UPDATE friends SET nombre = '$nombre' WHERE id = $id";
    $resultado = $conexion->query($sql);

    if ($resultado) {
        echo json_encode(array('mensaje' => 'Usuario ACTUALIZADO', 'id' => $id, 'nombre' => $nombre));
    } else {
        echo json_encode(array('error' => 'Error al ACTUALIZAR DATO', 'id' => $id));
    }
    
}


?>