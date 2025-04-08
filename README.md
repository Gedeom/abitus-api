# Projeto prático para o Processo Seletivo SEPLAG/2025

Candidato: Gedeom Anastácio de Souza<br>
CPF: 02205682601<br>

- Inscrição: 9956 - Perfil: DESENVOLVEDOR PHP - SÊNIOR
- Inscrição: 9981 - Perfil: DESENVOLVEDOR PHP - PLENO
<br>

## Projeto API REST em PHP Laravel + base de dados postgreSQL + Docker Compose.
Este repositório contém um projeto com uma solução que será utilizado exclusivamente para uma avaliação de processo seletivo da SEPLAG.
<br>

### 🛠 Tecnologias

#### As seguintes ferramentas foram usadas na construção do projeto:
- PHP 8+
- Laravel 11+
- PostgreSQL
- MinIO (armazenamento das fotos)
- Docker e Docker Compose
<br>

### 🛠 Pré-requisitos
- <a href="https://git-scm.com/downloads">GIT</a> instalado para baixar o projeto
- <a href="https://www.docker.com/products/docker-desktop/">Docker</a> Desktop instalado
- <a href="https://getcomposer.org/">Composer</a> (dependências do PHP Laravel)

### Faça o Clone do Projeto
#### O projeto encontra-se no GIT na branch master, execute o comando para baixar:
```bash
git clone https://github.com/Gedeom/abitus-api.git
```

#### Navegue até o diretório onde realizou o clone do projeto
`cd abitus-api`
<br>

#### Na raíz do projeto já estão os arquivos de configurações
`.env`
`Dockerfile`
`docker-compose.yml`
<br>

#### Instale as dependências do PHP Laravel
```bash
docker exec app composer install
```
<br>

Verifica se já existe Containers instalados
```bash
docker ps -a
```
<br>

### 🏗️ Configurando o ambiente
#### Os arquivos (Dockerfile e docker-compose.yml) estão configurados para instanciar e subir os containers:
- abitus-api
- nginx
- redis
- postgres
- minio_server

#### Suas respectivas imagens
- abitus-api
- nginx
- redis
- postgres
- minio/minio
<br>

Desta forma, basta acessar a raiz do projeto pelo terminal e executar o comando:
```bash
docker compose up -d --build
```

Aguarde a instalação e configurações dos contaniers, após instalado, confirme a instalação executando novamente o comando:
```bash
docker ps -a
```

### Caso precise excluir tudo para refazer o processo:
```bash
docker compose down
```

### Exclui informações de cache:
```bash
docker system prune
```

### Confirme exclusão de cache de container:
```bash
docker container prune -f
```
<br>

### 🗄️ Configurando o banco de dados no container
Após a confirmação dos containers instalados com suas respectivas imagens, para garantir que tudo esteja funcionando, execute as migrations dentro do contaniner (api-seletivo-seplag)
```bash
docker compose exec app php artisan migrate:fresh
docker compose exec app php artisan migrate:fresh --env=testing
```
<br>

Execute o comando abaixo para inserir o usuário padrão
```bash
docker exec app php artisan db:seed
```

Para executar os tetes unitários execute o comando abaixo
```bash
docker docker compose exec app php artisan test
```


### 🧪 Testando a API
Para verificar a documentação e realizar os teste, basta acessar pelo navegador:

[Documentação Completa](https://documenter.getpostman.com/view/3124163/2sB2cX9goB)


É necessário realizar a Autenticação no endpoint `/api/login`.
```bash
http://localhost:8888/api/login
```
- 📧 **Email:** `admin@email.com`
- 🔑 **Senha:** `12345678`


- Execute e será gerado o TOKEN. Copie e cole em Bearer Token no POSTMAN ou software de sua preferência.
- Após esta ação é possível realizar os testes. Tempo do token expira em 5 minutos.
- Para renovar o token, utilize o serviço /api/refresh. Copie e cole o novo token na opção Authorize.
<br>

### Para verificar os arquivos publicados no MinIO, acesse:
```bash
http://localhost:9091/login
```

- 📧 **Username:** `minio`
- 🔑 **Senha:** `miniostorage`
- Após acessar e logar no MinIO, crie o bucket "mybucket", assim as fotos serão publicadas neste bucket.

<br>

