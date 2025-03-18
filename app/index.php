<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

$app->get('/names/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];

    $expressionLanguage = new ExpressionLanguage();

    class Apple
    {
        public string $variety;
    }

    $apple = new Apple();
    $apple->variety = 'Honeycrisp';

    $response->getBody()->write(
        $expressionLanguage->evaluate(
            'fruit.variety',
            [
                'fruit' => $apple,
            ]
        )
    );
    return $response;
});

$app->run();

?>

