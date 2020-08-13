<?php
use setasign\Fpdi\Fpdi;

require('fpdf/fpdf.php');
require_once('fpdi/src/autoload.php');

$files = ['teste1.pdf', 'teste2.pdf', 'teste3.pdf'];

$pdf = new FPDI();

// iterate over array of files and merge
foreach ($files as $file) {
    $pageCount = $pdf->setSourceFile($file);
    for ($i = 0; $i < $pageCount; $i++) {
        $tpl = $pdf->importPage($i + 1, '/MediaBox');

		$templateId = $pdf->importPage($i+1);
        $size = $pdf->getTemplateSize($templateId);
        
        //VARIAVEL QUE DEFINE O TAMANHO DO COMPRIMENTO DA PAGINA
        $height = ($size['height']/2); //ex de utilização para substituição: 100
        
        $pdf->addPage('L', array($size['width'], $height));

        $pdf->useTemplate($tpl);
    }
}

// output the pdf as a file (http://www.fpdf.org/en/doc/output.htm)
$pdf->Output('F','merged.pdf');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Combinar PDFs</title>
</head>
<body>
	<p>Os PDFs que serão agrupados são o teste1.pdf, teste2.pdf e teste3.pdf que são passados para o array $files, eles são agrupados em um único arquivo PDF chamado merged.pdf</p>
</body>
</html>