<?php
/**
 * Created by PhpStorm.
 * User: Dcide
 * Date: 27/07/2016
 * Time: 10:56
 */

namespace Generator\Service;

use PhpParser\BuilderFactory;
use PhpParser\Node;

class ClassGenerator extends BuilderFactory{

    public function classGenerate($protoClass){
        $node = $this->namespace($protoClass['name_space']);
        foreach ($protoClass['uses'] as $as => $useClass){
            $node->addStmt($this->use($useClass)->as($as));
        }

        $node->addStmt(
            $this->class($protoClass['class'])
                ->extend($protoClass['extends'])
                ->implement($protoClass['implement'])
                ->makeFinal()
        );

        foreach ($protoClass['methods'] as $method){
            $stmt = $this->method($method['name']);
            $type = "make". ucfirst($method['type']);// Public, Private, Protected
            $stmt->$type();
            $stmt->setReturnType($method['return_type']);
            foreach ($method['params'] as $param){
                $stmt->addParam($this->param($param['name'])->setTypeHint($param['hint']));
            }
            $stmt->setDocComment($method['doc']);
            foreach ($method['logics'] as $logic){
                $stmt->addStmt($logic);
            }
            $node->addStmt($stmt);
        }

        foreach ($protoClass['properties'] as $property){
            $type = "make". ucfirst($property['type']);// Public, Private, Protected
            $node->addStmt($this->property($property['name'])->$type());
        }

        return [ $node->getNode() ];

    }

}