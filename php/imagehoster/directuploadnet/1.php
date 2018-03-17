function directUpload($tmp)
{
    $image       = file_get_contents($tmp);
    $conf['url'] = 'http://www.directupload.net/index.php?mode=upload&image_link=' . $tmp;
    /* do some curl magic */
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $conf['url']);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:53.0) Gecko/20100101 Firefox/53.0");
    $content = curl_exec($ch);
    curl_close($ch);
    $grab['image'] = @get_match('/\[URL=http:\/\/www\.directupload\.net]\[IMG](.*?)\[\/IMG]\[\/URL]/s', $content);
    return $grab['image'];
}