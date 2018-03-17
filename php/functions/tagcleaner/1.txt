function clean_input($text) 
{ 
    $text = strip_tags($text); 
    $text = trim($text); 
    return $text; 
}  