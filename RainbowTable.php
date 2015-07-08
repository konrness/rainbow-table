<?php
/**
 * Challenge Yourselph - 010
 *
 * Hack the Password
 *
 * @author Konr Ness <konr.ness@nerdery.com>
 */

/**
 * Rainbow Table class for generating MD5 hash rainbow tables and finding matches
 */
class RainbowTable
{

    /**
     * @var array
     */
    protected $characters;

    /**
     * @var int
     */
    protected $length;

    public function __construct($characters, $length)
    {
        $this->characters = $characters;
        $this->length     = $length;
    }

    /**
     * Crack an MD5 hash
     *
     * @param string $hash
     * @return string|null
     */
    public function unHash($hash)
    {
        $rainbowTable = $this->generateRainbowTable();

        return isset($rainbowTable[$hash]) ? $rainbowTable[$hash] : null;
    }

    /**
     * Get all unique permutations of characters for given length
     *
     * @return string[]
     */
    public function getPermutations()
    {
        $permutations = array();

        // Requirement: The maximum password length is 4 because it’s a pin number
        // Generate permutations for 1, 2, 3 & 4 character pin numbers
        for ($i = $this->length; $i > 0; $i--) {
            $permutations = array_merge($permutations,$this->permute($i));
        }

        return $permutations;
    }

    /**
     * Generate a rainbow table of MD5 hashes for all character permutations
     *
     * Array keys are the md5 hash of the array values.
     *
     * @return string[]
     */
    public function generateRainbowTable()
    {
        $rainbowTable = array_flip($this->getPermutations());

        array_walk(
            $rainbowTable,
            function(&$value, $key) {
                $value = md5($key);
            }
        );

        return array_flip($rainbowTable);
    }

    /**
     * Recursively generate more permutations of unique strings until the maximum length is reached
     *
     * @see getPermutations
     *
     * @param int $curPosition
     * @param array $permutations
     * @return array
     */
    protected function permute($curPosition, $permutations = array())
    {
        // on the first iteration, the first set of permutations is each of the characters
        if (empty($permutations)) {
            $permutations = $this->characters;
        }

        // we are done if we're at the first character
        if ($curPosition == 1) {
            return $permutations;
        }

        $newPermutations = array();

        foreach ($permutations as $combination) {
            // add permutation for all characters to existing permutations
            foreach ($this->characters as $char) {
                $newPermutations[] = $combination . $char;
            }
        }

        // move on to the next position, recursively
        return $this->permute($curPosition - 1, $newPermutations);

    }

}
