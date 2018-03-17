function format_file_size($file_size = 0) {
  //$file_size = intval($file_size);
  if (!$file_size) {
    return "n/a";
  }
  if (strlen($file_size) <= 9 && strlen($file_size) >= 7) {
    $file_size = number_format($file_size / 1048576,1);
    return $file_size."&nbsp;MB";
  }
  elseif (strlen($file_size) >= 10) {
    $file_size = number_format($file_size / 1073741824,1);
    return $file_size."&nbsp;GB";
  }
  else {
    $file_size = number_format($file_size / 1024,1);
    return $file_size."&nbsp;KB";
  }
}