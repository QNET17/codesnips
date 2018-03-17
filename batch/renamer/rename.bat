@echo off

for /r "%cd%" %%g in (*.txt) do rename "%%g" "%%~ng.php"

pause
exit