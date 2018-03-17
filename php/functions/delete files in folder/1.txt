function deleteFilesFromDirectory($ordnername) 
{ 
    if (is_dir($ordnername)) { 
        if ($dh = opendir($ordnername)) { 
            while (($file = readdir($dh)) !== false) { 
                if ($file != "." AND $file != "..") { 
                    unlink("" . $ordnername . "" . $file . ""); 
                } 
            } 

            closedir($dh); 
        } 
    } 
}  