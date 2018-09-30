<?php
/**
 * Created by PhpStorm.
 * User: support
 * Date: 16/08/18
 * Time: 11:21 ص
 */

namespace App\Redirection;


use Symfony\Component\Routing\RouterInterface;

class HtmlToWord

{
    private $template,$router;

    /**
     * HtmlToWord constructor.
     * @param $template
     */
    public function __construct($template,RouterInterface $router)
    {
        $this->template = $template;
        $this->router = $router;
    }


    public function generateword($template,$nom){

//        dump($template);die;
//        $html = file_get_contents('https://stackoverflow.com/');
//        dump($html);die;
        $tags = "<br>";
        $breaks = array("<br />","<br>","<br/>");
        $text = str_ireplace($breaks, "\r\n", $template);
        $text = iconv('UTF-8', 'ASCII//TRANSLIT',$text);
        $handle = fopen($nom.".doc", "w+");
        fwrite($handle, $text);
        fclose($handle);


    }

}