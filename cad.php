<?php
// Importa o autoload do Composer para carregar o mPDF
require_once __DIR__ . '/vendor/autoload.php';

use Mpdf\Mpdf;

// Pega os dados enviados via POST
$nome = $_POST['nome'] ?? 'Sem nome';
$sobrenome = $_POST['sobrenome'] ?? 'Desconhecido';

// Cria uma instância do mPDF
$mpdf = new Mpdf();

// Lê o CSS do seu arquivo externo
$css = file_get_contents(__DIR__ . '/style.css');
$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);

// Escreve o conteúdo HTML que será convertido em PDF
$html = '
    <header>
        <h1>Resultado do Processamento</h1>
    </header>
    <main>
        <p>Nome:  <br>' . htmlspecialchars($nome) . ' <br><br> Sobrenome: <br>  ' . htmlspecialchars($sobrenome) . '</p>
    </main>
';

// Adiciona o HTML ao corpo do PDF
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

// Exibe o PDF no navegador ("I" = inline)
$mpdf->Output("resultado-$nome.pdf", "I");