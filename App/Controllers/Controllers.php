<?php

namespace App\Controllers;

// Chama Controlador da Sessão do Usuário
use App\Session\SessionManager;
// Chama Modulo do Token
use App\Modules\Token\Token;
// Chama Modulo de validação do RA
use App\Modules\Ra\Ra;
// Chama Modulo de validação do Cracha
use App\Modules\Cracha\Cracha;


class Controllers
{
    public function home()
    {
        // Inicia a sessão
        SessionManager::startSession();

        include __DIR__ . '/../Views/Home/home.php';
    }

    public function alunos()
    {
        // Inicia a sessão
        SessionManager::startSession();

        include __DIR__ . '/../Views/Aluno/aluno.php';
    }

    public function visiatnte()
    {
        // Inicia a sessão
        SessionManager::startSession();

        // Gera Token Ao acessar a pagina
        $token = Token::criaTokenCelular();

        // Armazena token na SESSION para usar no servidor
        $_SESSION['tokenCelular'] = $token;
        // print($_SESSION['tokenCelular']);
        include __DIR__ . '/../Views/Visitante/visitante.php';
    }

    public function colaborador()
    {
        // Inicia a sessão
        SessionManager::startSession();

        include __DIR__ . '/../Views/Colaborador/colaborador.php';
    }

    public function validaCracha()
    {
        // Inicia a sessão
        SessionManager::startSession();
        //
        Cracha::validaCracha();
    }


    public function validaRA()
    {
        // Inicia a sessão
        SessionManager::startSession();
        //
        Ra::validaRA();

    }

    public function sendSms()
    {
        // Inicia a sessão
        SessionManager::startSession();

        // Verifica se o número do celular foi postado e se o token existe na sessão
        if (isset($_SESSION['tokenCelular']) && isset($_POST['numeroCelular'])) {
            $token = $_SESSION['tokenCelular'];
            $_SESSION['tel'] = $_POST['numeroCelular'];
            $numeroCelular = $_POST['numeroCelular'];
            $celNumberApenasNumero = preg_replace("/[^\d]+/", "", $numeroCelular);

            // Chamada para enviar o token armazenado na sessão para o número de celular fornecido
            Token::sendTokenCelular($token, $celNumberApenasNumero);

            // Após o envio, você pode optar por invalidar o token na sessão para evitar reenvios
            // unset($_SESSION['tokenCelular']);
            // Redireciona o usuário ou informa que o token foi enviado
            // Você pode querer incluir uma mensagem de sucesso na sessão para mostrar na view
            $_SESSION['mensagem'] = 'Token enviado com sucesso.';
            print($_SESSION['mensagem']);
        } else {
            // Trate o caso em que os dados necessários não foram postados ou o token não está na sessão
            // Por exemplo, redirecione de volta ao formulário com uma mensagem de erro
            $_SESSION['mensagem'] = 'Erro ao enviar o token.';
            print($_SESSION['mensagem']);
        }

        // Redirecione de volta à página anterior ou a uma página de sucesso/erro
        exit;
    }

    public function validaToken()
    {
        // Inicia a sessão
        SessionManager::startSession();

        Token::validaTokenCelular();


    }
}
