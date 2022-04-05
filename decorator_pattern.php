<?php

interface CarService {
    public function getCost();
    public function getDescription();
}

class BasicInspection implements CarService {
    
    public function getCost() {
        return 25;
    }

    public function getDescription(){
       return 'Basic description';
    }
}

class OilChange implements CarService {

    protected $carService;

    function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }
    
    public function getCost() {
        return 60 + $this->carService->getCost();
    }

    public function getDescription(){
        return $this->carService->getDescription().'and oil change';
     }
}

class TireChange implements CarService {

    protected $carService;

    function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }
    
    public function getCost() {
        return 30 + $this->carService->getCost();
    }

    public function getDescription(){
        return $this->carService->getDescription().'and tire change';
     }
}

class LightChange implements CarService {

    protected $carService;

    function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }
    
    public function getCost() {
        return 20 + $this->carService->getCost();
    }

    public function getDescription(){
        return $this->carService->getDescription().'and light change';
     }
}

$service = new OilChange(new TireChange(new BasicInspection));

echo $service->getCost();

// It will return 115