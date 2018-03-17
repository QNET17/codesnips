function xml_to_array($xml, $main_heading = '') 
{ 
    $deXml     = simplexml_load_string($xml); 
    $deJson    = json_encode($deXml); 
    $xml_array = json_decode($deJson, true); 
    if (!empty($main_heading)) { 
        $returned = $xml_array[$main_heading]; 
        return $returned; 
    } else { 
        return $xml_array; 
    } 
} 

// Linkcrypt.cc 
function fileCrypt($downloadlinks, $filecrypt_api, $foldername) 
{ 
    $postdata = array( 
        'api_key'         => $filecrypt_api, 
        'fn'              => 'container', 
        'sub'             => 'create', 
        'fmt'             => 'xml', 
        'foldername'      => $foldername, 
        'captcha'         => '1', 
        'allow_container' => '1', 
        'allow_links'     => '1', 
        'mirror[]'        => $downloadlinks, 
    ); 
    $curl = curl_init(); 
    curl_setopt($curl, CURLOPT_URL, "https://filecrypt.cc/api.php"); 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata); //Setting post data as xml 
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); 
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); 
    $filecrypt_links = curl_exec($curl); 
    curl_close($curl); 
    $xml        = $filecrypt_links; 
    $data_array = xml_to_array($xml); 
    $fc_link    = $data_array['container']['link']; 
    $fc_simg    = $data_array['container']['bigimg'] . ".png"; 
    $fc_array   = array( 
        $fc_link, 
        $fc_simg 
    ); 
    return ($fc_array); 
}  