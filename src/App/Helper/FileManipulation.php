<?php
/**
 * Created by PhpStorm.
 * User: Dcide
 * Date: 26/07/2016
 * Time: 16:57
 */

namespace App\Helper;

use PhpParser\PrettyPrinter\Standard;

class FileManipulation {

    var $printer;

    public function __construct() {
        $this->printer = new Standard();
    }

    public function newClass($stmt ,$path){
       $code = $this->printer->prettyPrintFile($stmt);

       if(!file_put_contents($path, $code)){
           return false;
       }

       return true;
    }
}