function format_date($format, $timestamp) 
{ 
    global $user_info; 
    $timezone_offset = (defined("TIME_OFFSET")) ? TIME_OFFSET : 0; 
    return date($format, $timestamp + (3600 * $timezone_offset)); 
}  