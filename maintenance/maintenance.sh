
BACKUP_DIR=/srv/backup/

/usr/bin/pg_dump -h 127.0.0.1 -U sherwint_sherwin -c sherwint_eshop > $BACKUP_DIR"sherwint_eshop-"`date +\%Y-\%m-\%d-\%H-\%M`.sql
