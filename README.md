# Escopo e objetivo

Desafio técnico BackEnd.

Sistema de indicação de amigos. Permite indicações, listas, alterar status, editar e remover.

O projeto inclui:

(a) Laravel

(b) VueJs

## Baixar, instalar e rodar aplicação:

- `git clone https://github.com/thiagostudier/indique-um-amigo`
- `cd indique-um-amigo`

#### Backend

- `cd backend`
- `composer install`

> _Obs: Criar arquivo ".env" e configurar variáveis de ambiente (DATABASE e MAIL)

- `php artisan key:generate` - criar chave da aplicação

- `php artisan migrate`
- `php artisan db:seed`
- `php artisan serve`

O Serviço rodará na porta 8000: localhost:8000/

#### Frontend

- `cd frontend`
- `npm install`
- `npm run dev`

O Serviço rodará na porta 8080: localhost:8080/

## Bibliotecas e comandos utilizados no desenvolvimento

#### Frontend

```
$ vue init webpack frontend //CRIAR PROJETO FRONTEND
$ npm i -S vue-the-mask //BIBLIOTECA DE INPUT MASK
$ npm i axios //PARA TRABALHAR COM A API BACKEND
$ npm i vue-notification //BIBLIOTECA DE NOTIFICAÇÕES JS
```

#### Backend

```
$ composer global require laravel/installer //INSTALAR LARAVEL
$ laravel new backend //CRIAR PROJETO LARAVEL

//CRIAR MODELS/CONTROLLERS/MIGRATES
$ php artisan make:model Indication -c -m
$ php artisan make:model Status -m

//CRIAR INTERFACE PARA A API
$ php artisan make:resource IndicationCollection

//CRIAR SEEDERS
$ php artisan make:seeder UserSeeder
$ php artisan db:seed

//INSTALAR VALIDADORES BR
$ composer require laravellegends/pt-br-validator

//CRIAR VALIDADOR | REQUESTS
$ php artisan make:request IndicationRequest

//CRIAR SEEDERS DOS STATUS
$ php artisan make:seeder StatusSeeder 
$ php artisan db:seed

```
