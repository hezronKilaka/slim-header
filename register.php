<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/get_serviceT', function(Request $request, Response $response, array $args){
    try{
    
        $db = new Database();
        $conn = $db->connect();

        $str = "SELECT * FROM tbl_service_type";

        $stmnt = $conn->prepare($str);
        $stmnt->execute();

        if ($stmnt->rowCount() > 0 ){
            $data = $stmnt->fetchAll(PDO::FETCH_OBJ);
            $result = array("code"=>200, "status"=>"Data found", "data"=>$data);
        }else{
            $result = array("code"=>404, "status"=>"page not found");
        }
        return $response->withJson($result);
    }catch(PDOException $e){
        $exception = array("code"=>500, "status"=>$e->getMessage());
        return $response->withJson($exception);
    }

    $conn = null;
});

$app->get('/get_serviceT2', function(Request $request, Response $response, array $args){
    try{
    
        $db = new Database();
        $conn = $db->connect();

        $str = "SELECT * FROM  tbl_facility";

        $stmnt = $conn->prepare($str);
        $stmnt->execute();

        if ($stmnt->rowCount() > 0 ){
            $data = $stmnt->fetchAll(PDO::FETCH_OBJ);
            $result = array("code"=>200, "status"=>"Data found", "data"=>$data);
        }else{
            $result = array("code"=>404, "status"=>"page not found");
        }
        return $response->withJson($result);
    }catch(PDOException $e){
        $exception = array("code"=>500, "status"=>$e->getMessage());
        return $response->withJson($exception);
    }

    $conn = null;
});


$app->post('/sendData',function (Request $request, Response $response){
    $data = json_decode($request->getBody());
    
    try{
        $db = new Database();
        $conn = $db->connect();

        $str = "INSERT INTO tbl_service( serviceName, service_typeID, facilityID) VALUES(:serviceName, :service_typeID, :facilityID)";
        $stmt = $conn->prepare($str);
        $stmt->bindParam(":serviceName",$data->Fname);
        $stmt->bindParam(":service_typeID",$data->servrtype);
        $stmt->bindParam(":facilityID",$data->servename);

        if($stmt->execute()){
            $result = array("code"=>200, "status"=>"success");
        }else{
            $result = array("code"=>404, "status"=>"Not Found");
        }
        return $response->withJson($result);
    }catch(PDOException $err){
        $exception = array("code"=>500, "status"=>$err.getMessage());
        return $response->withJson($exception);
    }
    $conn = null;
});
 

$app->get('/getserve', function (Request $request, Response $response, array $args) {
    try{
        $db = new Database();
        $conn = $db->connect();

        $str = " SELECT * FROM tbl_service  ";
        $stmt = $conn->prepare($str);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $result = array("code"=>200, "status"=>"success","data"=>$data);
        }else{
            $result = array("code"=>404, "status"=>"Not Found");
        }
        return $response->withJson($result);
    }catch(PDOException $err){
        $exception = array("code"=>500, "status"=>$err.getMessage());
        return $response->withJson($exception);
    }
    $conn = null;
});

$app->delete('/delete_data/{serviceID}', function (Request $request, Response $response, array $args) {
    $serviceID = $request->getAttribute('serviceID');
    try{
        $db = new Database();
        $conn = $db->connect();

        $str = "DELETE FROM tbl_service WHERE serviceID={$serviceID}";
        $stmt = $conn->prepare($str);
        if($stmt->execute()){
            $result = array("code"=>200, "status"=>"success");
        }else{
            $result = array("code"=>404, "status"=>"Not deleted");
        }
        return $response->withJson($result);
    }catch(PDOException $err){
        $exception = array("code"=>500, "status"=>$err.getMessage());
        return $response->withJson($exception);
    }
    $conn = null;
});

