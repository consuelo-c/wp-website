#!/bin/bash

# Provision script for WordPress installation when using Lando.
# This script is called from the .lando.yml file

# cSpell:ignore akismet appserver creds dbhost dbname dbpass dbuser getenv

# LANDO_INFO is a Json string with all the parameters.
DBNAME=$(php -r "echo json_decode(getenv('LANDO_INFO'), true)['database']['creds']['database'];")
DBUSER=$(php -r "echo json_decode(getenv('LANDO_INFO'), true)['database']['creds']['user'];")
DBPASS=$(php -r "echo json_decode(getenv('LANDO_INFO'), true)['database']['creds']['password'];")
APP_URL=$(php -r "echo json_decode(getenv('LANDO_INFO'), true)['appserver_nginx']['urls'][1];")

# Download and install WordPress.
wp core download --locale=es_CO --skip-content
wp config create --dbhost=database --dbname="${DBNAME}" --dbuser="${DBUSER}" --dbpass="${DBPASS}" --extra-php="
define( 'WP_DEBUG', true );
define( 'SCRIPT_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_REDIS_HOST', 'redis' );
"
wp core install --title="DEV ConsueloC" --url="${APP_URL}" --admin_user=admin --admin_password=password --admin_email=admin@example.com

# delete the default plugins
wp plugin delete akismet hello

# Development helpers
wp plugin install "redis-cache" --activate
wp plugin install "debug-bar" --activate
wp plugin install "create-block-theme" --activate

# The adds redis to the must-use plugins
wp redis enable

# Additional plugins
PLUGINS="
woo-checkout-field-editor-pro
business-profile
woocommerce-product-addon
redirection
woocommerce"

for plugin in ${PLUGINS}; do
  wp plugin install "${plugin}"
done

# Fix permalinks
wp option update permalink_structure "/%year%/%monthnum%/%postname%/"
