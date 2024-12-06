# Usar una imagen base oficial de PHP con Apache
FROM php:8.2-apache

# Definir el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# Copiar todos los archivos del proyecto al directorio de trabajo
COPY . .

# Instalar extensiones necesarias de PHP (en este caso, mysqli para MySQL)
RUN docker-php-ext-install mysqli

# Exponer el puerto 8080 para el servidor web
EXPOSE 8080

# Cambiar la configuración de Apache para escuchar en el puerto 8080
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf
RUN sed -i 's/:80/:8080/g' /etc/apache2/sites-available/000-default.conf

# Comando predeterminado para iniciar Apache
CMD ["apache2-foreground"]
