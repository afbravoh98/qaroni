## Qaroni Test
A continuación los diferentes componentes de configuración para
el correcto funcionamiento del proyecto.

1. Instalación del proyecto
    - Clonar el proyecto
    - Instalación de dependencias *[composer install]*
    - Instalación de dependencias FRONT *[npm install && npm run dev]*
    

2. Configuración Inicial
    - Configuración archivo .env 
    - Copiar archivo .env.example en archivo .env 
    - Administrar credenciales de DB: MYSQL: sugerencia *[qaroni]*
    - QUEUE CONNECION: sugenreia *[database]*
    - Credenciales MAILTRAP envío de notificaciones


    
3. Seeders de la aplicación
    - Ejecutar: *[php artisan db:seed --class DatabaseSeeder]*


    
4. Ejecutar cola de trabajos, correcto funcionamiento del JOB de notificaciones
    - Ejecutar: *[php artisan php artisan queue:work]*
      
