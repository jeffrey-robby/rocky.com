@echo off
setlocal

rem Chemin vers le dossier XAMPP
set "XAMPP_DIR=C:\xampp"  rem Remplacer par le chemin de ton installation XAMPP
set "URL=http://localhost/rocky.com"  rem Remplacer par l'URL de ton projet

rem Vérifier si XAMPP Control Panel est en cours d'exécution
tasklist /FI "IMAGENAME eq xampp-control.exe" | find /I "xampp-control.exe" >nul
set "XAMPP_RUNNING=%ERRORLEVEL%"

rem Démarrer XAMPP Control Panel s'il n'est pas déjà en cours d'exécution
if %XAMPP_RUNNING% NEQ 0 (
    echo Démarrage de XAMPP Control Panel...
    start "" "C:\xampp\htdocs\rocky.com\lance_xampp.vbs"  rem Remplacer par le chemin de ton fichier VBS
    timeout /t 5 >nul  rem Attendre 5 secondes pour laisser le temps de démarrer
)

rem Ouvrir l'URL dans le navigateur par défaut
start "" "%URL%"

rem Attendre quelques secondes avant de fermer le panneau de contrôle
timeout /t 4 >nul  rem Attendre 10 secondes

rem Fermer le panneau de contrôle XAMPP
taskkill /F /IM "xampp-control.exe"

endlocal
exit