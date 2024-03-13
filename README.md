# Desafio Vesti

### Rodar os seguintes comandos abaixo:
 
- cp .env.example .env
- docker compose up -d
- docker compose run products-service php artisan migrate

#### Endpoints para cadastro de produtos e variações dos mesmos

- [POST] http://localhost:8000/api/produtos
- [POST] http://localhost:8000/api/variacoes

Utilizando os arquivos json disponibilizados no teste será possível realizar o cadastro.

#### Para integrar os produtos e suas variações cadastrados nesse sistema com a api da Vesti, rodar o comando a seguir:

- docker compose run products-service php artisan app:integrar-produtos-variacoes 
