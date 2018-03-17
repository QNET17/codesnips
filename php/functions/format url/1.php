function format_url($url) {
  if (empty($url)) {
    return '';
  }

  if (!preg_match("/^https?:\/\//i", $url)) {
    $url = "http://".$url;
  }

  return htmlspecialchars($url);
}