function getPageTitle($sURL) 
{ 
    if( ($sHTML = file_get_contents($sURL)) && 
        preg_match("/<title>(.+)<\/title>/i", $sHTML, $aTitle))   
    { 
        return trim($aTitle[1]); 
    } 
    return false; 
}  