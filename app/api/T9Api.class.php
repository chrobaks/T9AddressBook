<?php
/**
 * class T9Api (Singleton)
 */
class T9Api
{
    private static T9Api $instance;
    private array $numberLettersConfig;
    public function __construct()
    {
        $this->numberLettersConfig = [
            '2'  => 'abc',
            '3'  => 'def',
            '4'  => 'ghi',
            '5'  => 'jkl',
            '6'  => 'mno',
            '7'  => 'pqrs',
            '8'  => 'tuv',
            '9'  => 'wxyz'
        ];
    }

    /**
     * @return \T9Api
     */
    public static function get_instance(): T9Api
    {
        if( ! isset(self::$instance)){self::$instance = new T9Api();}

        return self::$instance;
    }

    /**
     * @param string $phone
     * @return array
     */
    public function phoneToWords(string $phone): array
    {
        $result = [];
        $words = [];
        // Get phone number as array
        $phoneArgs = str_split($phone);
        // phoneArgs length to use in for loop
        $phoneArgsLength = count($phoneArgs);
        // Get the first letters from keys
        $firstLetter = $this->numberLettersConfig[$phoneArgs[0]] ?? "";
        if ($firstLetter !== "") {
            // Cast to array
            $firstLetter = str_split($firstLetter);
            // Create word options
            foreach ($firstLetter as $letter) {
                // Set first value in $words for each first letter
                $words[$letter] = [$letter];
                // Iterate through $phoneArgs from index 1
                for ($i = 1; $i < $phoneArgsLength; $i++) {
                    // Get each variation word with this letter options
                    $words[$letter] = $this->getLetterToWord(
                        $words[$letter],
                        str_split($this->numberLettersConfig[$phoneArgs[$i]])
                    );
                }
                // Set $result with each final word
                foreach ($words[$letter] as $word) {
                    $result[] = $word;
                }
            }
        }

        return $result;
    }

    /**
     * @param array $words
     * @param array $letters
     * @return array
     */
    private function getLetterToWord (array $words, array $letters): array
    {
        $result = [];
        foreach ($words as $word) {
            foreach ($letters as $letter) {
                $result[] = $word . $letter;
            }
        }

        return $result;
    }
}