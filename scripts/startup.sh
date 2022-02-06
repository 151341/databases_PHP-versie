#!/bin/bash
# Startup script to initialize the repository
bold=$(tput bold)
normal=$(tput sgr0)
figlet Databases
echo "\n${bold}Databases Module met PHP en MySQL"
echo "${normal}Deze repository is voor je klaargezet door ${bold}Rijk van Putten${normal} 😃\n"

echo "Even geduld graag terwijl de volgende dingen worden voorbereid:"
echo "(1/4) Apache HTTP server starten.."               
./scripts/start_apache.sh > /dev/null

echo "(2/4) MySQL server starten.."               
./scripts/start_mysql.sh > /dev/null

echo "(3/4) phpMyAdmin installeren.."               
./scripts/install_phpmyadmin.sh > /dev/null 2>&1

echo "(4/4) SQL Querier installeren en opstarten.."
./scripts/init_querier.sh > /dev/null
pkill -f "querier"
node querier > /dev/null &

echo "Klaar! (hopelijk duurde het niet te lang)"

echo "\nJe Gitpod workspace is klaar voor gebruik!\nDruk op ${bold}http://localhost:8001${normal} om je websites te bekijken en op ${bold}http://localhost:1700${normal} om de SQL querier te gebruiken."
