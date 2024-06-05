#!/bin/bash
set -e

export PGPASSWORD=$DB_PASSWORD

psql -v ON_ERROR_STOP=1 --username "$DB_USERNAME" --dbname "$DB_DATABASE" <<-EOSQL
    SELECT 'CREATE DATABASE "$DB_DATABASE"'
    WHERE NOT EXISTS (SELECT FROM pg_database WHERE datname = "$DB_DATABASE")
EOSQL