# Usar una imagen base oficial de PHP con Apache
FROM php:8.2-apache

# Definir el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# Copiar todos los archivos del proyecto al directorio de trabajo
COPY . .

# Instalar extensiones necesarias de PHP (en este caso, mysqli para MySQL)
RUN docker-php-ext-install mysqli

# Exponer el puerto 80 para el servidor web
EXPOSE 80

# Comando predeterminado para iniciar Apache
CMD ["apache2-foreground"]
