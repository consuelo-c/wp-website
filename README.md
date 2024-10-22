# Sitio en WordPress de Banquetes Consuelo C

## Install

> [!WARNING]
> Change the **username** and IP of the server in the following commands

```bash
ssh consueloc@10.10.0.1 wp --path=/home/master/applications/ypjwgcuzrw/public_html db export - > db-dump-`date +%Y%m%d`.sql
lando start
lando wp db import db-dump-`date +%Y%m%d`.sql
lando wp search-replace https://consueloc.com https://consueloc.lndo.site --all-tables
lando wp cache flush
rsync -avz -e ssh consueloc@10.10.0.1:/home/master/applications/ypjwgcuzrw/public_html/wp-content/uploads/ wp-content/uploads
```

## Reset environment

> [!WARNING]
> Keep the list if required plugins up to date in `bin/lando-wordpress-provision.sh`

```bash
# Use the real username and password
ssh consueloc@10.10.0.1 wp --path=/home/master/applications/ypjwgcuzrw/public_html db export - > db-dump-`date +%Y%m%d`.sql
lando destroy -y
bash bin/reset-workspace.sh
lando start
lando wp db import db-dump-`date +%Y%m%d`.sql
lando wp search-replace https://consueloc.com https://consueloc.lndo.site --all-tables
lando wp cache flush
rsync -avz -e ssh consueloc@10.10.0.1:/home/master/applications/ypjwgcuzrw/public_html/wp-content/uploads/ wp-content/uploads
```

## Update plugin list

```bash
ssh consueloc@10.10.0.1 wp --path=/home/master/applications/ypjwgcuzrw/public_html plugin list --fields=name
# Update the lando-wordpress-provision.sh script with the output
```
