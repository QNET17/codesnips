function filecryptCC($links, $api, $foldername)
{
    define('YES', 1);
    define('NO', 0);
    $USE_SSL  = true;
    $api_key  = $api;
    $name     = $foldername;
    $group    = "";
    $mirror_1 = array(explode(PHP_EOL, $links));
    $postdata = http_build_query(array(
        "fn"          => "containerV2",
        "sub"         => "create",
        "api_key"     => $api_key,
        "name"        => $name,
        "mirror_1"    => $mirror_1,
        "captcha"     => YES,
        "allow_cnl"   => YES,
        "allow_dlc"   => YES,
        "allow_links" => YES,
        "group"       => $group,
    ));
    $opts = array('http' => array(
        "method"  => "POST",
        'header'  => "Connection: close\r\n" .
        "Content-type: application/x-www-form-urlencoded\r\n" .
        "Content-Length: " . strlen($postdata) . "\r\n",
        "content" => $postdata,
    ));
    $context = stream_context_create($opts);
    $result  = file_get_contents('http' . (($USE_SSL) ? 's' : '') . '://www.filecrypt.cc/api.php', false, $context);
    if (!$result) {
        throw new Exception("filecrypt.cc api down");
    } else {
        $json    = json_decode($result);
        $fc_link = $json->container->link;
        $fc_simg = $json->container->bigimg;
    }

    $fc_array = array(
        $fc_link,
        $fc_simg,
    );
    return ($fc_array);
}