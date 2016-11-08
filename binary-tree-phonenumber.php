<?php

declare(strict_types = 1);

$performLoop = true;
$currentNumber = 50000000;
$steps = 0;
$previousNumber = 0;
$roof = 100000000;
$ceiling = 0;

function calculateNewCurrent(int $roof, int $current): int {
		return intval(round((($roof - $current) / 2) + $current, 0));
}

$handle = fopen ("php://stdin","r");
while ($performLoop === true) {
		printf(
				'Is this your phone number: "%d"? Accept (with "%s"), quit ("%s"), go up the tree ("%s") or down ("%s")?: ',
				$currentNumber,
				"y",
				"q",
				"u",
				"d"
		);
		$line = fgets($handle);
		$char = trim($line);

		switch ($char) {
				case 'u':
						$ceiling = $currentNumber;
						$currentNumber = calculateNewCurrent($roof, $currentNumber);
						break;
				case 'd':
						$roof = $currentNumber;
						$currentNumber = calculateNewCurrent($ceiling, $currentNumber);
						break;
				case 'y':
						printf('Nice to know! Total steps needed: %d%s', $steps, PHP_EOL);
				case 'q':
						printf('Now quitting, thanks for using!%s', PHP_EOL);
						$performLoop = false;
				default:
						break;
		}

		$previousNumber = $currentNumber;
		$steps++;
}
fclose($handle);

exit(0);

