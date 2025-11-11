<?php
require_once './dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

try {
  if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    throw new Exception("Sem conteúdo para gerar relatório!");
  }

  $options = new Options();
  $options->setChroot(__DIR__);
  $dompdf = new Dompdf($options);

  ob_start();
  require_once("index.php");
  $html = ob_get_contents();
  ob_end_clean();

  $dompdf->setPaper("A4", "portrait");
  $dompdf->loadHtml($html);
  $dompdf->render();
  $dompdf->stream("documento.pdf");

  header("content-type: application/pdf");
  echo $dompdf->output();
} catch (Exception $e) {
  echo "Ocorreu um erro: " . $e->getMessage();
}
