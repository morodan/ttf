<?php

require_once 'BaseInterface.php';
require_once 'ManageMappingInterface.php';

class Base implements BaseInterface, ManageMappingInterface
{
    public $_a, $_b, $_c, $_d, $_e, $_f;
    public $_x;
    public $_y;
    public $x;

    function __construct($inputs = [FALSE, FALSE, FALSE, 0, 0, 0])
    {
        $this->_a = $inputs[0];
        $this->_b = $inputs[1];
        $this->_c = $inputs[2];
        $this->_d = $inputs[3];
        $this->_e = $inputs[4];
        $this->_f = $inputs[5];
        $this->_y = null;
        $this->_x = null;
        $this->x = ['s' => 'S', 'r' => 'R', 't' => 'T'];
    }

    public function verifyInput()
    {
        if ($this->_a && $this->_b && !$this->_c) {
            $this->_x = $this->x['s'];
        } elseif ($this->_a && $this->_b && $this->_c) {
            $this->_x = $this->x['r'];
        } elseif (!$this->_a && $this->_b && $this->_c) {
            $this->_x = $this->x['t'];
        } else {
            $this->error('boolean inputs are not valid!');
        }
    }

    public function generateResult()
    {
        switch ($this->_x) {
            case $this->x['s']:
                $this->_y = $this->_d + ($this->_d * $this->_e / 100);
                break;
            case $this->x['r']:
                $this->_y = $this->_d + ($this->_d * ($this->_e - $this->_f) / 100);
                break;
            case $this->x['t']:
                $this->_y = $this->_d - ($this->_d * $this->_f / 100);
                break;
        }
    }

    public function calculate()
    {
        $this->verifyInput();
        $this->generateResult();
        return $this->gotTheResult();
    }

    public function gotTheResult(){
        if ($this->_y !== null) {
            return ['success' => true, 'X' => $this->_x, 'Y' => $this->_y];
        } else {
            return $this->error('Y is invalid or null');
        }
    }

    public function error($msg){
        return ['error'=>true, 'msg'=>$msg];
    }

}