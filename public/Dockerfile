FROM php:8.2-apache

# Cài đặt extension để kết nối MySQL/PostgreSQL (tùy loại database trên Aiven)
RUN docker-php-ext-install pdo pdo_mysql

# Copy toàn bộ code vào thư mục mặc định của Apache
COPY . /var/www/html/

# Phân quyền cho thư mục web
RUN chown -R www-data:www-data /var/www/html

# Mở cổng 80
EXPOSE 80