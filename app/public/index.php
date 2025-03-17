<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/names/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];

    $names = array("Peter", "Paul", "Mary");
    array_push($names, $name);

    sort($names);

    $response->getBody()->write("Hello, " . json_encode($names));
    return $response;
});

$app->run();

?>

