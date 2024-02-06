# API-REST CON PHP - PDO - DB:MYSQL
## Autor: Ing. Yordhis Osuna

## Finalidad educativa

# ¿Qué es una API?

Las API son mecanismos que permiten a dos componentes de software comunicarse entre sí mediante un conjunto de definiciones y protocolos. Por ejemplo, el sistema de software del instituto de meteorología contiene datos meteorológicos diarios. La aplicación meteorológica de su teléfono “habla” con este sistema a través de las API y le muestra las actualizaciones meteorológicas diarias en su teléfono.

# ¿Qué significa API?

API significa “interfaz de programación de aplicaciones”. En el contexto de las API, la palabra aplicación se refiere a cualquier software con una función distinta. La interfaz puede considerarse como un contrato de servicio entre dos aplicaciones. Este contrato define cómo se comunican entre sí mediante solicitudes y respuestas. La documentación de su API contiene información sobre cómo los desarrolladores deben estructurar esas solicitudes y respuestas.

# ¿Cómo funcionan las API?

La arquitectura de las API suele explicarse en términos de cliente y servidor. La aplicación que envía la solicitud se llama cliente, y la que envía la respuesta se llama servidor. En el ejemplo del tiempo, la base de datos meteorológicos del instituto es el servidor y la aplicación móvil es el cliente. 

Las API pueden funcionar de cuatro maneras diferentes, según el momento y el motivo de su creación.

## API de SOAP 

Estas API utilizan el protocolo simple de acceso a objetos. El cliente y el servidor intercambian mensajes mediante XML. Se trata de una API menos flexible que era más popular en el pasado.

## API de RPC

Estas API se denominan llamadas a procedimientos remotos. El cliente completa una función (o procedimiento) en el servidor, y el servidor devuelve el resultado al cliente.

## API de WebSocket

La API de WebSocket es otro desarrollo moderno de la API web que utiliza objetos JSON para transmitir datos. La API de WebSocket admite la comunicación bidireccional entre las aplicaciones cliente y el servidor. El servidor puede enviar mensajes de devolución de llamada a los clientes conectados, por lo que es más eficiente que la API de REST.

## API de REST (Esta es la que se esta implementando)

Estas son las API más populares y flexibles que se encuentran en la web actualmente. El cliente envía las solicitudes al servidor como datos. El servidor utiliza esta entrada del cliente para iniciar funciones internas y devuelve los datos de salida al cliente. Veamos las API de REST con más detalle a continuación.

## ¿Qué son las API de REST?

REST significa transferencia de estado representacional. REST define un conjunto de funciones como GET, PUT, DELETE, etc. que los clientes pueden utilizar para acceder a los datos del servidor. Los clientes y los servidores intercambian datos mediante HTTP.

La principal característica de la API de REST es que no tiene estado. La ausencia de estado significa que los servidores no guardan los datos del cliente entre las solicitudes. Las solicitudes de los clientes al servidor son similares a las URL que se escriben en el navegador para visitar un sitio web. La respuesta del servidor son datos simples, sin la típica representación gráfica de una página web.

# ¿Qué es una API web?

Una API web o API de servicios web es una interfaz de procesamiento de aplicaciones entre un servidor web y un navegador web. Todos los servicios web son API, pero no todas las API son servicios web. La API de REST es un tipo especial de API web que utiliza el estilo arquitectónico estándar explicado anteriormente.

Los diferentes términos relacionados con las API, como API de Java o API de servicios, existen porque históricamente las API se crearon antes que la World Wide Web. Las API web modernas son API de REST y los términos pueden utilizarse indistintamente.

# ¿Qué son las integraciones de las API?

Las integraciones de las API son componentes de software que actualizan automáticamente los datos entre los clientes y los servidores. Algunos ejemplos de integraciones de las API son la sincronización automática de datos en la nube desde la galería de imágenes de su teléfono o la sincronización automática de la hora y la fecha en su laptop cuando viaja a otra zona horaria. Las empresas también pueden utilizarlas para automatizar de manera eficiente muchas funciones del sistema.


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