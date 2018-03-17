function un_htmlspecialchars($text) {
  $text = str_replace(
    array('&lt;', '&gt;', '&quot;', '&amp;'),
    array('<',    '>',    '"',      '&'),
    $text
  );

  return $text;
}