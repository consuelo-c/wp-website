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
for item in $(ls wp-content/ | grep -E -v "themes|uploads|plugins"); do
  rm -rf "wp-content/${item}"
done
for item in $(ls wp-content/themes/ | grep -E -v "dazzet-barebones|genesis"); do
  rm -rf "wp-content/themes/${item}"
done
for item in $(ls wp-content/plugins/ | grep -E -v "genesis-title-toggle|genesis-simple-edits|contact-form-submissions|rename-media-files"); do
  rm -rf "wp-content/plugins/${item}"
done
#ls wp-content/themes | egrep -v "consueloc.+" | xargs rm -rf

