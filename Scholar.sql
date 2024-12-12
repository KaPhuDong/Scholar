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
('Ballpoint Pen', 'A smooth writing ballpoint pen', 15.50, 100, 2),
('Gel Pen', 'A pen with gel-based ink', 20.00, 200, 2),
('Fountain Pen', 'A classic fountain pen', 10.00, 50, 2),
('Marker Pen', 'A marker for highlighting', 15.75, 150, 2),
('Rollerball Pen', 'A pen with a rolling ball tip', 35.50, 80, 2),
('Mechanical Pencil', 'A pencil with a mechanical mechanism', 25.25, 120, 2),
('Stylus Pen', 'A pen for touchscreen devices', 55.00, 60, 2),
('Highlighter Pen', 'A pen for highlighting text', 15.25, 140, 2),
('Erasable Pen', 'A pen with erasable ink', 25.75, 90, 2),
('Brush Pen', 'A pen with a brush tip', 45.00, 70, 2),
('Calligraphy Pen', 'A pen for calligraphy', 35.00, 40, 2),
('3D Printing Pen', 'A pen for creating 3D objects', 25.00, 20, 2);

-- Chèn dữ liệu vào bảng product_images
INSERT INTO product_images (product_id, image_url) VALUES
(1, 'https://i.pinimg.com/236x/db/65/55/db6555de65fd3f903b7ece9540087a4f.jpg'),
(1, 'https://i.pinimg.com/236x/db/65/55/db6555de65fd3f903b7ece9540087a4f.jpg'),
(1, 'https://i.pinimg.com/236x/db/65/55/db6555de65fd3f903b7ece9540087a4f.jpg'),
(2, 'https://i.pinimg.com/236x/a0/86/22/a0862237e2483d1a16d072c84ba35ae6.jpg'),
(2, 'https://i.pinimg.com/236x/a0/86/22/a0862237e2483d1a16d072c84ba35ae6.jpg'),
(2, 'https://i.pinimg.com/236x/a0/86/22/a0862237e2483d1a16d072c84ba35ae6.jpg'),
(3, 'https://i.pinimg.com/474x/a1/e8/94/a1e89403401d2823e70f80eb4f78f963.jpg'),
(3, 'https://i.pinimg.com/474x/a1/e8/94/a1e89403401d2823e70f80eb4f78f963.jpg'),
(3, 'https://i.pinimg.com/474x/a1/e8/94/a1e89403401d2823e70f80eb4f78f963.jpg'),
(4, 'https://i.pinimg.com/236x/74/b7/54/74b754b6531ece6d96f8761b9d833adb.jpg'),
(4, 'https://i.pinimg.com/236x/74/b7/54/74b754b6531ece6d96f8761b9d833adb.jpg'),
(4, 'https://i.pinimg.com/236x/74/b7/54/74b754b6531ece6d96f8761b9d833adb.jpg'),
(5, 'https://i.pinimg.com/236x/90/15/80/901580ebb23ca7065c5edec6b4e84b73.jpg'),
(5, 'https://i.pinimg.com/236x/90/15/80/901580ebb23ca7065c5edec6b4e84b73.jpg'),
(5, 'https://i.pinimg.com/236x/90/15/80/901580ebb23ca7065c5edec6b4e84b73.jpg'),
(6, 'https://i.pinimg.com/474x/05/c8/1d/05c81d4d80f1e644c36d9116e76ff89d.jpg'),
(6, 'https://i.pinimg.com/474x/05/c8/1d/05c81d4d80f1e644c36d9116e76ff89d.jpg'),
(6, 'https://i.pinimg.com/474x/05/c8/1d/05c81d4d80f1e644c36d9116e76ff89d.jpg'),
(7, 'https://i.pinimg.com/474x/61/52/26/6152261ed5a1e69481db73b2d15459d6.jpg'),
(7, 'https://i.pinimg.com/474x/61/52/26/6152261ed5a1e69481db73b2d15459d6.jpg'),
(7, 'https://i.pinimg.com/474x/61/52/26/6152261ed5a1e69481db73b2d15459d6.jpg'),
(8, 'https://i.pinimg.com/474x/2d/65/75/2d6575ede39cec451f0dec98e899539b.jpg'),
(8, 'https://i.pinimg.com/474x/2d/65/75/2d6575ede39cec451f0dec98e899539b.jpg'),
(8, 'https://i.pinimg.com/474x/2d/65/75/2d6575ede39cec451f0dec98e899539b.jpg'),
(9, 'https://i.pinimg.com/236x/a0/86/22/a0862237e2483d1a16d072c84ba35ae6.jpg'),
(9, 'https://i.pinimg.com/236x/a0/86/22/a0862237e2483d1a16d072c84ba35ae6.jpg'),
(9, 'https://i.pinimg.com/236x/a0/86/22/a0862237e2483d1a16d072c84ba35ae6.jpg'),
(10, 'https://i.pinimg.com/736x/9e/10/63/9e1063b6269e7f1571238adce4dd9a7a.jpg'),
(10, 'https://i.pinimg.com/736x/9e/10/63/9e1063b6269e7f1571238adce4dd9a7a.jpg'),
(10, 'https://i.pinimg.com/736x/9e/10/63/9e1063b6269e7f1571238adce4dd9a7a.jpg'),
(11, 'https://i.pinimg.com/736x/62/3b/f1/623bf1ca5f9b8107924d6c3cf18d5df3.jpg'),
(11, 'https://i.pinimg.com/736x/62/3b/f1/623bf1ca5f9b8107924d6c3cf18d5df3.jpg'),
(11, 'https://i.pinimg.com/736x/62/3b/f1/623bf1ca5f9b8107924d6c3cf18d5df3.jpg'),
(12, 'https://i.pinimg.com/236x/c8/36/98/c8369893d1110574d70463877f1558ed.jpg'),
(12, 'https://i.pinimg.com/236x/c8/36/98/c8369893d1110574d70463877f1558ed.jpg'),
(12, 'https://i.pinimg.com/236x/c8/36/98/c8369893d1110574d70463877f1558ed.jpg');

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




