/*
    create directory tree recursively
    backward compatibility for php4
*/
function _mkdir($dir, $chmod = CHMOD_DIRS)
{
	if (is_dir($dir) || @mkdir($dir, $chmod)) return true;
	if (!_mkdir(dirname($dir), $chmod)) return false;
	return @mkdir($dir, $chmod);
}