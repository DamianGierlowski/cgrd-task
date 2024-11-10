# Use the official PHP Apache image as a base
FROM php:8.3-apache

# Install required PHP extensions for MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copy the current directory contents into the container's /var/www/html/public
COPY . /var/www/html

# Set the working directory to /var/www/html/public
WORKDIR /var/www/html/public

# Copy the .htaccess file to the document root
COPY .htaccess /var/www/html/.htaccess

# Set file permissions for Apache (www-data user)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Enable Apache mod_rewrite, required for .htaccess file overrides
RUN a2enmod rewrite

# Update Apache config to allow .htaccess overrides
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf


# Configure Apache to serve files from the /var/www/html/public directory
RUN echo "<VirtualHost *:80> \n\
    DocumentRoot /var/www/html/public \n\
    <Directory /var/www/html/public> \n\
        Options Indexes FollowSymLinks \n\
        AllowOverride All \n\
        Require all granted \n\
    </Directory> \n\
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Expose the default Apache port
EXPOSE 80

# Start Apache in the foreground to keep the container running
CMD ["apache2-foreground"]
