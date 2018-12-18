# Project Title

Escuela

## Getting Started
Api de escuela pagofacil, implementando JWT como seguridad

URLs:
/api/register : registrar un usuario para consumo de api
```
{
	"email": "example@mail.com",
	"password": "123456"
}
```

/api/login : login usuario para consumo de api
```
{
	"email": "example@mail.com",
	"password": "123456"
}
```

Se debe de iniciar sesión para poder consumir la api
Todos los métodos deben de tener especificado el encabezado Authorization de la siguiente manera
"bearer token_generado_login"

POST: /api/registrarCalificacion : registrar calificacion
```
{
	"alumno": 1, //id alumno
	"calificacion": 8.1,
	"materia": 3 //id materia
}
```

GET: /api/obtenerCalificacion/{id_alumno}: obtener califiaciones del alumno

PUT: /api/actualizaCalificacion: actualizar calificacion
```
{
	"id_t_calificaciones": 1, //id calificacion
	"calificacion": 10
}
```

DELETE: /api/borrarCalificacion/{id_calificacion} elimina una calificacion

### Prerequisites

Composer, PHP, Laravel

### Installing


Correr
```
php:artisan migrate
```

End with an example of getting some data out of the system or using it for a little demo

## Versioning

1.0

## Authors

Jose Luis Trinidad
## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
