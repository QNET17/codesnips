function get_match($regex, $content, $pos = 1)
{
    /* do your job */
    preg_match($regex, $content, $matches);
    /* return our result */
    return $matches[intval($pos)];
}