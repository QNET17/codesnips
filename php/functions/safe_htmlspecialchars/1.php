function safe_htmlspecialchars($chars) {
  // Translate all non-unicode entities
  $chars = preg_replace(
    '/&(?!(#[0-9]+|[a-z]+);)/si',
    '&amp;',
    $chars
  );

  $chars = str_replace(">", "&gt;",   $chars);
  $chars = str_replace("<", "&lt;",   $chars);
  $chars = str_replace('"', "&quot;", $chars);
  return $chars;
}