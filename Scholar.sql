CREATE DATABASE scholar;
USE scholar;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone_number VARCHAR(15),
    address TEXT,
    role ENUM('customer', 'admin') DEFAULT 'customer'
);

CREATE TABLE  categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE  products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock INT DEFAULT 0,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE SET NULL
);

CREATE TABLE  product_images (
    image_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

CREATE TABLE  carts (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT DEFAULT 1,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

CREATE TABLE  orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10, 2) NOT NULL,
    status ENUM('Pending', 'Processing', 'Completed') DEFAULT 'Pending',
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE  order_items (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

-- Chèn dữ liệu vào bảng users
INSERT INTO users (name, email, password, phone_number, address, role) VALUES
('Nguyễn Văn A', 'nguyenvana@example.com', 'password123', '0123456789', 'Hà Nội, Việt Nam', 'customer'),
('Trần Thị B', 'tranthib@example.com', 'password123', '0987654321', 'Hồ Chí Minh, Việt Nam', 'customer'),
('Lê Minh C', 'leminhc@example.com', 'password123', '0912345678', 'Đà Nẵng, Việt Nam', 'customer'),
('Phạm Quang D', 'phamquangd@example.com', 'password123', '0932123456', 'Hải Phòng, Việt Nam', 'customer'),
('Vũ Ngọc E', 'vungoce@example.com', 'password123', '0901234567', 'Cần Thơ, Việt Nam', 'admin');

-- Chèn dữ liệu vào bảng categories
INSERT INTO categories (name) VALUES
('Note'),
('Write'),
('Gear');

-- Chèn dữ liệu vào bảng products
INSERT INTO products (name, description, price, stock, category_id) VALUES
('Vở học sinh A5', 'Vở học sinh A5, 200 trang, giấy trắng', 25.00, 100, 1),
('Bút bi Xịn', 'Bút bi màu đen, mực lâu khô', 10.00, 200, 2),
('Bảng học sinh mini', 'Bảng học sinh mini cho việc học nhóm', 50.00, 50, 3),
('Cặp sách học sinh', 'Cặp sách đẹp, chống gù lưng', 150.00, 30, 1),
('Sách Giáo Khoa Toán', 'Sách giáo khoa môn Toán lớp 10', 80.00, 80, 2);

-- Chèn dữ liệu vào bảng product_images
INSERT INTO product_images (product_id, image_url) VALUES
(1, 'images/vo_hocsinh_a5.jpg'),
(2, 'images/but_bi_xin.jpg'),
(3, 'images/bang_hocsinh_mini.jpg'),
(1, 'images/cap_sach_hocsinh.jpg'),
(3, 'images/sach_giaokhoa_toan.jpg');

-- Chèn dữ liệu vào bảng carts
INSERT INTO carts (user_id, product_id, quantity) VALUES
(1, 1, 1),
(2, 3, 1),
(3, 2, 1),
(1, 3, 1),
(1, 2, 1);

-- Chèn dữ liệu vào bảng orders
INSERT INTO orders (user_id, total_amount, status) VALUES
(1, 60.00, 'Pending'),
(2, 100.00, 'Processing'),
(3, 30.00, 'Completed'),
(4, 150.00, 'Pending'),
(5, 400.00, 'Completed');

-- Chèn dữ liệu vào bảng order_items
INSERT INTO order_items (order_id, product_id, quantity, price) VALUES
(1, 1, 2, 25.00),
(2, 3, 1, 50.00),
(3, 2, 3, 10.00),
(4, 4, 1, 150.00),
(5, 5, 5, 80.00);




