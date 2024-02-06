<?php // <- Etiqueta php obligatoria 

/** HEADER - Cabezeras de protocolo CORS */
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');
/** DECLARAMOS LA VARIABLES A UTILIZAR DE MANERA GLOBAL */
$payload = true;
$response = [];

/** REQUEST - Recibir solicitudes JSON 
 * validamos que el metodo sea diferente de get para asignar los valores enviados 
 * por el dev frontend en la variable @var payload 
*/
if($_SERVER['REQUEST_METHOD'] != 'GET') $payload = json_decode(file_get_contents("php://input"));


if (!$payload) {
    $response = [
        "mensaje" => "No hay datos en el payload",
        "data" => $payload,
        "estatus" => 500
    ];
    http_response_code(500);
    echo json_encode($response);
    exit;
}

// CONEXION - Se configura la conexión a la DB
$pdo= null;
try{
    /**
    * @param mysql:host (aqui va la ip del servidor o localhost)
    * @param dbname (Aqui va el nombre de la base de datos)
    * @param User (Es el usuario autorizado para acceder a la DB)
    * @param Password (Horita permanece vacio ya que el usuario root no tiene clave)
    */
    $pdo = new PDO(
            'mysql:host=127.0.0.1;dbname=api_db2',
            'root', //User
            '' //Password
    );


    // SENTECIAS SQL - Aqui se ejecutan las peticiones y se retornan en formato JSON 
    /** 
     * Creamos un switch para detectar que tipo de metodo de envio es para 
     * realizar una accion espesifica.
     * los metodos a esperar son:
     * @method POST - CREAR UN RECURSO (PELICULA)
     * @method PUT - ACTUALIZAR UN RECURZO (PELICULA)
     * @method DELETE - ELIMINAR UN RECURSO
     * @method GET - CONSULTAR TODOS LOS RECURSOS (PELICULAS)
     */
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            $sql = 'SELECT * FROM peliculas';
            $sentencia = $pdo->prepare($sql);
            $sentencia->execute();
            $resultados = $sentencia->fetchAll();

            $response = [
                "mensaje" => "Consulta realizada correctamente.",
                "data" => $resultados ,
                "estatus" => 200
            ];;
            break;

        case 'POST':
           $sql = 'INSERT INTO peliculas (titulo, descripcion, precio) 
           VALUES(:titulo, :descripcion, :precio)';
            $sentencia = $pdo->prepare($sql);
            $result = $sentencia->execute([
                ':titulo' => $payload->titulo ?? '',
                ':descripcion' => $payload->descripcion ?? '',
                ':precio' => $payload->precio ?? ''
            ]);

            if($result) {
                /** obtenemos el ultimo registro */
                $sqlOne = "SELECT * FROM peliculas ORDER BY id DESC LIMIT 1";
                $sentenciaPelicula = $pdo->prepare($sqlOne);
                $sentenciaPelicula->execute();
                $pelicula = $sentenciaPelicula->fetch();

                $response = [
                    "mensaje" => "La pelicula se agrego correctamente.",
                    "data" => $pelicula ,
                    "estatus" => 201
                ];
                
            }else{
                $response = [
                    "mensaje" => "La pelicula NO se agrego, vuelve a intentar.",
                    "data" => $result ,
                    "estatus" => 404
                ];
            }
            break;
        case 'PUT':
            $sql = 'UPDATE peliculas  SET titulo = :titulo, descripcion=:descripcion, 
            precio = :precio WHERE id = :id';
            $sentencia = $pdo->prepare($sql);
            $result = $sentencia->execute([
                ':titulo' => $payload->titulo,
                ':descripcion' => $payload->descripcion,
                ':precio' => $payload->precio,
                ':id'     => $payload->id
            ]);
            
            if($result){
                 /** obtenemos el ultimo el recurso actualizado */
                 $sqlOne = "SELECT * FROM peliculas WHERE id=:id";
                 $sentenciaPelicula = $pdo->prepare($sqlOne);
                 $sentenciaPelicula->execute([":id"=>$payload->id]);
                 $pelicula = $sentenciaPelicula->fetch();
 
                 $response = [
                     "mensaje" => "La pelicula se actualizó correctamente.",
                     "data" => $pelicula ,
                     "estatus" => 200
                 ];
            }else{
                $response = [
                    "mensaje" => "La pelicula NO se actualizó, vuelve a intentar.",
                    "data" => $result ,
                    "estatus" => 404
                ];
            }
            break;
        case "DELETE":
            $sql = 'DELETE FROM peliculas WHERE id = :id';
            $sentencia = $pdo->prepare($sql);
            $result = $sentencia->execute([
                ':id' => $payload->id
            ]);

            if($result){
                $response = [
                    "mensaje" => "La pelicula se ELIMINO correctamente.",
                    "data" => [],
                    "estatus" => 200
                ];
            }else {
                $response = [
                    "mensaje" => "La pelicula No se elimino vuelve a intentar.",
                    "data" => [],
                    "estatus" => 404
                ];
            }

            break;
        
        default:

            $response = [
                "mensaje" => "El método recibido no es admitido por nuestra api, Los métodos HTTPS soportados son: GET - POST - PUT - DELETE.",
                "data" => [] ,
                "estatus" => 404
            ];
           
            break;
    }


    /** RETORNAMOS LA RESPUESTA JSON AL DESARROLLADOR FRONTEND */
    http_response_code($response['estatus']);
    echo json_encode($response);

}catch(PDOException $e){
    $response = [
            "mensaje" => $e->getMessage(),
            "data" => null,
            "estatus" => 500
        ];
}







?>