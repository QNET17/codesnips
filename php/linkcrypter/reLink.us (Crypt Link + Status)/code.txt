function reLink($downloadlinks, $relink_api, $foldername) 
{ 
    $your_mirrors = array( 
        0 => $downloadlinks 
    ); 
    $backup_links = array(); 
    $postdata = array( 
        "api" => $relink_api, 
        "url" => $your_mirrors, 
        "title" => $foldername, 
        "comment" => "", 
        "captcha" => "yes", 
        "password" => "", 
        "password_redirect" => "", 
        "web" => "yes", 
        "dlc" => "yes", 
        "cnl" => "yes", 
        "password_zip" => "", 
        "password_zip_public" => "", 
        "backup_links" => $backup_links 
    ); 
    $decode = urldecode(http_build_query($postdata)); 
    $curl = curl_init(); 
    curl_setopt($curl, CURLOPT_POST, 1); 
    curl_setopt($curl, CURLOPT_URL, "http://relink.to/api/api.php"); 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($curl, CURLOPT_POSTFIELDS, $decode); //Setting post data as xml 
    $json_out = curl_exec($curl); 
    $container = json_decode($json_out); 
    $rl_link = $container->{'message'}; 
    $status = str_replace("/f/", "/st/", $rl_link); 
    $rl_simg = $status . ".png"; 
    $rl_array = array( 
        $rl_link, 
        $rl_simg 
    ); 
    return ($rl_array); 
}  