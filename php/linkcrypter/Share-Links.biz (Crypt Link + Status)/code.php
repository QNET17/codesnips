function shareLinks($downloadlinks, $sharelinks_api, $foldername, $username = "", $password = "", $folder_pw, $folder_admin_pw) 
{ 
    $ch2 = curl_init(); 
    curl_setopt($ch2, CURLOPT_URL, "http://share-links.biz/api/insert"); 
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch2, CURLOPT_POST, 1); 
    curl_setopt($ch2, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
    curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, 1); 
    $optionen = array( 
        'apikey' => $sharelinks_api, 
        'folderName' => $foldername, 
        'links' => $downloadlinks, 
        'pass_user' => (!empty($folder_pw) ? clean_input($folder_pw) : '') , 
        'pass_admin' => (!empty($folder_admin_pw) ? clean_input($folder_admin_pw) : '') , 
        'captcha' => 1, 
        'c_web' => 1, 
        'c_dlc' => 1, 
        'c_cnl' => 1, 
        'c_ccf' => 1, 
        'c_rsdf' => 1, 
        'comment' => "Hashcode: $foldername\n" 
    ); 
    curl_setopt($ch2, CURLOPT_POSTFIELDS, $optionen); 
    $rueckgabe = explode(';', curl_exec($ch2)); 
    curl_close($ch2); 
    $sl_link = str_replace("URL: ", "", $rueckgabe[0]); 

    // Wenn Login angegeben, dann Status ausgeben 

    if ($username != "" && $password != "") { 
        $loginUrl = 'http://share-links.biz/login'; 
        $sl_unique_id = str_replace("http://share-links.biz/_", "", $sl_link); 
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $loginUrl); 
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'remember_me=1&user=' . $username . '&pass=' . $password . '&submit=Login'); 
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt'); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $store = curl_exec($ch); 
        curl_setopt($ch, CURLOPT_URL, 'http://share-links.biz/manage?search=' . $sl_unique_id); // Search by unique-id 
        $content = curl_exec($ch); 

        // get the real folder id 

        preg_match('/<input type="checkbox" name="chkFolder\[\]" value="(\d+)" class="chkFolder vtext-middle" \/>/', $content, $match); 
        if (!isset($match[1])) die('could not extract real folder id'); 
        curl_setopt($ch, CURLOPT_URL, 'http://share-links.biz/manage'); 
        curl_setopt($ch, CURLOPT_POST, true); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, array( 
            'op' => 'stimg_png', 
            'chkFolder[]' => $match[1] 
        )); 
        $content = curl_exec($ch); 
        preg_match('/(http:\/\/stats\.share-links\.biz\/[0-9a-z]+\.png)/i', $content, $link); 
        if (!isset($link[1])) die('could not extract status image link'); 
        $status_image = $link[1]; 
    } 

    // Wenn kein Login angegeben, statisches Status-Image ausgeben (online) 

    else { 
        $status_image = 'http://share-links.biz/template/images/download/status/online_s.gif'; 
    } 

    $sl_simg = $status_image; 
    $sl_array = array( 
        $sl_link, 
        $sl_simg 
    ); 
    curl_close($ch); 
    return ($sl_array); 
}  