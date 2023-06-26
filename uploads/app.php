<?php
    require "../vendor/autoload.php"; //se trae el autoload desde el vendor creado por composer
    $router = new \Bramus\Router\Router();
    $dotenv = Dotenv\Dotenv::createImmutable("../")->load();
    
    $router->get("/camper", function(){
        $cox = new \App\connect();
        $res = $cox->con->prepare("SELECT * FROM tb_camper");
        $res -> execute();
        $res = $res->fetchAll(\PDO::FETCH_ASSOC);
        echo json_encode($res);
    });

    $router->put("/camper", function(){
        $_DATA = json_decode(file_get_contents("php://input"), true);
        $cox = new \App\connect();
        $res = $cox->con->prepare("UPDATE tb_camper SET nombre = :NOMBRE WHERE id =:CEDULA");
        $res-> bindValue("NOMBRE", $_DATA['nom']); //para editar se debe escribir la sentencia dentro del $_DATA["nom"] es decir { nom: Wilfer, id: 1}
        $res-> bindValue("CEDULA", $_DATA['id']);
        $res -> execute();
        $res = $res->rowCount();
        echo json_encode($res);
    });

    $router -> delete("/camper", function(){
        $_DATA = json_decode(file_get_contents("php://input"), true);
        $cox = new \App\connect();
        $res = $cox->con->prepare("DELETE FROM tb_camper WHERE id =:CEDULA");
        $res->bindValue("CEDULA", $_DATA["id"]);
        $res->execute();
        $res = $res->rowCount();
        echo json_encode($res);
    });

    $router->post("/camper", function(){
        $_DATA = json_decode(file_get_contents("php://input"), true);
        $cox = new \App\connect();
        $res = $cox->con->prepare("INSERT INTO tb_camper (nombre, edad) VALUES (:NOMBRE, :EDAD)");
        $res-> bindValue("NOMBRE", $_DATA['nombre']); //para editar se debe escribir la sentencia dentro del $_DATA["nom"] es decir { nom: Wilfer, id: 1}
        $res-> bindValue("EDAD", $_DATA['edad']);
        $res -> execute();
        $res = $res->rowCount();
        echo json_encode($res);
    });


    //----tabla 2 --------------------
    $router->get("/tabla1", function(){
        $cox = new \App\connect();
        $res = $cox->con->prepare("SELECT * FROM academic_area");
        $res -> execute();
        $res = $res->fetchAll(\PDO::FETCH_ASSOC);
        echo json_encode($res);
    });

    $router->put("/tabla1", function(){
        $_DATA = json_decode(file_get_contents("php://input"), true);
        $cox = new \App\connect();
        $res = $cox->con->prepare("UPDATE academic_area SET  id_area =:ID_AREA, id_staff =:ID_STAFF, id_position =:ID_POSITION, id_journey =:ID_JOURNEY WHERE id =:id");
        $res->bindValue("ID_AREA", $_DATA['id_area']); 
        $res->bindValue("ID_STAFF", $_DATA['id_staff']); 
        $res->bindValue("ID_POSITION", $_DATA['id_position']); 
        $res->bindValue("ID_JOURNEY", $_DATA['id_journey']); 
        $res->bindValue("id", $_DATA['id']);
        $res->execute();
        $res = $res->rowCount();
        echo json_encode($res);
    });
    

    $router -> delete("/tabla1", function(){
        $_DATA = json_decode(file_get_contents("php://input"), true);
        $cox = new \App\connect();
        $res = $cox->con->prepare("DELETE FROM academic_area WHERE id =:CEDULA");
        $res->bindValue("CEDULA", $_DATA["id"]);
        $res->execute();
        $res = $res->rowCount();
        echo json_encode($res);
    });

    $router->post("/tabla1", function(){
        $_DATA = json_decode(file_get_contents("php://input"), true);
        $cox = new \App\connect();
        $res = $cox->con->prepare("INSERT INTO academic_area (id, id_area, id_staff, id_position, id_journey) VALUES (:CEDULA, :ID_AREA, :ID_STAFF, :ID_POSITION, :ID_JOURNEY)");
        $res-> bindValue("CEDULA", $_DATA['id']);
        $res-> bindValue("ID_AREA", $_DATA['id_area']); 
        $res-> bindValue("ID_STAFF", $_DATA['id_staff']); 
        $res-> bindValue("ID_POSITION", $_DATA['id_position']); 
        $res-> bindValue("ID_JOURNEY", $_DATA['id_journey']); 
        $res -> execute();
        $res = $res->rowCount();
        echo json_encode($res);
    });

    $router->run();
  
?>