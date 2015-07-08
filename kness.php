<?php
/**
 * Challenge Yourselph - 010
 *
 * Hack the Password
 *
 * Usage: php kness.php [input]
 * Example: php kness.php 81b5dd04bf5cbc172eeb34bb8062fde1
 *
 * @author Konr Ness <konr.ness@gmail.com>
 */

require 'RainbowTable.php';

$input = $argv[1];

// Requirement: The password can only have the following characters [a, b, c, 0, 1, 2, 3] (it’s a weird pin pad)
$characters = array('a', 'b', 'c', '0', '1', '2', '3');
$maxPasswordLength = 4;

$rainbow = new RainbowTable($characters, $maxPasswordLength);

echo $rainbow->unHash($input) . PHP_EOL;