<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Symfony\Component\ExpressionLanguage\SyntaxError;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\ExpressionLanguage\Parser;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$app->get('/names/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];

    $expressionLanguage = new ExpressionLanguage();

    class Apple
    {
        public int $variety;
    }

    $apple = new Apple();
    $apple->variety = 123;


    // $expressionLanguage->parse('1 + 2', [])->getNodes()->toArray()
    try {
        (new ExpressionLanguage())->lint(
            'fruit + 2',
            [
                'fruit', // no values needed
            ]
        );
    } catch (SyntaxError $exception) {
        $response->getBody()->write($exception->getMessage());
    }
    
    $response->getBody()->write(json_encode(
        $expressionLanguage->evaluate(
        'fruit.variety + 2',
        [
            'fruit' => $apple,
        ]
        )
    ));
    return $response;
});

$app->run();

?>

