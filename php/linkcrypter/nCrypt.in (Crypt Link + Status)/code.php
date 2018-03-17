function nCrypt($downloadlinks, $ncrypt_api, $foldername) 
{ 
    $links = array( 
        $downloadlinks 
    ); 

    // POST DATA 

    $postdata = array( 
        'auth_code' => $ncrypt_api, 
        'foldername' => $foldername, 
        'captcha' => '4', 
        'show_container' => '1', 
        'dlc' => '1', 
        'cnl' => '1', 
        'ccf' => '1', 
        'rsdf' => '1', 
        'links' => implode("\n", $links) 
    ); 

    // INITIALISE CURL REQUEST 

    $ch = curl_init('http://ncrypt.in/api.php'); 

    // CURL OPTIONS 

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata); 

    // EXECUTE CURL REQUEST 

    $result = curl_exec($ch); 
    list($folder, $status) = explode("\n", $result); 

    // curl_close($ch); 

    $nc_link = $folder; 
    $nc_simg = $status; 
    $nc_array = array( 
        $nc_link, 
        $nc_simg 
    ); 
    return ($nc_array); 
}  