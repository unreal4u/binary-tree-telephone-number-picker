<?php

declare(strict_types = 1);

$performLoop = true;
$currentNumber = 50000000;
$steps = 1;
$previousNumber = 0;
$roof = 100000000;
$ceiling = 0;

function calculateNewCurrent(int $roof, int $current): int {
		return intval(round((($roof - $current) / 2) + $current, 0));
}

$handle = fopen ("php://stdin","r");
while ($performLoop === true) {
		printf(
				'Step %\'.02d: Is this your phone number: "06-%d"? Accept ("%s"), quit ("%s"), go up ("%s"), do down ("%s")?: ',
				$steps,
				$currentNumber,
				"a",
				"q",
				"w",
				"d"
		);
		$line = fgets($handle);
		$char = trim($line);

		switch ($char) {
				case 'w':
						$ceiling = $currentNumber;
						$currentNumber = calculateNewCurrent($roof, $currentNumber);
						break;
				case 'd':
						$roof = $currentNumber;
						$currentNumber = calculateNewCurrent($ceiling, $currentNumber);
						break;
				case 'a':
						printf('Nice to know! Total steps needed: %d%s', ($steps - 1), PHP_EOL);
				case 'q':
						printf('Now quitting, thanks for using!%s', PHP_EOL);
						$performLoop = false;
				default:
						// If invalid key, we should not count this step
						$steps--;
						break;
		}

		$previousNumber = $currentNumber;
		$steps++;
}
fclose($handle);

exit(0);

