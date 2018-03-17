$verzeichnis = "beispiel/"; 
$zip_name = "beispiel.zip"; 

// Verzeichnis auslesen 
$dateien = array_slice(scanDir($verzeichnis), 2); 

// Neue Instanz der ZipArchive Klasse erzeugen 
$zip = new ZipArchive; 

// Überprüfen ob die Datei bereits existiert 
if (!file_exists($zip_name)) { 
 // Zip-Archiv erstellen 
 $status = $zip->open($zip_name, ZipArchive::CREATE); 
} 
else { 
 // Zip-Archiv überschreiben 
 $status = $zip->open($zip_name, ZipArchive::OVERWRITE); 
} 

if ($status) { 

 // Dateien ins Zip-Archiv einfügen 
 foreach ($dateien as $datei) { 
  $zip->addFile($verzeichnis . $datei, $datei); 
 } 

// Zip-Archiv schließen 
 $zip->close(); 

 if (file_exists($zip_name)) { 

  // Dateigröße ermitteln 
  $info = stat($zip_name); 
  echo '<p><a href="' . $zip_name . '">' . $zip_name . '</a> - ' . 
  number_format(round($info["size"] / 1024 ,1), 2, ",", ".") .' KB</p>'; 
 } 
}  