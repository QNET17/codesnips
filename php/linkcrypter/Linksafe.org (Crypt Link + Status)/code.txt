function linkSafe($downloadlinks, $linksafe_api, $foldername) 
{ 
    $postdata = array( 
        "key" => $linksafe_api, 
        "mirror" => $downloadlinks, 
        "name" => $foldername, 
        "captcha" => "1", 
        "allow_links" => "1", 
        "allow_cnl" => "1", 
        "allow_dlc" => "1", 
    ); 
    $curl = curl_init(); 
    curl_setopt($curl, CURLOPT_POST, 1); 
    curl_setopt($curl, CURLOPT_URL, "http://linksafe.org/api/v1/folder/create"); 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata); 
    $json_out = curl_exec($curl); 
    $obj = json_decode($json_out, true); 
    $ls_link = $obj['data']['folder_link']; 
    $ls_simg = "http://linksafe.org/img/" . $obj['data']['folder_id'] . "/big"; 
    $ls_array = array( 
        $ls_link, 
        $ls_simg 
    ); 
    return ($ls_array); 
}  