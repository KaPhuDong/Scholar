FROM php:8.2-apache

# Cài đặt extension MySQL
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Bật module rewrite của Apache (cần thiết cho file .htaccess của bạn)
RUN a2enmod rewrite

# Copy toàn bộ mã nguồn dự án vào container
COPY . /var/www/html/

# Phân quyền
RUN chown -R www-data:www-data /var/www/html