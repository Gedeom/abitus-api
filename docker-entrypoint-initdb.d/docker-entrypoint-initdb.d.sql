-- Cria db_abitus se não existir
SELECT 'CREATE DATABASE db_abitus'
WHERE NOT EXISTS (
  SELECT FROM pg_database WHERE datname = 'db_abitus'
)\gexec

-- Cria db_abitus_test se não existir
SELECT 'CREATE DATABASE db_abitus_test'
WHERE NOT EXISTS (
  SELECT FROM pg_database WHERE datname = 'db_abitus_test'
)\gexec