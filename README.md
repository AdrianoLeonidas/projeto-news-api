# News API (Laravel) — Teste Técnico

Projeto desenvolvido como teste  de desenvolvedor back-end.

Consiste em uma **API REST em Laravel** com autenticação via **Sanctum**,  
CRUD completo de **categorias** e **notícias**, regras de **permissão com Policies**,  
**front-end simples em Blade** e **Command Artisan**.

---

# Tecnologias utilizadas

- PHP 8+
- Laravel 12
- MySQL (Laragon)
- Laravel Sanctum
- Blade (front-end simples)
- Faker + Seeders
- Artisan Commands

---

#  Instalação do projeto


cd news-api

 Instalar dependências:

composer install
npm install


 Configurar ambiente
Copie o .env:

cp .env.example .env
Gere a chave:

php artisan key:generate
Configure o banco no .env:

DB_DATABASE=news_api
DB_USERNAME=root
DB_PASSWORD=

 Rodar migrations + seeders
php artisan migrate --seed

 Build do front-end
npm run build

 Iniciar servidor
php artisan serve
Acessos:

Web → http://127.0.0.1:8000

API → http://127.0.0.1:8000/api

Autenticação (Sanctum)
Registro
POST /api/register

{
  "name": "Admin",
  "email": "admin@email.com",
  "password": "123456",
  "password_confirmation": "123456"
}
Login
POST /api/login

{
  "email": "admin@email.com",
  "password": "123456"
}
Resposta:

{
  "user": { ... },
  "token": "Bearer 1|xxxxx"
}
Usar no header:

Authorization: Bearer SEU_TOKEN
Logout
POST /api/logout
(requer autenticação)

 Endpoints de Categorias
Todas as rotas abaixo requerem auth:sanctum.

Método	Rota	Descrição
GET	/api/categories	Listar categorias
POST	/api/categories	Criar categoria
PUT	/api/categories/{id}	Atualizar
DELETE	/api/categories/{id}	Deletar
Body exemplo
{
  "name": "Tecnologia"
}
Endpoints de Notícias
CRUD completo protegido por auth:sanctum.

Método	Rota	Descrição
GET	/api/news	Listar com paginação e filtros
POST	/api/news	Criar notícia
GET	/api/news/{id}	Visualizar
PUT	/api/news/{id}	Atualizar
DELETE	/api/news/{id}	Deletar
Body exemplo (POST/PUT)
{
  "title": "Notícia teste",
  "tag": "Tech",
  "summary": "Resumo da notícia",
  "content": "Conteúdo completo da notícia",
  "category_id": 1
}
 Filtros disponíveis
GET /api/news?category_id=1&tag=Tech&title=teste
Paginação automática

Busca por categoria, tag e título

Permissões (Policies)
Apenas usuários autenticados podem:

criar

editar

deletar notícias

Usuário só pode alterar as próprias notícias.

Tentativas inválidas retornam 403 Forbidden.

Front-end (Blade)
Rotas principais:

/login → tela de login

/news → listagem com:

paginação

filtros

CRUD completo

Layout simples focado em funcionalidade.

Command Artisan
Atualiza o título de todas as notícias:

php artisan posts:update-title "Novo título"
Exibe no terminal:

OK! X notícias atualizadas.
Seeders
Executar:

php artisan db:seed

Usuário padrão criado:

email: admin@email.com
senha: 123456
