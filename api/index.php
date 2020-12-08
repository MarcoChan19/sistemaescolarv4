<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Illuminate\Database\Capsule\Manager as DB;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/database.php';

// Instantiate app
$app = AppFactory::create();
$app->setBasePath('/sistemaescolar/api');

// Add Error Handling Middleware
$app->addErrorMiddleware(true, false, false);

// Add route callbacks
$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write('Hello World');
    return $response;
});

$app->post('/login/{usuario}', function (Request $request, Response $response, array $args) {
    $data= json_decode($request->getBody()->getContents(), false);
    $user = DB::table('login')
    ->where('usuario', $args['usuario'])
    ->first();

    $msg = new stdClass();
    if ($user->contraseña == $data->contraseña){
        $msg->aceptado = true;
        if($data->contraseña == 'usuario'){
            $msg->usuarios= true;
        }
    }
    else{
        $msg->aceptado = false;
    }

    $response->getBody()->write(json_encode($msg));
    return $response;
});


$app->post('/ins', function (Request $request, Response $response, array $args) {
    $data= json_decode($request->getBody()->getContents(), false);
    DB::table('calificaciones')
    ->insert(['calificacion' => $data->calificacion]);

    $calificacioness= new stdClass();

    if ($data->calificacion == "1"||"2"||"3"||"4"||"5"||"6"||"7"||"8"||"9"||"10")
    {
        $calificacioness->calif = true;
    }
    else{
        $calificacioness->calif = false;
    }

    $response->getBody()->write(json_encode($calificacioness));
    return $response;
});

// Run application
$app->run();
