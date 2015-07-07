<?php
/**
 * Challenge Yourselph - 010
 *
 * Hack the Password
 *
 * Usage: php kness.php [input]
 *
 * @author Konr Ness <konr.ness@gmail.com>
 */

require 'RainbowTable.php';

$input = $argv[1];

$characters = array('a', 'b', 'c', '0', '1', '2', '3');
$maxPasswordLength = 4;

$rainbow = new RainbowTable($characters, $maxPasswordLength);

echo $rainbow->unHash($input) . PHP_EOL;