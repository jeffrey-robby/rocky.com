@echo off
setlocal

rem Chemin vers le dossier XAMPP
set "URL=http://192.168.1.135/rocky.com"  rem Remplacer par l'URL de ton projet

rem Ouvrir l'URL dans le navigateur par défaut
start "" "%URL%"

rem Attendre quelques secondes avant de fermer le panneau de contrôle
timeout /t 4 >nul  rem Attendre 10 secondes

endlocal
exit