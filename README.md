# Teste - Biblio

## Sobre

Projeto teste para **Ti.9**, desenvolvido em **Laravel 10**, com **PHP 8.2**, **MySQL 8.0** e **Tailwindcss** como framework
CSS do frontend.


## Preparar Ambiente

Para rodar o projeto com **Docker** pode seguir os seguintes passos, após clonar e entrar na pasta do projeto:

- preparar ambiente **Docker**

```bash
cp .env.example .env

# alterar variáveis de ambiente, se desejar

docker-compose up -d --build

docker-compose exec laravel.test composer install

docker-compose down --remove-orphans
```


- Opcionalmente, se estiver em um ambiente _Linux_ ou _WSL2_, pode criar um atalho
no bash para facilitar o uso do pacote `sail` do **Laravel**:
```bash
alias sail="./vendor/bin/sail"
```


- A porta padrão do projeto é a `80`, para alterar basta adicionar a variável
`APP_PORT` no arquivo `.env` e setar a porta desejada. Após isso, para rodar a
aplicação:

```bash
sail up -d

sail npm install

sail artisan key:generate

sail artisan migrate --seed

sail npm run dev
```
