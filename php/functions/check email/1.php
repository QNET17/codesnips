function check_email($email) 
{ 
    return (preg_match('/^[-!#$%&\'*+\\.\/0-9=?A-Z^_`{|}~]+@([-0-9A-Z]+\.)+([0-9A-Z]){2,}$/i', $email)) ? 1 : 0; 
}  