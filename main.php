<?php

$farm = new TechFarm;
for ($i = 0; $i < 10; $i++) {
	$chick1 = new Chicken();
	$chick2 = new Chicken();
	$cow1 = new Cow();
	$farm->addAnimal(3 * $i, $chick1);
	$farm->addAnimal(3 * $i + 1, $chick2);
	$farm->addAnimal(3 * $i + 2, $cow1);
}
$farm->countAnimals();
print("\n");
$farm->collectProduction(7);
$farm->addAnimal(30, $cow1);
for ($i = 0; $i < 5; $i++) {
	$chick1 = new Chicken();
	$farm->addAnimal(31 + $i, $chick1);
}
print("\n");
$farm->countAnimals();
print("\n");
$farm->collectProduction(7);

class Animal
{
	function specieName() {}
	function specieProduce() {}
}

class Chicken extends Animal
{
	function specieName()
	{
		return ("Chicken");
	}

	function specieProduce()
	{
		return array("Eggs" => rand(0, 1));
	}
}

class Cow extends Animal
{
	function specieName()
	{
		return ("Cow");
	}

	function specieProduce()
	{
		return array("Litres of milk" => rand(8, 12));
	}
}

class TechFarm
{
	public $mainfarm = array();

	function addAnimal(int $number, Animal $animal)
	{
		$this->mainfarm["$number"] = $animal;
	}

	function collectProduction(int $days)
	{
		$products = array();
		printf("Production in " . $days . " days:\n");
		for ($i = 0; $i < $days; $i++) {
			foreach ($this->mainfarm as $mf) {
				$f = 0;
				foreach ($mf->specieProduce() as $resource => $value) {
					for ($j = 0; $j < count($products); $j++) {
						if ($products[$j][1] == $resource) {
							$f = 1;
							$products[$j][0] += $value;
							break;
						}
					}
					if ($f == 0) {
						$products[] = array($value, $resource);
					}
				}
			}
		}
		foreach ($products as $s) {
			printf($s[0] . " " . $s[1] . "\n");
		}
	}

	function countAnimals()
	{
		$animals = array();
		print("Animals on the farm:\n");
		foreach ($this->mainfarm as $mf) {
			$f = 0;
			for ($i = 0; $i < count($animals); $i++) {
				if ($animals[$i][1] == $mf->specieName()) {
					$f = 1;
					$animals[$i][0]++;
					break;
				}
			}
			if ($f == 0) {
				$animals[] = array(1, $mf->specieName());
			}
		}
		foreach ($animals as $s) {
			printf($s[1] . ": " . $s[0] . "\n");
		}
	}
}
