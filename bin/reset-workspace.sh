#!/bin/bash


echo "This script will remove all WordPress Core files, as all plugins and themes except for the theme consueloc-2024 and the uploads folder"
echo "YOU HAVE TO STOP Lando FIRST!"
echo -n "Continue (N/y)? "

CONTINUE="n"

read -n1 -r CONTINUE;

if [ "${CONTINUE}" != "y" ] && [ "${CONTINUE}" != "Y" ] || [ "${CONTINUE}" == "" ]; then
  echo "Exiting"
  exit;
fi

rm -rf wp-admin wp-includes license.txt readme.html index.php wp-*.php xmlrpc.php wp-config.php
find wp-content ! -name wp-content ! -name consueloc-2024 ! -name uploads -exec rm -rf {} \;

