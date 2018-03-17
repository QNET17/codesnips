function replace_url($text) {
  $text = " ".$text." ";
  $url_search_array = array(
    "#([^]_a-z0-9-=\"'\/])www\.([a-z0-9\-]+)\.([a-z0-9\-.\~]+)((?:/[^, \(\)<>\n\r]*)?)#si",
    "#([^]_a-z0-9-=\"'\/])([a-z]+?)://([^, \(\)<>\n\r]+)#si"
  );

  $url_replace_array = array(
    "\\1<a href=\"http://www.\\2.\\3\\4\" target=\"_blank\" rel=\"nofollow\">www.\\2.\\3\\4</a>",
    "\\1<a href=\"\\2://\\3\" target=\"_blank\" rel=\"nofollow\">\\2://\\3</a>",
  );
  $text = preg_replace($url_search_array, $url_replace_array, $text);

  if (strpos($text, "@")) {
    $text = preg_replace("#([\n ])([a-z0-9\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)?[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $text);
  }
  return substr($text, 1, -1);
}