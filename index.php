<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Exception\HttpNotFoundException;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->post('/register', function (Request $request, Response $response, $args){
    
    //$parsedBody = $request->getParsedBody();
    // if ($parsedBody !== null) {
    //     return $parsedBody;
    // }
    
var_dump($parsedBody);


    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }


    
    // prepare and bind
    $stmt = $conn->prepare("INSERT INTO register1 (reg_name, reg_image, reg_username, reg_password, reg_email, reg_description) VALUES (?, ?, ?, ?, ?, ? )");
    $stmt->bind_param("ssssss", $name, $image, $username, $password, $email, $desc);

    $post =  $request->getParsedBody();
    //echo  var_dump($request);
    // set parameters and execute
    $name = $post['firstName'];
    $image = "Doe";
    $username = "username";
    $password = "password";
    $email = "john@example.com";
    $desc = "desc";
    $stmt->execute();

    echo "New records created successfully";

    $stmt->close();
    $conn->close();

    return $response
            ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000/')
            ->withHeader("Access-Control-Allow-Credentials", "true")
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    
    
    
});

$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
    throw new HttpNotFoundException($request);
});

$app->run();