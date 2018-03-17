function randomName($length, $letters_only = false) 
{ 
    $str = ''; 
    if (!$letters_only) { 
        while (strlen($str) <= $length) { 
            $str.= md5(uniqid(rand() , true)); 
        } 

        return substr($str, 0, $length); 
    } 

    for ($i = 0; $i < $length; $i++) { 
        switch (mt_rand(1, 2)) { 
        case 1: 
            $str.= chr(mt_rand(65, 90)); 
            break; 

        case 2: 
            $str.= chr(mt_rand(97, 122)); 
            break; 
        } 
    } 

    return $str; 
}  