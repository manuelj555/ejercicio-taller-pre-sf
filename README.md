Realizar un Crud de Productos

id, codigo, nombre, descripcion, marca, categoria, precio

Validaciones:
 Todos los campos son obligatorios.
 El nombre y el codigo no pueden repetirse.
 El código no puede contener caracteres especiales ni espacios.
 El código debe tener mínimo 4 caracteres y máximo 10.
 El nombre debe contener mínimo 4 caracteres.
 El precio debe ser un número válido.
 
Permitir:
    Listar productos (Paginar es un Plus).
    Filtrar productos (Opcional, es un plus).
    Ordenar por columna (Opcional, es un plus).
    Crear Productos.
    Editar Productos.
    Eliminar Productos (El usuario debe confirmar esta accion).
    
Trabajar con bootstrap css o cualquier otro.

Test:
  Crear tests (unitarios o de integracion) para los servicios que creen.
  Crear tests (unitarios o integración) de las validaciones de la entidad.

Notas:
Manejar el código y base de datos en ingles, las pantallas en español.

# Instalación

En una terminal ejecutar (reemplazar `<carpeta-del-proyecto>` por un nombre de carpeta válido):

```bash
git clone https://github.com/manuelj555/ejercicio-taller-pre-sf.git <carpeta-del-proyecto>
```
  
Luego ir a la nueva carpeta creada `cd <carpeta-del-proyecto>` y ejecutar:

```bash
composer install
```

Cuando se termine de instalar el composer, dejar los valores por defecto para los parametros del parameters.yml.

Al finalizar la instalación ejecutar:

```bash
php bin/console server:run
```

Esto iniciará el servidor que viene con php (> 5.4) y podrán acceder a la aplicación con la siguiente url:

http://127.0.0.1:8000
