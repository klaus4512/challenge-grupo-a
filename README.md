# GrupoA Educação - Full Stack Web Developer - Laravel

## Apis em Laravel

### Acessar servidor de exemplo do código

Para acessar uma base de exemplo com o codigo implementado 
nesse desafio vocês pode acessar o seguinte link:
(https://challenge-grupo-a-6bf43dc87ce4.herokuapp.com/)


### Rotas

#### GET /api/students
Retorna todos os estudantes cadastrados no banco de dados.

#### GET /api/students/{ra}
Retorna um estudante específico.

#### POST /api/students
Cria um novo estudante.

#### PUT /api/students/{ra}
Atualiza um estudante.

#### DELETE /api/students/{ra}
Deleta um estudante.


## Como executar o projeto

Copiar o arquivo .env.example para .env
```console
cp .env.example .env
```

- Rodar o seguinte comando para instalar os containers Docker
```console
docker compose build
```

- Rodar o seguinte comando para instalar as dependencias do projeto
```console
docker compose run --rm composer install 
```

- Para iniciar os containers, rodar o seguinte comando
```console
docker compose up -d
```

- O seguinte comando para rodar as migrations
```console
docker exec -t laravel_php php artisan migrate
```

- E por fim rodar o seguinte comando para gerar a chave do projeto
```console
sudo docker exec -t laravel_php php artisan key:generate
```

## Acessar o projeto

Acessar o projeto localmente pelo link: http://localhost:8000

## Testes

Para rodar os testes é necessario rodar o seguinte comando

```console
docker exec laravel_php php artisan test
```
