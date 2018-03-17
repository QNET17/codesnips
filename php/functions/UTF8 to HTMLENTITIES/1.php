function utf8_to_htmlentities($source) 
{ 
    // array used to figure what number to decrement from character order 
    // value 
    // according to number of characters used to map unicode to ascii by 
    // utf-8 
    $decrement    = array(); 
    $decrement[4] = 240; 
    $decrement[3] = 224; 
    $decrement[2] = 192; 
    $decrement[1] = 0; 

    // the number of bits to shift each charNum by 
    $shift       = array(); 
    $shift[1][0] = 0; 
    $shift[2][0] = 6; 
    $shift[2][1] = 0; 
    $shift[3][0] = 12; 
    $shift[3][1] = 6; 
    $shift[3][2] = 0; 
    $shift[4][0] = 18; 
    $shift[4][1] = 12; 
    $shift[4][2] = 6; 
    $shift[4][3] = 0; 

    $pos = 0; 
    $len = strlen($source); 
    $str = ''; 
    while ($pos < $len) { 
        $asciiPos = ord(substr($source, $pos, 1)); 
        if (($asciiPos >= 240) && ($asciiPos <= 255)) { 
            // 4 chars representing one unicode character 
            $thisLetter = substr($source, $pos, 4); 
            $pos += 4; 
        } elseif (($asciiPos >= 224) && ($asciiPos <= 239)) { 
            // 3 chars representing one unicode character 
            $thisLetter = substr($source, $pos, 3); 
            $pos += 3; 
        } else if (($asciiPos >= 192) && ($asciiPos <= 223)) { 
            // 2 chars representing one unicode character 
            $thisLetter = substr($source, $pos, 2); 
            $pos += 2; 
        } else { 
            // 1 char (lower ascii) 
            $thisLetter = substr($source, $pos, 1); 
            $pos += 1; 
        } 

        // process the string representing the letter to a unicode entity 
        $thisLen     = strlen($thisLetter); 
        $thisPos     = 0; 
        $decimalCode = 0; 

        while ($thisPos < $thisLen) { 
            $thisCharOrd = ord(substr($thisLetter, $thisPos, 1)); 
            if ($thisPos == 0) { 
                $charNum = intval($thisCharOrd - $decrement[$thisLen]); 
                $decimalCode += ($charNum << $shift[$thisLen][$thisPos]); 
            } else { 
                $charNum = intval($thisCharOrd - 128); 
                $decimalCode += ($charNum << $shift[$thisLen][$thisPos]); 
            } 
            $thisPos++; 
        } 
        if (($thisLen == 1) && ($decimalCode <= 128)) { 
            $encodedLetter = $thisLetter; 
        } else { 
            $encodedLetter = '&#' . $decimalCode . ';'; 
        } 
        $str .= $encodedLetter; 
    } 
    return $str; 
}  