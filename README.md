# API-REST CON PHP - PDO - DB:MYSQL
## Autor: Ing. Yordhis Osuna

## Finalidad educativa

### ¿Que es una api?


# Idea principal
Esta api cumple con el CRUD para la gestión de peliculas de un cine.

# Consumir la api
Esta api tiene 4 ENDPOINT

### GET
Realiza la petición por url y retorna todas las películas

### POST
Permite crear un recurso (Película) con la siguiente estructura
~~~
    {
        "titulo":"Matrix 1",
        "descripcion":"Matrix es una tetralogía de películas de ciencia ficción",
        "precio":100
    }
~~~

### PUT
Permite editar un recurso (Película) con la siguiente estructura
~~~
    {
        "id": 1
        "titulo":"Matrix 1",
        "descripcion":"Matrix es una tetralogía de películas de ciencia ficción",
        "precio":100
    }
~~~

### DELETE
Permite eliminar un recurso (Película) con la siguiente estructura
~~~
    {
        "id": 1
    }
~~~


link de API: https://cyberstaffstore.com/api-php/