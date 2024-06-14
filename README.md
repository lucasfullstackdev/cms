<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<h1 align="center">CMS</h1>
<h4 align="center">Uma API REST para criação de conteúdo</h4>

## Sobre o projeto
Este projeto tem como finalidade atestar meus conhecimentos nos seguintes pontos:

- [Docker](https://www.docker.com/)
- Laravel [Sail](https://laravel.com/docs/11.x/sail)  
- Desenvolvimento de aplicações [PHP 8.x](https://www.php.net/releases/8.3/en.php)
- Desenvolvimento de API's REST utilizando [Laravel 11,x](https://laravel.com/docs/11.x)
- Laravel [Sanctum](https://laravel.com/docs/11.x/sanctum)
- ORM [Eloquent](https://orkhan.gitbook.io/typeorm/)
- [Middleware](https://laravel.com/docs/11.x/middleware)
- Processamento em background | [Jobs](https://laravel.com/docs/11.x/queues#creating-jobs)
- Arquitetura [DDD](https://medium.com/cwi-software/domain-driven-design-do-in%C3%ADcio-ao-c%C3%B3digo-569b23cb3d47)
- Implementação de Camadas:
	- [Repository](https://renicius-pagotto.medium.com/entendendo-o-repository-pattern-fcdd0c36b63b)
	- [Service](https://davislevine.medium.com/service-design-patterns-930203c8df37)
	- [Dto](https://medium.com/@orcunyilmazoy/the-dto-pattern-data-transfer-objects-8146b262636e)

## Por que este projeto?
- Este projeto faz parte do meu portfólio pessoal, uma maneira de comprovar meus conhecimentos em [Laravel](https://laravel.com).
- A construção de API's faz parte da rotina de um desenvolvedor back-end, então esse projeto serviu como uma simulação da rotina real de um desenvolvedor back-end atuando com [Laravel](https://laravel.com).

## Sobre a modelagem do Banco de Dados
- O desafio consistia na construção de uma API REST utilizando Laravel que permitisse o gerenciamento de publicações de um CMS como o WordPress
- Para o desafio foram criadas as seguintes tabelas:
	
| Table | Description | Values |
| ------------| --- | -- |
| post_statuses| Contêm todos os status possíveis para uma publicação | Published, Draft, Pending Review, Scheduled,Archived |
| posts| Contêm todos as publicações |  |
| tags | Contêm as tags possíveis para uma publicação | Organization, Planning, Collaboration, Writing, Calendar, API, JSON, Schema, Node, GitHub, REST |
| roles | Contêm os níveis de acessos permitidos | Admin, Writter, Viewer |

<br>

## Sobre as Rotas
### Organização de rotas
As rotas estão organizadas e seguimentadas por versão (1x) e domínios da aplicação. O objetivo aqui é dar maior flexibilidade e desacoplamento entre as rotas facilitando assim a manutenção e expansão.
As rotas estão separadas em:
- Rotas para autenticação :red_circle:
- Rotas da API v1
	- Dominios da aplicação :large_blue_circle: :
		- Rotas Administrativas :green_circle: :
			- Tags
			- Status das publicações
		- Comuns :purple_circle: :
			- Publicações

<p align="center">
    <img src="https://github.com/lucasfullstackdev/cms/blob/develop/README/organizacao-das-rotas.jpeg" width="900">
</p>

### Autenticação
<hr>

<details>
  <summary>Login</summary>

```php
Method: GET
Url: /api/auth/login
- Payload:
# ADMIN
{
	"email": "contato@jellycode.com.br",
	"password": "OtYxBR8ynhLp6Pd"
}
```

```php
Method: GET
Url: /api/auth/login
- Payload:
# WRITTER
{
	"email": "lucas@jellycode.com.br",
	"password": "123456"
}
```

```php
Method: GET
Url: /api/auth/login
- Payload:
# VIEWER
{
	"email": "filipe@jellycode.com.br",
	"password": "123456"
}
```
</details>

<details>
  <summary>Me</summary>

```php
Method: GET
Authorization: 
- Auth Type: Bearer Token
- Token: Bearer {{token}}

Url: /api/auth/me
```
</details>

<details>
  <summary>Deslogar</summary>

```php
Method: GET
Authorization: 
- Auth Type: Bearer Token
- Token: Bearer {{token}}

Url: /api/auth/logout
```
</details>

<details>
  <summary>Deslogar de todos os dispositivos</summary>

```php
Method: GET
Authorization: 
- Auth Type: Bearer Token
- Token: Bearer {{token}}

Url: /api/auth/logout/all
```
</details>


### Rotas Administrativas
<hr>

Estas rotas são protegidas por um middleware (*AdminAcess*) para garantir que apenas e somente usuários administrativos consigam acessar; tal regra é importante pois aqui lidamos com tabelas auxiliares (ou de configuração) do sistema.
Por tanto será necessário utilizar um usuário administrador.

#### Tags
<details>
  <summary>Listar Todos</summary>

```php
Method: GET
Url: /api/v1/admin/tags
```
</details>

<details>
  <summary>Listar uma Tag específica</summary>

```php
Method: GET
Url: /api/v1/admin/tags/{id}
```
</details>


<details>
  <summary>Adicionar uma nova Tag</summary>

```php
Method: POST
Url: /api/v1/admin/tags

- payload:
{
    "name": "name of tag",
    "active": true
}
```
</details>

<details>
  <summary>Atualizar uma Tag</summary>

```php
Method: PUT/PATCH
Url: /api/v1/admin/tags/{id}

- Payload:
{
    "name": "biscoito 2 - 1 ",
    "active": false
}
```
</details>

<details>
  <summary>Remover uma Tag</summary>

```php
Method: DELETE
Url: /api/v1/admin/tags/{id}
```
</details>

<details>
  <summary>Inativar uma Tag</summary>

```php
Method: PATCH
Url: /api/v1/admin/tags/{id}/inactivate
```
</details>

<details>
  <summary>Ativar uma Tag</summary>

```php
Method: PATCH
Url: /api/v1/admin/tags/{id}/activate
```
</details>

#### Status das Publicações

<details>
  <summary>Listar todos os Status</summary>
  
```php
Method: GET
Url: /api/v1/admin/post/statuses
```
</details>

<details>
  <summary>Listar  Status específico</summary>
  
```php
Method: GET
Url: /api/v1/post/statuses/{id}
```
</details>

<details>
  <summary>Adicionar um novo Status</summary>

```php
Method: POST
Url: /api/v1/post/statuses

- Payload:
{
    "name": "name of status - 2"
}
```
</details>

<details>
  <summary>Atualizar um Status</summary>

```php
Method: PUT/PATCH
Url: /api/v1/post/statuses/{id}

- Payload:
{
    "name": "name of status - 2"
}
```
</details>

<details>
  <summary>Remover um Status</summary>

```php
Method: DELETE
Url: /api/v1/post/statuses/{id}
```
</details>

<br>

### Rotas Comuns

<hr>

Estas rotas podem ser acessadas por qualquer usuário devidamente autenticado, porém existem restrições para o usuário com nível de acesso VIEWER, segue a distribuição de rotas por níveis de acesso: 
- ADMIN: Acesso total
- WRITTER: 
	- Pode Listar as publicações :red_circle:
	- Pode Criar uma nova publicação :green_circle:
	- Só Pode remover uma publicação que ele mesmo criou :large_blue_circle:
    - Só Pode Editar uma publicação que ele mesmo criou :purple_circle:
-  VIEWER:
	- Apenas consegue listar as publicações :red_circle:

<p align="center">
    <img src="https://github.com/lucasfullstackdev/cms/blob/develop/README/middlewares.jpeg" width="900">
</p>

#### Publicações

<details>
  <summary>Listar todas as publicações</summary>

```php
Method: GET
Url: /api/v1/posts
```
</details>

<details>
  <summary>Listar uma publicação específica</summary>

```php
Method: GET
Url: /api/v1/posts/{id}
```
</details>

<details>
  <summary>Adicionar uma nova publicação</summary>

```php
Method: POST
Url: /api/v1/posts

- Payload:
{
    "title": "Espaço Reservado para o título da publicação",
    "content": "Local app manager. Start apps within your browser, developer tool with local .localhost domain and https out of the box.",
    "status_id": 1, // Published
    "tags": [
        2,
        3,
        5
    ]
}
```
</details>

<details>
  <summary>Agendar Publicação da Postagem</summary>
  <p>Caso você queria que a publicação (Post) não seja diretamente publicada, você consegue fazer o agendamento para que a API faça a publicação no tempo definido.</p>

```php
Method: POST
Url: /api/v1/posts

- Payload:
{
    "title": "Espaço Reservado para o título da publicação",
    "content": "Local app manager. Start apps within your browser, developer tool with local .localhost domain and https out of the box.",
    "status_id": 4,
    "publish_at": "2025-06-14 00:20:26",
    "tags": [
        2,
        3,
        5
    ]
}
```
</details>

<details>
  <summary>Atualizar uma Publicação</summary>

```php
Method: PUT/PATCH
Url: /api/v1/posts/{id}

- Payload:
{
	"title": "este é o nome do título do site - 38 -",
	"content": "Local app manager. Start apps within your browser, developer tool with local .localhost domain and https out of the box.",
	"status_id": 1,
	"tags": [
		3,
		4
	]
}
```
</details>

<details>
  <summary>Remover uma Publicação</summary>

```php
Method: DELETE
Url: /api/v1/posts/{id}
```
</details>

<br>

## Setup
1. Clone o repositório
2. Acesse a raíz do projeto
3. Instale as dependências:

```bash
$ composer install
```

4. Uma vez que as dependências tenham sido devidamente intaladas, você precisa configurar as variáveis de ambiente:

```bash
$ cp .env.example .env
```

5. Suba os containers com [Sail](https://laravel.com/docs/11.x/sail):

```bash
$ ./vendor/bin/sail up -d
```

6. Acesse o container e execute as migrations:

```bash
$ php artisan migrate
```

7. O projeto deve estar disponível no endereco: [localhost/](http://localhost/) 

<br>

## Observações importantes
- É aconselhável que você tenha em sua máquina o [postman](https://www.postman.com/) para que possa fazer os devidos testes sobre as rotas disponíveis nesta API.
- Tenha as collections necessárias para testar [clicando aqui](https://github.com/lucasfullstackdev/cms/blob/develop/README/cms-collection.json)

## Dependências e suas versões
- [PHP 8.x](https://nodejs.org/en)
- [Laravel 11.x](https://www.npmjs.com/)
- [MySQL](https://www.mysql.com/)
- [Docker Engine](https://docs.docker.com/engine/all/)
- [Postman](https://www.postman.com/)

## Considerações finais
- API ainda poderá passar por alterações, esta API não representa uma amostra real, devendo ser utilizada apenas para se ter uma noção sobre como funciona um API REST.
- Qualquer dúvida ou sugestão, entre em contato pelo e-mail: contato@jellycode.com.br
