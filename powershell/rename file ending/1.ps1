get-childItem -recurse | Where {$_.extension -eq ".txt"} | rename-item -newname { $_.name -replace ".txt",".php" }