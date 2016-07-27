<?php
/**
 * Created by PhpStorm.
 * User: Dcide
 * Date: 26/07/2016
 * Time: 16:57
 */

namespace App\Helper;


class DirectoryManipulation {

    public function __construct() {
    }

    public function generate($folders, $projectName){
        $structure = [];
        foreach ($folders as $folder){
            $location = $folder['location'];
            $directory = $this->generatePaths($location, $projectName);
            if(!is_dir($directory)) {
                if (!mkdir($directory, 0775)) {
                    throw new \Exception("Permissão de criação de diretorio negado pelo servidor!");
                }
            }
            $structure[] = $directory;
        }
        return $structure;
    }

    private function generatePaths($location, $projectName){
        $actualLocation = str_replace("%MyProject%", $projectName, $location);

        $path = str_replace(">", "\\", $actualLocation);

        return OUTPUT_PATH. "\\".$path;
    }
}