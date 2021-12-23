## Tecnologias e versões

Foram utilizadas as seguintes tecnologias:

- PHP 7.4.6
- Laravel 8.77.1
- MySQL 5.7.31
- Composer 2.1.22
- NPM 6.14.8 (para instalação do bootstrap)

## Ao clonar repositório

1. Criar banco de dados de nome `promobit`
2. Definir parâmetros de conexão com banco de dados MySQL no arquivo `.env`
3. Executar comando ```composer install``` para instalar dependências.
4. Executar comando ```php artisan migrate``` para criar as tabelas no banco de dados.
5. Executar comando ```npm install && npm run dev``` para compilar arquivos JS e CSS.
6. Rodar aplicação Laravel com ```php artisan serve```

## SQL para extração de relatório de relevância de produtos

```mysql
select t.name as tagName, count(pt.product_id) as numProducts
from tag t
         left join product_tag pt on t.id = pt.tag_id
         left join product p on pt.product_id = p.id
group by t.id
order by numProducts desc;
```
