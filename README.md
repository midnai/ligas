# Ligas de Futbol

Como punto inicial se usa [Laravel Jetstream]

# Instalación

Despues de clonar el repositorio, ejecutar `composer install` y configurar su base de datos, se debe ejecutar las migraciones con los seeds:
```sh
$ php artisan migrate:fresh --seed
```
# Endpoints
## Ligas
| Verbo | URI | Action | Descripción |
| ------ | ------ | ------ | ------ |
| GET | `/ligas` | index | Lista de ligas |
| GET | `/ligas/{liga}` | show | Detalle de liga |
| GET | `/ligas/{liga}/equipos` | index | Lista de equipos de una liga |
| POST | `/ligas` | store | Crear liga |
| POST | `/ligas/equipos` | equipos | Cargar Excel |
| PUT | `/ligas/{liga}` | update | Actualizar liga |
| DELETE | `/ligas/{liga}` | delete |Eliminar liga |

## Equipos
| Verbo | URI | Action | Descripción |
| ------ | ------ | ------ | ------ |
| GET | `/equipos` | index | Lista de equipos |
| GET | `/equipos/{equipo}` | show | Detalle de equipo |
| GET | `/equipos/{equipo}/ligas` | index | Lista de ligas de un equipo |
| GET | `/equipos/{equipo}/jugadores` | index | Lista de jugadores de un equipo |
| POST | `/equipos` | store | Crear equipo |
| PUT | `/equipos/{equipo}` | update | Actualizar equipo |
| DELETE | `/equipos/{equipo}` | delete |Eliminar equipo |

## Jugadores
| Verbo | URI | Action | Descripción |
| ------ | ------ | ------ | ------ |
| GET | `/jugadores` | index | Lista de jugadores |
| GET | `/jugadores/{jugador}` | show | Detalle de jugador |
| POST | `/jugadores` | store | Crear jugador |
| PUT | `/jugadores/{jugador}` | update | Actualizar jugador |
| DELETE | `/jugadores/{jugador}` | delete |Eliminar jugador |

# Test
Todos los endpoints tienen tests, puede visualizarlo ejecutando el `TestSuit=Liga`, con el siguiente comando:
```sh
$ php artisan test --testsuite=Liga
```

![tests](https://raw.githubusercontent.com/octobel/ligas/main/public/img/test.png)

# Acceso al Sistema
EL sistema permite crear usuarios y cada usuario puede crear tokens


## Login & Register
En la carga inicial encontraras los links para crear un usuario y para el login

![Paso1](https://github.com/octobel/ligas/blob/main/public/img/Paso%201.png?raw=true)
![Paso2](https://github.com/octobel/ligas/blob/main/public/img/Paso%202.png?raw=true)

## Dashboard & Lista de Equipo
AL ingresar al sistema podras visualizar las opciones tanto para ir a la vista de listado de equipos como opciones de la cuenta, entre ellas crear API tokens.

![Paso3](https://github.com/octobel/ligas/blob/main/public/img/Paso%203.png?raw=true)

## Crear tokens
En esta vista el usuario podra crear 2 tipos de tokens:
 - Acceso limitado (3 request por minuto)
 - Acceso ilimitado (marcar la opcion `full_access`)
 - El nombre del token puede ser de su elección

![Paso4](https://github.com/octobel/ligas/blob/main/public/img/Paso%204.png?raw=true)
![Paso5](https://github.com/octobel/ligas/blob/main/public/img/Paso%205.png?raw=true)

## Logica de los tokens con acceso limitado

Se modifico el archivo `RouteServiceProvider.php` agregando un nuevo `Rate Limit`, esta caracteristica viene por defecto en Laravel, asi que solo basta con configurarlo.

![Rate Limit](https://github.com/octobel/ligas/blob/main/public/img/rate_limit.png?raw=true)


## Carga masiva de equipos

> Esta caracteristca no esta terminada, hace falta mas validaciones 

Decidi usar el paquete `Laravel Excel` que nos permite dividir los registros del archivo excel en porciones o Chunks, ejecutar o insertar los registros en Batchs e incluso encolar los estos Batchs y Chunks.

La logica es muy sencilla una ves teniendo el paquete, se puede encontrar en `app/Http/Controllers/Api/LigaEquipoController.php`

Archivo de ejemplo: `public/excel/test.xlsx`

[Laravel Jetstream]: <https://jetstream.laravel.com/>
