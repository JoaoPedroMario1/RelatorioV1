<?php
// Importa o autoload do Composer para carregar o mPDF
require_once __DIR__ . '/vendor/autoload.php';

use Mpdf\Mpdf;

// Pega os dados enviados via POST
$cliente = $_POST['cliente'];
$pv = $_POST['pv'];
$equipamento = $_POST['equipamento'];
$gestor = $_POST['gestor'];
$email = $_POST['email'];
$nserie = $_POST['nserie'];
$p71 = $_POST['7.1'];



// Cria uma instância do mPDF
$mpdf = new Mpdf();

// Lê o CSS
$css = file_get_contents(__DIR__ . '/style.css');
$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);

// Escreve o conteúdo HTML que será convertido em PDF
// o nl2br é para o text area ficar formatado certo
$html = '
    <header>
        <h1>Resultado do Processamento</h1>
    </header>
    <main>
        <p>1 - CLIENTE:  <br>' . htmlspecialchars($cliente) . ' </p>
        <p>2 - PV - VERSÃO: <br>  ' . htmlspecialchars($pv) . '</p>
        <p>3 - EQUIPAMENTO: <br>' . htmlspecialchars($equipamento) . ' </p>
        <p>4 - GESTOR: <br>' . htmlspecialchars($gestor) . ' </p>
        <p>5 - E-MAIL DO GESTOR: <br>' . htmlspecialchars($email) . ' </p>
        <p>6 - NUMEROS DE SERIE: <br>' . nl2br(htmlspecialchars($nserie)) . ' </p>
        <h2>7. ANÁLISE DE RISCO DO AMBIENTE DE VALIDAÇÃO</h2><br><br>
        <p>7.1 - OS CABOS ELETRICOS DA CELULA ESTÃO PROTEGIDOS E EM BOAS CONDIÇÕES? <br>' . htmlspecialchars($p71) . ' </p>
    </main>
';

// Adiciona o HTML ao corpo do PDF
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

// Exibe o PDF no navegador ("I" = inline)
$mpdf->Output("resultado-$pv.pdf", "I");
