function cnl($links) 
{ 
    $cnl_links = preg_replace('/\s\s+/', '/r/n', $links); 
    $cnl = "http://127.0.0.1:9666/flash/add?source=http://jdownloader.org/spielwiese&urls=" . $cnl_links; 
    return $cnl; 
}  