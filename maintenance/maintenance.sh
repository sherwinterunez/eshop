
PGDUMP=`which pg_dump`
TAR=`which tar`
GZIP=`which gzip`
BACKUP_DIR=/srv/backup/
CURDATE=`date +\%Y-\%m-\%d-\%H-\%M`
DBNAME=sherwint_eshop
IPADD=127.0.0.1
USERNAME=sherwint_sherwin
SQLFILE=$BACKUP_DIR$DBNAME"-"$CURDATE.sql
TGZFILE=$SQLFILE.tgz
GZFILE=$SQLFILE.gz
DOPG="$PGDUMP -h $IPADD -U $USERNAME -c $DBNAME | $GZIP > $GZFILE"
DOTAR="$TAR czvf $TGZFILE $SQLFILE"
echo $DOPG
$PGDUMP -h $IPADD -U $USERNAME -c $DBNAME | $GZIP > $GZFILE
