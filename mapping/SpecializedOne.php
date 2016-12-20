<?php

require_once 'SpecializedOneInterface.php';

class SpecializedOne extends Base implements SpecializedOneInterface, ManageMappingInterface
{
    function __construct(array $inputs)
    {
        parent::__construct($inputs);
    }

    public function generateResultOne()
    {
        $this->generateResult();
        if ($this->_x == $this->x['r']) {
            $this->_y = 2 * $this->_d + ($this->_d * $this->_e / 100);
        }
    }

    public function calculate()
    {
        $this->verifyInput();
        $this->generateResultOne();
        return $this->gotTheResult();
    }

}