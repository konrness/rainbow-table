<?php

require 'RainbowTable.php';

/////// TEST PERMUTATION GENERATOR ///////

$inputStr = array('a', 'b', 'c');
$inputLen = 2;

$expected = array(
    'aa',
    'ab',
    'ac',
    'ba',
    'bb',
    'bc',
    'ca',
    'cb',
    'cc',
);

$rainbow = new RainbowTable($inputStr, $inputLen);

$actual = $rainbow->getPermutations();

assert(print_r($expected, true) == print_r($actual, true));

////// TEST RAINBOW TABLE GENERATOR //////

$inputStr = array('a', 'b');
$inputLen = 2;

$expected = array(
    '4124bc0a9335c27f086f24ba207a4912' => 'aa',
    '187ef4436122d1cc2f40dc2b92f0eba0' => 'ab',
    '07159c47ee1b19ae4fb9c40d480856c4' => 'ba',
    '21ad0bd836b90d08f4cf640b4c298e7c' => 'bb',
);

$rainbow = new RainbowTable($inputStr, $inputLen);

$actual = $rainbow->generateRainbowTable();

assert(print_r($expected, true) == print_r($actual, true));

////// TEST UN-HASHER //////

$inputStr = array('a', 'b', 'c', '0', '1', '2', '3');
$inputLen = 4;

$rainbow = new RainbowTable($inputStr, $inputLen);

$actual   = $rainbow->unHash('81b5dd04bf5cbc172eeb34bb8062fde1');
$expected = 'a23c';

assert(print_r($expected, true) == print_r($actual, true));

echo "\n";
