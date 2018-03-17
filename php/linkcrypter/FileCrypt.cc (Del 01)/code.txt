function filecrypt_del($containerid, $filecrypt_api) 
{ 
    $postdata = array( 
        'api_key'      => $filecrypt_api, 
        'fn'           => 'container', 
        'sub'          => 'remove', 
        'fmt'          => 'xml', 
        'container_id' => $containerid, 
    ); 
    $curl = curl_init(); 
    curl_setopt($curl, CURLOPT_URL, "https://filecrypt.cc/api.php"); 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata); //Setting post data as xml 
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); 
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); 
    $curl_exec = curl_exec($curl); 
    curl_close($curl); 
    $xml        = $curl_exec; 
    $data_array = xml_to_array($xml); 
    $del   = $data_array['state']; 
    return ($del); 
}  