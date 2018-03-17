/* GITHUB GISTS GENERATED BBCODE
------------------------------------------------------- */
function githubGist($code, $title, $hash, $generator)
{
    global $lang, $timestamp;
    $git_info = "
    Titel     : " . $title . "\n
    Erstell am: " . date("d.m.Y", $timestamp) . " um " . date("H:i", $timestamp) . " Uhr\n
    Generator : Simple Szene BBcode Generator: http://uranjtsu.xyz\n
    Variante  : " . $generator . "\n\n
    ";

    $data = json_encode([
        'description' => $title . ' | Gist erstellt mit Simple Szene BBcode Generator: http://uranjtsu.xyz',
        'public'      => 'false',
        'files'       => [
            '' . $hash . '.txt' => ['content' => $git_info . $code],
        ],
    ]);
    $url = "https://api.github.com/gists";
    $ch  = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
        ['User-Agent: php-curl']
    );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    $gist = json_decode($result, true);
    if ($gist) {
        $gistslink = $gist['html_url'];
    }
    return $gistslink;
}