<?php
namespace App\Helpers;
class TextHelper
{

    /** This method converts given string to Typoglycemia string
     * @param string $text
     * @return string
     */
    public static function scramble(string $text) : string {
        $pattern = '/[\'^£$%&*()}"{@#~?><>.,|=_+¬!"]/';
        $words = preg_split('/\s+/', $text); // split text into words
        $original_words = array();
        $typo_map = array(); //holds original words to revert operation

        foreach ($words as $word) {
            if (strlen($word) > 3) {
                $firstChar = mb_substr($word, 0,1, "UTF-8");
                $lastChar  = mb_substr($word, -1,1, "UTF-8");

                // if the word starts with special chars, select second char as first char
                if (preg_match($pattern, $firstChar)) {
                    $firstChar = $firstChar.mb_substr($word, 1, 1, "UTF-8");
                }

                // if the word ends with special chars, select second to last character
                if (preg_match($pattern, $lastChar)) {
                    $lastChar = mb_substr($word, -2, 1, "UTF-8").$lastChar;
                }

                // get middle characters of the word
                $original_middle_chars = substr($word, 1, -1);
                $original_middle_chars_array = str_split($original_middle_chars);
                shuffle($original_middle_chars_array);
                $original_word = $firstChar . implode("", $original_middle_chars_array) . $lastChar;
                array_push($original_words, $original_word);

                $typo_map[$original_word] = $word;
            } else {
                array_push($original_words, $word);
            }
        }

        $convertedText = implode(" ", $original_words);
        $_SESSION["originalText"] = $text;
        $_SESSION["originalWords"] = $typo_map;

        return $convertedText;
    }

    /**
     * This method reverts given Typoglycemia string to original version
     * @param string $text
     * @return string
     */
    public static function unscramble(string $text) :string {
        $words = explode(" ", $text);
        $originalWords = $_SESSION["originalWords"];
        $reverted_words = array();
        foreach ($words as $word) {
            // Check if the word exists in original words before scramble operation
            if (array_key_exists($word, $originalWords)) {
                array_push($reverted_words, $originalWords[$word]);
            } else {
                array_push($reverted_words, $word);
            }
        }

        $revertedText = implode(" ", $reverted_words);
        if($_SESSION["originalText"] !== $revertedText) {
            unset($_SESSION["originalWords"]);
        }

        return $revertedText;
    }
}