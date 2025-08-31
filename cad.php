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
$p71 = $_POST['71'];
$p72 = $_POST['72'];
$p73 = $_POST['73'];
$p74 = $_POST['74'];
$p75 = $_POST['75'];
$p76 = $_POST['76'];
$p77 = $_POST['77'];
$p78 = $_POST['78'];


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
        <p>7.2 - HÁ CONEXÕES EXPOSTAS COM RISCO EMINENTE DE CHOQUE ELÉTRICO? <br>' . htmlspecialchars($p72) . ' </p>
        <p>7.3 - PAINEIS ELETRICOS ESTÁ IDENTIFICADO A TENSÃO DE ALNOSIMENTAÇÃO? <br>' . htmlspecialchars($p73) . ' </p>
        <p>7.4 - A TENSÃO MEDIDA NA ALIMENTAÇÃO ESTÁ CONFORME IDENTIFICAÇÃO DO PAINEL ELETRICO? <br>' . htmlspecialchars($p74) . ' </p>
        <p>7.5 - AS FERRAMENTAS E INSTRUMENTOS DE MEDIÇÃO A SEREM UTILIZADOS NA VALIDAÇÃO ESTÃO ADEQUEADAS A NR10? <br>' . htmlspecialchars($p75) . ' </p>
        <p>7.6 - 7.6 - A CÉLULA DE VALIDAÇÃO ESTA DEMARCADA E IDENTIFICADA OS RISCOS PARA QUE PESSOAS NAO AUTORIZADAS NÃO PERMANEÇAM NO LOCAL DA
VALIDAÇÃO? <br>' . htmlspecialchars($p76) . ' </p>
        <p>7.7 - HA ALGUM RISCO OU CONDIÇÃO INSEGURA IDENTIFICADO NO AMBIENTE DE VALIDAÇÃO? <br>' . htmlspecialchars($p77) . ' </p>
        <p>7.8 - Observações de Análise de Riscos do Ambiente de Validação. <br>' . nl2br(htmlspecialchars($p78)) . ' </p>
    </main>
';

// Adiciona o HTML ao corpo do PDF
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

// Exibe o PDF no navegador ("I" = inline)
$mpdf->Output("resultado-$pv.pdf", "I");
