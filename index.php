<?php 

require __DIR__ . '/vendor/autoload.php';

require'Alunos.php';
require'AlunosDAO.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->addBodyParsingMiddleware(); 
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);


$app->get('/Alunos', function (Request $request, Response $response, array $args) {
    $alunosDao = new AlunosDao();
    $alunos = $alunosDao->VerTodosAlunos();
    $response->getBody()->write(json_encode($alunos));
    return $response->withHeader('Content-type', 'application/json');
});

$app->post('/Alunos', function (Request $request, Response $response, array $args) {
    $data = $request->getParsedBody();
    $alunos = new Alunos($data['nome'], $data['avp1'], $data['avp2']);
    $alunos->calcularMedia();
    $alunosdao = new AlunosDao();
    $alunosdao->create($alunos);
    return $response->withStatus(201);
});

$app->put('/Alunos/{id}', function (Request $request, Response $response, array $args) {

    $id = $args['id'];
    $data = $request->getParsedBody();
    $alunos = new Alunos($data['nome'], ['avp1'], ['avp2']);
    $alunos->setid($id);
    $alunosdao = new AlunosDao();
    $alunosdao->update($alunos);
    return  $response->withStatus(200);
});

$app->delete('/Alunos/{id}', function (Request $request, Response $response, array $args) {

    $id = $args['id'];
    $alunosdao= new AlunosDao();
    $alunosdao->delete($id);
    return  $response->withStatus(200);
});


$app->get('/Alunos/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $alunosdao = new AlunosDao();
    $aluno = $alunosdao->read($id); 
    $response->getBody()->write(json_encode($aluno));
    return $response->withHeader('Content-type', 'application/json');
});


$app->run();



?>