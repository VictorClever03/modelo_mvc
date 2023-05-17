<?php

namespace App\Libraries;

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf
{
  private $dompdf;
  public function __construct()
  {
    /**
     * Set the Dompdf options
     */
    $options = new Options;
    $options->setChroot(__DIR__);
    $options->setIsRemoteEnabled(true);

    $this->dompdf = new Dompdf($options);
  }

  public function generate($html, $path)
  {
    /**
     * Set the paper size and orientation
     */
    $this->dompdf->setPaper("A4", "portrait");

    /**
     * Load the HTML and replace placeholders with values from the form
     */


    $this->dompdf->loadHtml($html);
    //$dompdf->loadHtmlFile("template.html");

    /**
     * Create the PDF and set attributes
     */
    $this->dompdf->render();

    $this->dompdf->addInfo("Title", "Factura da compra"); // "add_info" in earlier versions of Dompdf

    /**
     * Send the PDF to the browser
     */
    $this->dompdf->stream("invoice.pdf", ["Attachment" => 0]);

    /**
     * Save the PDF file locally
     */
    $output = $this->dompdf->output();
    file_put_contents($path, $output);
  }
}
