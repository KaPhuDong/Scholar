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




-- Chèn dữ liệu vào bảng products notes
INSERT INTO products (name, description, price, stock, category_id) VALUES
('Notebook for Notes', 'Compact notebook, easy to carry, anti-glare paper', 15.00, 120, 1),
('Yellow Sticky Notes', 'Yellow sticky notes, easy to write on and stick anywhere', 5.00, 300, 1),
('Multicolor Sticky Notes', 'Multicolor sticky notes, ideal for highlighting important details', 7.00, 250, 1),
('Heart-shaped Sticky Notes', 'Decorative sticky notes, heart-shaped design', 6.50, 200, 1),
('Spiral Notebook A5', 'A5-sized spiral notebook, 200 pages, convenient to use', 20.00, 100, 1),
('Vintage Notebook', 'Classic-style notebook with a luxurious leather cover', 50.00, 50, 1),
('Waterproof Sticky Notes', 'Sticky notes made with special waterproof material', 10.00, 180, 1),
('Sticky Notes with Adhesive', 'Sticky notes with adhesive, perfect for sticking on any surface', 8.00, 250, 1),
('Student Notebook B5', 'B5-sized notebook, durable paper, perfect for studying', 18.00, 150, 1),
('Capybara-themed Sticky Notes', 'Sticky notes with cute animal designs like capybara, cats, and bears', 9.00, 200, 1),
('Hardcover Notebook', 'Hardcover notebook, A6 size, premium paper quality', 12.00, 140, 1),
('Creative Sticky Notes', 'Sticky notes with creative designs, perfect for decoration', 7.50, 180, 1),
('Business Notebook', 'Elegant notebook for professionals, with soft leather cover', 60.00, 40, 1),
('Bordered Sticky Notes', 'Sticky notes with beautiful decorative borders', 6.00, 250, 1),
('Plastic Cover Notebook', 'Notebook with transparent plastic cover, waterproof and durable', 22.00, 90, 1);


-- Chèn dữ liệu vào bảng product_images
INSERT INTO product_images (product_id, image_url) VALUES
(1, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-ll0uals5ifgr23.webp'),
(1, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-ll0ualp3oatn9f.webp'),
(1, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-ll0ualpxn2yz76.webp'),
(2, 'https://down-vn.img.susercontent.com/file/vn-11134211-7r98o-lov9hlg5mjbve9.webp'),
(2, 'https://down-vn.img.susercontent.com/file/vn-11134211-7r98o-lov9hlg5wdaz6e.webp'),
(2, 'https://down-vn.img.susercontent.com/file/vn-11134211-7r98o-lov9hlg5tk6377.webp'),
(3, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lz3omnx9600x42.webp'),
(3, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lz3omnx8yz6p82.webp'),
(3, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lz3pbpcdruzl7f.webp'),
(4, 'https://down-vn.img.susercontent.com/file/7fc77e02a7d757562c7ac865a03b0184.webp'),
(4, 'https://down-vn.img.susercontent.com/file/7f3925f88317af34453ba288c89e6d3f.webp'),
(4, 'https://down-vn.img.susercontent.com/file/2c543a98af6e0808bcb11c691d79e746.webp'),
(5, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lla6k0hauo5293.webp'),
(5, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lla6k0hannau90.webp'),
(5, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lla6k0h9pxhk39.webp'),
(6, 'https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-li0dm4uvaldt87.webp'),
(6, 'https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-li0dm4uv7s8xce.webp'),
(6, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-loey5zgz627rb7.webp'),
(7, 'https://down-vn.img.susercontent.com/file/093c6589733850731e2ec9351c5efdc8.webp'),
(7, 'https://down-vn.img.susercontent.com/file/cn-11134207-7r98o-ltw4teijk8gtd9.webp'),
(7, 'https://down-vn.img.susercontent.com/file/cn-11134207-7r98o-ltw5d1hsqyu5e6.webp'),
(8, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lnx15lvgrfcq69.webp'),
(8, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lnx15lvgrffx68.webp'),
(8, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lnx15lvhmbuif0.webp'),
(9, 'https://down-vn.img.susercontent.com/file/sg-11134201-7rbk9-lpc0xjf632f271.webp'),
(9, 'https://down-vn.img.susercontent.com/file/sg-11134201-7rbld-lpc0xk4f24mr25.webp'),
(9, 'https://down-vn.img.susercontent.com/file/sg-11134201-7rbmu-lpc0xkqw583q92.webp'),
(10, 'https://down-vn.img.susercontent.com/file/cn-11134207-7ras8-m0shsq6j28qv4e.webp'),
(10, 'https://down-vn.img.susercontent.com/file/cn-11134207-7ras8-m0shsvp6zirr86.webp'),
(10, 'https://down-vn.img.susercontent.com/file/cn-11134207-7ras8-m0shsshhothq63.webp'),
(11, 'https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-lgvspjw14ttfb3.webp'),
(11, 'https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-lgvspjw0pdkj10.webp'),
(11, 'https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-lgvspjw13f3mc2.webp'),
(12, 'https://down-vn.img.susercontent.com/file/vn-11134211-7r98o-llnhcwbtf2d86c.webp'),
(12, 'https://down-vn.img.susercontent.com/file/vn-11134211-7r98o-llnhcwbthvi4e2.webp'),
(12, 'https://down-vn.img.susercontent.com/file/vn-11134211-7r98o-llnhcwbtkon0bf.webp'),
(13, 'https://down-vn.img.susercontent.com/file/vn-11134207-7ras8-m2j1e3jpra2cbb.webp'),
(13, 'https://down-vn.img.susercontent.com/file/vn-11134207-7ras8-m2j1exkzsyicc8.webp'),
(13, 'https://down-vn.img.susercontent.com/file/vn-11134207-7ras8-m2j1f84kdi2a67.webp'),
(14, 'https://down-vn.img.susercontent.com/file/42ec6102b75896bf9a681bb491f2db2d.webp'),
(14, 'https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-lftbvwridjp36a.webp'),
(14, 'https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-lftbvwriey9jdb.webp'),
(15, 'https://down-vn.img.susercontent.com/file/c24bee03dbe66a411355cb2c87fc2913.webp'),
(15, 'https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-lik8n4ql78ia3e.webp'),
(15, 'https://down-vn.img.susercontent.com/file/8411d3dbd3a49ce6b3c24148330699b6.webp');


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




