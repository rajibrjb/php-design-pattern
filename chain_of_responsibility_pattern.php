<?php

abstract class HomeChecker
{

	protected $successor;

	public abstract function check(HomeStatus $home);

	public function succeedWith(HomeChecker $successor)
	{
		$this->successor = $successor;
	}
	public function next(HomeStatus $home)
	{
		if($this->successor)
		{
			$this->successor->check($home);
		}
		
	}
}

class Locks extends HomeChecker {

	public function check(HomeStatus $home)
	{
		if (!$home->locked) {
			throw new Exception('The door is not locked');
		}
		$this->next($home);
	}
}


class Lights extends HomeChecker {
	public function check(HomeStatus $home)
	{
		if (!$home->lightOff) {
			throw new Exception('The Lights are on');
		}
		$this->next($home);
	}
}

class Alarm extends HomeChecker {
	public function check(HomeStatus $home)
	{
		if (!$home->alarmOn) {
			throw new Exception('The Alarm has not been set');
		}
		$this->next($home);
	}
}

class HomeStatus
{
	public $alarmOn = false;
	public $locked = true;
	public $lightOff = true;
}

$locks = new Locks;
$lights = new Lights;
$alarm = new Alarm;

$locks->succeedWith($lights);
$lights->succeedWith($alarm);

$locks->check(new HomeStatus);
