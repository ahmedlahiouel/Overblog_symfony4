<?php
/**
 * Created by PhpStorm.
 * User: support
 * Date: 10/08/18
 * Time: 10:37 م
 */

namespace App\Redirection;
use Spipu\Html2Pdf\Html2Pdf;

class Html
{
    private $pdf;

    public function create($orientation =null,$format=null,$long=null,$unicode=null,$encoding=null,$margin=null){

        $this->pdf=new Html2Pdf(
        $orientation ? $orientation : $this->$orientation,
        $format ? $format :$this->$format,
        $long ? $long :$this->$long,
        $unicode ? $unicode :$this->$unicode,
        $encoding ? $encoding :$this->$encoding,
        $margin ? $margin :$this->$margin



        );}

        public function generatepdf($template,$name){

        $this->pdf->writeHTML($template);
        return $this->pdf->Output($name.'.pdf');

        }

}