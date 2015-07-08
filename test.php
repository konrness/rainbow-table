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
    'a',
    'b',
    'c',
);

$rainbow = new RainbowTable($inputStr, $inputLen);

$actual = $rainbow->getPermutations();

assertEquals($expected, $actual, "Failed asserting all 1- and 2-character permutations generated.");

////// TEST RAINBOW TABLE GENERATOR //////

$inputStr = array('a', 'b');
$inputLen = 2;

$expected = array(
    '4124bc0a9335c27f086f24ba207a4912' => 'aa',
    '187ef4436122d1cc2f40dc2b92f0eba0' => 'ab',
    '07159c47ee1b19ae4fb9c40d480856c4' => 'ba',
    '21ad0bd836b90d08f4cf640b4c298e7c' => 'bb',
    '0cc175b9c0f1b6a831c399e269772661' => 'a',
    '92eb5ffee6ae2fec3ad71c777531578f' => 'b',
);

$rainbow = new RainbowTable($inputStr, $inputLen);

$actual = $rainbow->generateRainbowTable();

assertEquals($expected, $actual, "Failed asserting rainbow tables generated.");

////// TEST UN-HASHER //////

$inputStr = array('a', 'b', 'c', '0', '1', '2', '3');
$inputLen = 4;

$rainbow = new RainbowTable($inputStr, $inputLen);

$actual   = $rainbow->unHash('81b5dd04bf5cbc172eeb34bb8062fde1');
$expected = 'a23c';

assertEquals($expected, $actual, "Failed asserting hash was found.");

echo PHP_EOL . PHP_EOL;

if (empty($failed)) {
    echo "\033[1;30m\033[42mOK\033[0m" . PHP_EOL;
} else {
    echo implode(PHP_EOL, $failed) . PHP_EOL;
    echo PHP_EOL . "\033[1;37m\033[41mFail!\033[0m" . PHP_EOL;
}

function assertEquals($expected, $actual, $message) {

    global $failed;

    if (! @assert(print_r($expected, true) == print_r($actual, true))) {
        echo "\033[1;37m\033[41mF\033[0m";

        $failed[] = sprintf(
            $message . "\nExpected:\n%s \n\nFound: %s",
            print_r($expected, true),
            print_r($actual, true)
        );
    } else {
        echo ".";
    }
}