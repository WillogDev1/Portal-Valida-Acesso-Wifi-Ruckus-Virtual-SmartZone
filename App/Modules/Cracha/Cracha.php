<?php

namespace App\Modules\Cracha;

class Cracha
{
    public static function validaCracha()
    {
        // URL do arquivo CSV
        // Usar .env
        $url = 'URL_PUBLICA_DA_PLANILHA';

        // Usar file_get_contents para obter o conteúdo do CSV
        $csvData = file_get_contents($url);

        // Verificar se conseguiu obter o conteúdo
        if ($csvData === false) {
            die("Não foi possível acessar o conteúdo do CSV.");
        }

        // Converter o CSV em um array
        $lines = explode(PHP_EOL, $csvData);
        $validRAs = array();
        foreach ($lines as $line) {
            $data = str_getcsv($line);
            $validRAs[] = $data[1]; // Supondo que o RA esteja na primeira coluna
        }

        // Verificar se o RA foi enviado
        if (isset($_POST['cracha'])) {
            $ra = $_POST['cracha'];

            // Verificar se o RA enviado está na lista de RAs válidos
            if (in_array($ra, $validRAs)) {
                // RA válido, redirecionar para a página de login do WiFi
                header('Location: https://192.168.4.2:9998/SubscriberPortal/hotspotlogin?username=' . $ra);
                exit();
            } else {
                // RA inválido, mostrar mensagem de erro
                echo "<script>
                alert('Cracha Invalido ou não cadastrado, entre em contato com R.H');
                window.location = '/';
                </script>";
                exit();
            }
        }
    }
}
