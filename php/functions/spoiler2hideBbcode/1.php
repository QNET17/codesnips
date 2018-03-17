function tag_fixer($code, $site)
{

    switch ($site) {
        case 'nydus':
            $preg_find = array(
                "/\[B\]NFO:\[\/B\](.+?)\[spoiler\]\[(.+?)\](.+?)\[\/(.+?)\]\[\/spoiler\]/is",
            );
            $preg_replace = array(
                "[B]NFO:[/B]$1[spoiler][nfo]$3[/nfo][/spoiler]",
            );
            $str_find = array(
                "[spoiler]",
                "[/spoiler]",
            );
            $str_replace = array(
                "[hide]",
                "[/hide]",
            );
            break;
    }

    $body = preg_replace($preg_find, $preg_replace, $code);
    $body = str_replace($str_find, $str_replace, $body);
    return $body;
}