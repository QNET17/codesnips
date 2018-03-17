function imGUR($tmp) 
{ 
    global $script_link, $random, $imgur_api; 
    $image = file_get_contents($tmp); 
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image.json'); 
    curl_setopt($ch, CURLOPT_POST, TRUE); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array( 
        "Authorization: Client-ID $imgur_api" 
    )); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, array( 
        'image' => base64_encode($image) 
    )); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    $reply = curl_exec($ch); 
    curl_close($ch); 
    $reply = json_decode($reply); 
    $cover_out = $reply->data->link; 
    return $cover_out; 
}  