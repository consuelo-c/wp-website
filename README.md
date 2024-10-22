# Sitio en WordPress de Banquetes Consuelo C

<!-- markdownlint-disable line-length -->

## Configurar acceso remoto con `wp`

Para ejecutar el comándo `wp` de manera remota, es nesario primero [configurar](https://make.wordpress.org/cli/handbook/references/config/#config-files) `wp-cli`:

```bash
cp wp-cli.yml wp-cli.local.yml
# Configure los path y el valor de SSH
```

## Ambiente de desarrollo

```bash
wp @prod db export - > db-dump-`date +%Y%m%d`.sql
lando start
lando wp db import db-dump-`date +%Y%m%d`.sql
lando wp search-replace https://consueloc.com https://consueloc.lndo.site --all-tables
lando wp cache flush
```

> [!NOTE]
> El guión (`-`) en el primer comando es para que la salida pueda ser redirigida

De manera **opcional**, puede descargar los archivos que están en `uploads/` con

```bash
rsync -avz -e ssh consueloc@10.10.0.1:/home/master/applications/ypjwgcuzrw/public_html/wp-content/uploads/ wp-content/uploads
```

## Reiniciar el ambiente de desarrollo

```bash
lando destroy -y
bash bin/reset-workspace.sh
lando start
lando wp db import db-dump-`date +%Y%m%d`.sql
lando wp search-replace https://consueloc.com https://consueloc.lndo.site --all-tables
lando wp cache flush
```

## Obtener la lista de plugins que está en PROD

Util para mantner la lista la lista `PLUGINS` que se encuentra en [`bin/lando-wordpress-provision.sh`](bin/lando-wordpress-provision.sh) actualizada

```bash
wp @prod plugin list --fields=name --format=csv --status=active
```

<!-- setlocal spell spelllang=es_ES -->
