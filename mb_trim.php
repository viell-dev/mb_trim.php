<?php
/**
 * Multibyte Trim Functions
 * ----------------
 * PHP 5.4 functions mb_trim, mb_ltrim, mb_rtrim
 * 
 * @author viell
 */

/**
 * Make sure to set mb_iternal_encoding in your project!!
 * 
 * The defualt value of mb_internal_encoding is often ISO-8859-1.
 */
#mb_internal_encoding('UTF-8');

if (extension_loaded('mbstring')) {
    /**
     * mb_trim
     * 
     * Strip whitespace (or other characters) from the beginning and end of a string.
     * 
     * @param string $str The string that will be trimmed.
     * @param string $charlist Optionally, the stripped characters can also be specified using the charlist parameter. Simply list all characters that you want to be stripped. With .. you can specify a range of characters.
     * @param string $encoding The encoding parameter is the character encoding. If it is omitted, the internal character encoding value will be used.
     * @return string The trimmed string.
     */
    function mb_trim($str, $charlist = NULL, $encoding = NULL) {
        if ($encoding === NULL) {
            $encoding = mb_internal_encoding(); // Get internal encoding when not specified.
        }
        if ($charlist === NULL) {
            $charlist = "\\x{20}\\x{9}\\x{A}\\x{D}\\x{0}\\x{B}"; // Standard charlist, same as trim.
        } else {
            $chars = preg_split('//u', $charlist, -1, PREG_SPLIT_NO_EMPTY); // Splits the string into an array, character by character.
            foreach ($chars as $c => &$char) {
                if (preg_match('/^\x{2E}$/u', $char) && preg_match('/^\x{2E}$/u', $chars[$c+1])) { // Check for character ranges.
                    $ch1 = hexdec(substr($chars[$c-1], 3, -1));
                    $ch2 = (int)substr(mb_encode_numericentity($chars[$c+2], [0x0, 0x10ffff, 0, 0x10ffff], $encoding), 2, -1);
                    $chs = '';
                    for ($i = $ch1; $i <= $ch2; $i++) { // Loop through characters in Unicode order.
                        $chs .= "\\x{" . dechex($i) . "}";
                    }
                    unset($chars[$c], $chars[$c+1], $chars[$c+2]); // Unset the now pointless values.
                    $chars[$c-1] = $chs; // Set the range.
                } else {
                    $char = "\\x{" . dechex(substr(mb_encode_numericentity($char, [0x0, 0x10ffff, 0, 0x10ffff], $encoding), 2, -1)) . "}"; // Convert the character to it's unicode codepoint in \x{##} format.
                }
            }
            $charlist = implode('', $chars); // Return the array to string type.
        }
        $pattern = '/(^[' . $charlist . ']+)|([' . $charlist . ']+$)/u'; // Define the pattern.
        return preg_replace($pattern, '', $str); // Return the trimmed value.
    }
    /**
     * mb_ltrim
     * 
     * Strip whitespace (or other characters) from the beginning of a string.
     * 
     * @param string $str The string that will be trimmed.
     * @param string $charlist Optionally, the stripped characters can also be specified using the charlist parameter. Simply list all characters that you want to be stripped. With .. you can specify a range of characters.
     * @param string $encoding The encoding parameter is the character encoding. If it is omitted, the internal character encoding value will be used.
     * @return string The trimmed string.
     */
    function mb_ltrim($str, $charlist = NULL, $encoding = NULL) {
        if ($encoding === NULL) {
            $encoding = mb_internal_encoding(); // Get internal encoding when not specified.
        }
        if ($charlist === NULL) {
            $charlist = "\\x{20}\\x{9}\\x{A}\\x{D}\\x{0}\\x{B}"; // Standard charlist, same as trim.
        } else {
            $chars = preg_split('//u', $charlist, -1, PREG_SPLIT_NO_EMPTY); // Splits the string into an array, character by character.
            foreach ($chars as $c => &$char) {
                if (preg_match('/^\x{2E}$/u', $char) && preg_match('/^\x{2E}$/u', $chars[$c+1])) { // Check for character ranges.
                    $ch1 = hexdec(substr($chars[$c-1], 3, -1));
                    $ch2 = (int)substr(mb_encode_numericentity($chars[$c+2], [0x0, 0x10ffff, 0, 0x10ffff], $encoding), 2, -1);
                    $chs = '';
                    for ($i = $ch1; $i <= $ch2; $i++) { // Loop through characters in Unicode order.
                        $chs .= "\\x{" . dechex($i) . "}";
                    }
                    unset($chars[$c], $chars[$c+1], $chars[$c+2]); // Unset the now pointless values.
                    $chars[$c-1] = $chs; // Set the range.
                } else {
                    $char = "\\x{" . dechex(substr(mb_encode_numericentity($char, [0x0, 0x10ffff, 0, 0x10ffff], $encoding), 2, -1)) . "}"; // Convert the character to it's unicode codepoint in \x{##} format.
                }
            }
            $charlist = implode('', $chars); // Return the array to string type.
        }
        $pattern = '/(^[' . $charlist . ']+)/u'; // Define the pattern.
        return preg_replace($pattern, '', $str); // Return the trimmed value.
    }
    /**
     * mb_trim
     * 
     * Strip whitespace (or other characters) from the end of a string.
     * 
     * @param string $str The string that will be trimmed.
     * @param string $charlist Optionally, the stripped characters can also be specified using the charlist parameter. Simply list all characters that you want to be stripped. With .. you can specify a range of characters.
     * @param string $encoding The encoding parameter is the character encoding. If it is omitted, the internal character encoding value will be used.
     * @return string The trimmed string.
     */
    function mb_rtrim($str, $charlist = NULL, $encoding = NULL) {
        if ($encoding === NULL) {
            $encoding = mb_internal_encoding(); // Get internal encoding when not specified.
        }
        if ($charlist === NULL) {
            $charlist = "\\x{20}\\x{9}\\x{A}\\x{D}\\x{0}\\x{B}"; // Standard charlist, same as trim.
        } else {
            $chars = preg_split('//u', $charlist, -1, PREG_SPLIT_NO_EMPTY); // Splits the string into an array, character by character.
            foreach ($chars as $c => &$char) {
                if (preg_match('/^\x{2E}$/u', $char) && preg_match('/^\x{2E}$/u', $chars[$c+1])) { // Check for character ranges.
                    $ch1 = hexdec(substr($chars[$c-1], 3, -1));
                    $ch2 = (int)substr(mb_encode_numericentity($chars[$c+2], [0x0, 0x10ffff, 0, 0x10ffff], $encoding), 2, -1);
                    $chs = '';
                    for ($i = $ch1; $i <= $ch2; $i++) { // Loop through characters in Unicode order.
                        $chs .= "\\x{" . dechex($i) . "}";
                    }
                    unset($chars[$c], $chars[$c+1], $chars[$c+2]); // Unset the now pointless values.
                    $chars[$c-1] = $chs; // Set the range.
                } else {
                    $char = "\\x{" . dechex(substr(mb_encode_numericentity($char, [0x0, 0x10ffff, 0, 0x10ffff], $encoding), 2, -1)) . "}"; // Convert the character to it's unicode codepoint in \x{##} format.
                }
            }
            $charlist = implode('', $chars); // Return the array to string type.
        }
        $pattern = '/([' . $charlist . ']+$)/u'; // Define the pattern.
        return preg_replace($pattern, '', $str); // Return the trimmed value.
    }
} else {
    trigger_error('ERROR (mb_trim): PHP extention \'mbstring\' must be loaded.', E_USER_ERROR);
}
