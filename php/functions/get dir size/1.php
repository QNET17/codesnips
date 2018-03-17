function get_dir_size($dir) {
  $size = 0;
  $dir = (!preg_match("#/$#", $dir)) ? $dir."/" : $dir;
  $handle = @opendir($dir);
  while ($file = @readdir($handle)) {
    if (preg_match("/^\.{1,2}$/",$file)) {
      continue;
    }
    $size += (is_dir($dir.$file)) ? get_dir_size($dir.$file."/") : filesize($dir.$file);
  }
  @closedir($handle);
  return $size;
}