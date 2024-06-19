<?php

interface Subject
{
	public function attach(Observer $observer);
	public function detach(Observer $observer);
	public function notify();
}

interface Observer
{
	public function update(float $ibmPrice, float $aaplPrice, float $googPrice);
} 

class StockGrabber implements Subject
{
	private array $observers = [];
	private float $ibmPrice = 0;
	private float $aaplPrice = 0;
	private float $googPrice = 0;

	public function attach(Observer $observer) {
		$this->observers[] = $observer;
	}

	public function detach(Observer $observer) {
		$index = array_search($observer, $this->observers);
		unset($this->observers[$index]);
	}

	public function notify() {
		foreach ($this->observers as $observer) {
			$observer->update($this->ibmPrice, $this->aaplPrice, $this->googPrice);
		}
	}

	public function setIBMPrice(float $price) {
		$this->ibmPrice = $price;
		$this->notify();
	}

	public function setAAPLPrice(float $price) {
		$this->aaplPrice = $price;
		$this->notify();
	}

	public function setGOOGPrice(float $price) {
		$this->googPrice = $price;
		$this->notify();
	}
}

class StockObserver implements Observer
{
	private float $ibmPrice;
	private float $aaplPrice;
	private float $googPrice;
	private static int $observerIdTracker = 0;
	private int $observerId;
	private Subject $stockGrabber;

	public function __construct(Subject $stockGrabber) {
		$this->stockGrabber = $stockGrabber;
		$this->observerId = ++static::$observerIdTracker;
		$this->stockGrabber->attach($this);
	}

	public function update(float $ibmPrice, float $aaplPrice, float $googPrice) {
		$this->ibmPrice = $ibmPrice;
		$this->aaplPrice = $aaplPrice;
		$this->googPrice = $googPrice;
		$this->printPrices();
	}

	public function printPrices() {
		echo "$this->observerId: \n IBM: $this->ibmPrice \n AAPL: $this->aaplPrice \n GOOG: $this->googPrice \n";
	}
}

$stockGrabber = new StockGrabber();
$stockObserver1 = new StockObserver($stockGrabber);

$stockGrabber->setIBMPrice(100.00);
$stockGrabber->setAAPLPrice(600.00);
$stockGrabber->setGOOGPrice(500.00);

$stockObserver2 = new StockObserver($stockGrabber);
$stockGrabber->setIBMPrice(200.00);
$stockGrabber->setAAPLPrice(800.00);
$stockGrabber->setGOOGPrice(400.00);

$stockGrabber->detach($stockObserver1);

$stockObserver3 = new StockObserver($stockGrabber);
$stockGrabber->setIBMPrice(150.00);
$stockGrabber->setAAPLPrice(150.00);
$stockGrabber->setGOOGPrice(150.00);