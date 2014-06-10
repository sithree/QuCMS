<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace siasoft\qucms\web;

/**
 * Description of FileReflector
 *
 * @author SW-PC1
 */
class FileReflector
{
    private $_onlyHeader;
    public $fileName;
    public $className;
    public $baseClass;

    private function getNamespace($tokens)
    {
        $result = '';
        while ($token = each($tokens)) {
            if ($token === ';') {
                return $result;
            }
            if (is_array($token)) {
                list($index, $value) = $token;
                if ($index === T_STRING || $index === T_NS_SEPARATOR) {
                    $result .=$value;
                }
            }
        }
    }

    private function getUse($tokens)
    {
        $result = [];
        $buffer = '';
        while ($token = each($tokens)) {
            if ($token === ';') {
                if (!isset($result['namespace'])) {
                    $result = [
                        'namespace' => $buffer,
                        'aliace' => array_pop(split('\\', $buffer))
                    ];
                } else {
                    $result['aliace'] = $buffer;
                }
                return $result;
            }
            if (is_array($token)) {
                list($index, $value) = $token;
                if ($index === T_STRING || $index === T_NS_SEPARATOR) {
                    $buffer .= $value;
                }
                if ($index === T_AS) {
                    $result['namespace'] = $buffer;
                    $buffer = '';
                }
            }
        }
    }

    public function __construct($fileName, $onlyHeader = true)
    {
        $this->fileName = $fileName;
        $this->_onlyHeader = $onlyHeader;

        $tokens = token_get_all(file_get_contents($fileName));
        $namespace = '';
        $using = [];
        while ($token = each($tokens)) {
            if (is_array($token)) {
                switch ($token[0]) {
                    case T_NAMESPACE :
                        $namespace = $this->getNamespace($tokens);
                        break;
                    case T_USE :
                        $using[] = $this->getUse($tokens);
                        break;
                    case T_CLASS :
                        return;
                }
            }
        }
        $this->className = $namespace;
        $this->baseClass = $using;
    }

}
