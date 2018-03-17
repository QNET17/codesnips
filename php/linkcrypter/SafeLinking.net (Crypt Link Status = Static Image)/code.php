function safeLinking($downloadlinks, $foldername, $username, $password) 
{ 
    $postdata = array( 
        "mode" => "get-api-hash", 
        "username" => $username, 
        "password" => $password, 
        "output" => "JSON" 
    ); 
    $decode = urldecode(http_build_query($postdata)); 
    $curl = curl_init(); 
    curl_setopt($curl, CURLOPT_POST, 1); 
    curl_setopt($curl, CURLOPT_URL, "https://safelinking.net/api"); 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($curl, CURLOPT_POSTFIELDS, $decode); //Setting post data as xml 
    $json_out = curl_exec($curl); 
    $container = json_decode($json_out); 
    curl_close($curl); 
    $apihash = $container->{'api_hash'}; 
    $postdata = array( 
        "api_hash" => $apihash, 
        "links-to-protect" => $downloadlinks, 
        "title" => $foldername, 
        "captcha-type" => "recaptcha", 
        "enable-captcha" => "on", 
        "rsdf" => "on", 
        "dlc" => "on", 
        "rtc" => "on", 
        "cnl2" => "on", 
        "output" => "JSON", 
        "username" => $username, 
    ); 
    $decode = urldecode(http_build_query($postdata)); 
    $curl = curl_init(); 
    curl_setopt($curl, CURLOPT_POST, 1); 
    curl_setopt($curl, CURLOPT_URL, "https://safelinking.net/api"); 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($curl, CURLOPT_POSTFIELDS, $decode); //Setting post data as xml 
    $json_out = curl_exec($curl); 
    $container = json_decode($json_out); 
    $slinking_link = $container->{'p_links'}; 
    $slinking_simg = "http://fs5.directupload.net/images/161101/dbtx3iv2.png"; 
    $slinking_array = array( 
        $slinking_link, 
        $slinking_simg 
    ); 
    return ($slinking_array); 
}  