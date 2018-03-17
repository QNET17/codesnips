function uni_to_utf8($char) 
{ 
    $char = intval($char); 

    switch ($char) { 
        case ($char < 128): 
            // its an ASCII char no encoding needed 
            return chr($char); 

        case ($char < 1 << 11): 
            // its a 2 byte UTF-8 char 
            return chr(192 + ($char >> 6)) . 
            chr(128 + ($char & 63)); 

        case ($char < 1 << 16): 
            // its a 3 byte UTF-8 char 
            return chr(224 + ($char >> 12)) . 
            chr(128 + (($char >> 6) & 63)) . 
            chr(128 + ($char & 63)); 

        case ($char < 1 << 21): 
            // its a 4 byte UTF-8 char 
            return chr(240 + ($char >> 18)) . 
            chr(128 + (($char >> 12) & 63)) . 
            chr(128 + (($char >> 6) & 63)) . 
            chr(128 + ($char & 63)); 

        case ($char < 1 << 26): 
            // its a 5 byte UTF-8 char 
            return chr(248 + ($char >> 24)) . 
            chr(128 + (($char >> 18) & 63)) . 
            chr(128 + (($char >> 12) & 63)) . 
            chr(128 + (($char >> 6) & 63)) . 
            chr(128 + ($char & 63)); 
        default: 
            // its a 6 byte UTF-8 char 
            return chr(252 + ($char >> 30)) . 
            chr(128 + (($char >> 24) & 63)) . 
            chr(128 + (($char >> 18) & 63)) . 
            chr(128 + (($char >> 12) & 63)) . 
            chr(128 + (($char >> 6) & 63)) . 
            chr(128 + ($char & 63)); 
    } 
}  