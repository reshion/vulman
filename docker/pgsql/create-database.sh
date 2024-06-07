#!/bin/bash
set -e

export PGPASSWORD=$POSTGRES_PASSWORD
echo "sleeping for 5s"
sleep 5s
echo "waiking up"

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" <<-EOSQL
    SELECT 'CREATE DATABASE $POSTGRES_DATABASE'
    WHERE NOT EXISTS (SELECT FROM pg_database WHERE datname = '$POSTGRES_DATABASE')\gexec
EOSQL



