<?php

namespace App\Modules\Token;

class Token
{

    public static function criaTokenCelular()
    {
        $tamanhoToken = 4;
        $caracteres = "abcdefghijklmnopqrstuvwxyz0123456789";
        $stringAleatoria = "";

        for ($i = 0; $i < $tamanhoToken; $i++) {
            $stringAleatoria .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }

        return $stringAleatoria;
        //print($stringAleatoria);
    }

    public static function sendTokenCelular($token, $numeroCelular)
    {
        $API_KEY = 'SEUTOKEN_SMSDEV';
        // Aqui, você colocaria a lógica de envio do SMS.
        // Por exemplo: enviar $token para $numeroCelular.
        // Esta linha é apenas um placeholder para a lógica de envio real.
        echo "Enviando token '{$token}' para o número '{$numeroCelular}'.\n";
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.smsdev.com.br/v1/send?key=" . $API_KEY . "&type=9&number=" . $numeroCelular . "&msg=" . $token,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "ERROR";
        } else {
            echo $response;
        }
    }

    public static function validaTokenCelular()
    {
        // session_start(); // Assegura que a sessão está iniciada para acessar $_SESSION

        // Checa se o token foi enviado e se existe um token na sessão
        if (isset($_POST['token']) && isset($_SESSION['tokenCelular'])) {
            $tokenUsuario = $_POST['token'];
            $tokenSessao = $_SESSION['tokenCelular'];
            $celphone = $_SESSION['tel'];

            // Compara o token do usuário com o token armazenado na sessão
            if ($tokenUsuario === $tokenSessao) {
                // Tokens correspondem, libera acesso
                echo "Acesso liberado";
                // Aqui você pode redirecionar para a página desejada ou definir uma flag de acesso
                // Por exemplo: https://192.168.4.2:9998/SubscriberPortal/hotspotlogin?username=' + numeroTelefone
                $_SESSION['acessoLiberado'] = true;
                header('Location: https://192.168.4.2:9998/SubscriberPortal/hotspotlogin?username=' . $celphone); // Ajuste conforme necessário
                exit();
            } else {
                echo "<script>
                alert('Token Invalido, entre em contato com o atendimento');
                window.location = '/';
                </script>";
                exit();
            }
        } else {
            // Token não fornecido ou sessão sem token
            echo "Token não fornecido ou sessão expirada";
            // Tratar como quiser
        }
    }
}
