<?php

require_once 'SpecializedTwoInterface.php';

class SpecializedTwo extends Base implements SpecializedTwoInterface, ManageMappingInterface
{
    function __construct(array $inputs)
    {
        parent::__construct($inputs);
    }

    public function verifyInputTwo()
    {
        if ($this->_a && $this->_b && !$this->_c) {
            $this->_x = $this->x['t'];
        } elseif ($this->_a && !$this->_b && $this->_c) {
            $this->_x = $this->x['s'];
        }
    }

    public function generateResultTwo()
    {
        $this->generateResult();
        if ($this->_x == $this->x['s']) {
            $this->_y = $this->_f + $this->_d + ($this->_d * $this->_e / 100);
        }
    }

    public function calculate()
    {
        $this->verifyInputTwo();
        $this->generateResultTwo();
        return $this->gotTheResult();
    }

}