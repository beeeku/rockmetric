<?php

/**
 * Created by PhpStorm.
 * User: bikash
 * Date: 8/9/2015
 * Time: 12:47 AM
 */
Class Trophy
{

    public $shape;
    public $dimensions = array();
    public $metal_type;
    public $metal_purity_percentage;
    public $coating_element;
    public $coating_thickness;
    public $volume;
    public $surfaceArea;
    public $json;
    public $data;


    public function __construct($shape, $metal_type, $metal_purity_percentage, $coating_element, $coating_thickness)
    {
        $this->setShape($shape);
        $this->setMetal($metal_type);
        $this->setMetalpurityPercentage($metal_purity_percentage);
        $this->setCoatingElement($coating_element);
        $this->setCoatingThickness($coating_thickness);
        $this->json =  file_get_contents('cost.json');
        $this->data = json_decode($this->json, TRUE);

    }

    public function setShape($shape)
    {
        $this->shape = $shape;
    }

    public function setMetal($metal_type)
    {
        $this->metal_type = $metal_type;

    }

    public function setMetalpurityPercentage($percentage)
    {
        $this->metal_purity_percentage = $percentage;
    }

    public function setCoatingElement($element)
    {
        $this->coating_element = $element;
    }

    public function setCoatingThickness($thickness)
    {
        $this->coating_thickness = $thickness;
    }

    public function putParam($param)
    {
        foreach ($param as $key => $pr) {
            $this->$key = $pr;

        }
    }

    public function getVolumeHandle()
    {
        $shape = $this->shape;
        return $shape . 'Volume';
    }

    public function getSuraceAreaHandle()
    {
        $shape = $this->shape;
        return $shape . 'SurfaceArea';
    }

    public function sphereVolume()
    {
        return (4 * 3.14 * pow($this->radius, 3)) / 3;
    }

    public function cost($volume, $surface)
    {
        $metal_cost = $this->getMetalCost();
        $coating_cost = $this->getCoatingCost();
        return $metal_cost * $volume * $this->metal_purity_percentage / 100 + $coating_cost * $surface * $this->coating_thickness;
    }

    public function getMetalCost()
    {

        if ($this->metal_type == 'aluminium') {
            return $this->data['metal']['aluminium'];
        } else if ($this->metal_type == "steel") {
            return $this->data['metal']['steel'];
        } else if ($this->metal_type == "copper") {
            return $this->data['metal']['copper'];
        } else {
            return 0;
        }

    }

    public function getCoatingCost()
    {

        if ($this->coating_element == 'gold') {
            return $this->data['coating']['gold'];
        } else if ($this->coating_element == "silver") {
            return $this->data['coating']['silver'];
        } else if ($this->coating_element == "bronze") {
            return $this->data['coating']['bronze'];
        } else {
            return 0;
        }
    }

    public function sphereSurfaceArea()
    {
        return 4 * 3.14 * pow($this->radius, 2);
    }

    public function cylinderVolume()
    {
        return 3.14 * pow($this->radius, 2) * $this->height;
    }

    public function cylinderSurfaceArea()
    {
        return 2 * 3.14 * $this->radius * ($this->radius + $this->height);
    }

    public function cubeVolume()
    {
        return $this->length * $this->width * $this->height;
    }

    public function cubeSurfaceArea()
    {
        return 6 * pow($this->length, 2);
    }

    public function cuboidVolume()
    {
        return $this->length * $this->width * $this->height;
    }

    public function cuboidSurfaceArea()
    {
        return 2 * ($this->length * $this->width + $this->width * $this->height + $this->height * $this->length);
    }
}