@echo off

del /S /Q /F WDB

echo SET realmlist login.afkplayer.com > realmlist.wtf

ping localhost -n 2 >nul

start wow.exe
