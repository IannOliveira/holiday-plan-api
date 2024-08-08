# Holiday Plan API

## Setup

1. Clone o repositório
2. Instale as dependências
 ```bash
    Composer install
 ``` 
3. Configure o arquivo `.env`(ou faça a cópia do arquivo `.env.example`) e crie um banco de dados com o nome `plan`.


4. Execute as migrations
 ```bash
    php artisan migrate
 ```  
 ```bash
    php artisan migrate --seed
 ``` 

5. Gerar as chaves
```bash
    php artisan key:generate
 ```  
6. Inicie o servidor
```bash
    php artisan serve
 ``` 

7. Endpoints
 
```- GET /api/me: Verifica se o usuário está autenticado ou não```

```- POST /api/login: Realiza a requisição de login, exigindo 'email' e 'password' para autenticação```

```- POST /api/logout: Realiza o logout do usuário logado```

```- POST /api/register: Realiza o cadastro de um novo usuário```

```- POST /api/holiday-plans: Criar um novo plano de férias```

```- GET /api/holiday-plans: Recuperar todos os planos de férias```

```- GET /api/holiday-plans/{id}: Recuperar um plano de férias específico```

```- PUT /api/holiday-plans/{id}: Atualizar um plano de férias existente```

```- DELETE /api/holiday-plans/{id}: Deletar um plano de férias```

```- GET /api/holiday-plans/{id}/pdf: Gerar PDF de um plano de férias```

8. Testes

Execute os testes com:
```bash
    php artisan test
 ``` 
