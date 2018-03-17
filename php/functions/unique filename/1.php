function create_unique_filename($base, $file)
{
  $ext = get_file_extension($file);
  $name = get_file_name($file);
  $n = 2;
  $copy = "";
  while (file_exists($base."/".$name.$copy.".".$ext)) {
    $copy = "_".$n;
    $n++;
  }
  return $name.$copy.".".$ext;
}

function get_file_extension($file_name) {
  if (preg_match("#(.+)\.(.+)#", get_basefile($file_name), $regs)) {
    return strtolower($regs[2]);
  }
  return false;
}

function get_basefile($path) {
  $basename = get_basename($path);
  preg_match("#(.+)\?(.+)#", $basename, $regs);
  return isset($regs[1]) ? $regs[1] : $basename;
}

function get_basename($path) {
  $path = str_replace("\\", "/", $path);
  $name = substr(strrchr($path, "/"), 1);
  return $name ? $name : $path;
}

function get_file_name($file_name) {
  if (preg_match("#(.+)\.(.+)#", get_basefile($file_name), $regs)) {
    return $regs[1];
  }
  return false;
}