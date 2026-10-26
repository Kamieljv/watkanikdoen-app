#!/bin/sh
# Runs once, when the mysql data volume is first created.
# Creates the database that phpunit.xml points at, so tests never touch the dev database.
mysql -uroot -p"$MYSQL_ROOT_PASSWORD" <<SQL
CREATE DATABASE IF NOT EXISTS watkanikdoen_test;
GRANT ALL ON watkanikdoen_test.* TO '$MYSQL_USER'@'%';
FLUSH PRIVILEGES;
SQL
