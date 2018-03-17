function crypter_name($crypter)
{
    preg_match_all('/(www\.)?(share-links|filecrypt|relink|ncrypt)\.(biz|cc|to|us|in?)/', $crypter, $matches, PREG_SET_ORDER, 0);
    if ($matches[0][0] == "www.filecrypt.cc") {
        $cryptername = "FileCrypt.cc";
    } elseif ($matches[0][0] == "share-links.biz") {
        $cryptername = "Share-Links.biz";
    } elseif ($matches[0][0] == "relink.us") {
        $cryptername = "Relink.us";
    } elseif ($matches[0][0] == "relink.to") {
        $cryptername = "Relink.to";
    } elseif ($matches[0][0] == "ncrypt.in") {
        $cryptername = "nCrypt.in";
    }

    $out = $cryptername;
    return $cryptername;
}