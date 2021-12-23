## Tecnologias e versões

- PHP 7.4.6
- Laravel 8.77.1
- MySQL 5.7.31
- Composer 2.1.22

## Learning Laravel

## SQL para extração de relatório de relevância de produtos

```mysql
select t.name as tagName, count(pt.product_id) as numProducts
from tag t
         left join product_tag pt on t.id = pt.tag_id
         left join product p on pt.product_id = p.id
group by t.id
order by numProducts desc;
```
