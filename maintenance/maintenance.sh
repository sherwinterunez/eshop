
PGDUMP=`which pg_dump`
TAR=`which tar`
BACKUP_DIR=/srv/backup/
CURDATE=`date +\%Y-\%m-\%d-\%H-\%M`
DBNAME=sherwint_eshop
IPADD=127.0.0.1
USERNAME=sherwint_sherwin
SQLFILE=$BACKUP_DIR$DBNAME"-"$CURDATE.sql
TGZFILE=$BACKUP_DIR$DBNAME"-"$CURDATE.sql.tgz
DOPG="$PGDUMP -h $IPADD -U $USERNAME -c $DBNAME > $SQLFILE"
DOTAR="$TAR czvf $TGZFILE $SQLFILE"
echo $DOPG
$DOPG
echo $DOTAR
$DOTAR
