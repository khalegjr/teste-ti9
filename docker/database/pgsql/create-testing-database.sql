SELECT 'CREATE DATABASE teste_ti9'
WHERE NOT EXISTS (SELECT FROM pg_database WHERE datname = 'teste_ti9')\gexec
