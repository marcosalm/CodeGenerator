<?php
/**
 * Created by PhpStorm.
 * User: Dcide
 * Date: 26/07/2016
 * Time: 16:57
 */

namespace App\Helper;


class PathGenerator {

    var $dir;
    public function __construct() {
        $this->dir = new DirectoryManipulation();
    }

    /**
     * @param $nameSpace
     * @param $archiSetup
     */
    public function generate($projectName, $nameSpaces, $archiSetup){

        $preConfig = file_get_contents($archiSetup['configPath']);
        $config = json_decode($preConfig);

        $defaultStructure = $this->dir->generate($config['folders'], $projectName);

        $namespace_path = $this->pathFromNamespace($nameSpaces, $config['psr4_root']);

        $nameSpaceStructure = $this->dir->generate($namespace_path, $projectName);

        $projectStructure =  array_merge($defaultStructure,$nameSpaceStructure);

        return $projectStructure;
    }

    public function pathFromNamespace($nameSpaces, $psr4_root){
        $folders = [];
        foreach ($nameSpaces as $nameSpace){
            $folders[] = [
                'location' => $psr4_root.">". $nameSpace
            ];
        }
        return $folders;
    }
}