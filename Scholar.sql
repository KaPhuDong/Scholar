CREATE DATABASE scholar;
USE scholar;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone_number VARCHAR(15),
    address TEXT,
    role ENUM('customer', 'admin') DEFAULT 'customer',
    avatar varchar(200) DEFAULT NULL
);

CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock INT DEFAULT 0,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE SET NULL
);

CREATE TABLE product_images (
    image_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10, 2) NOT NULL,
    status ENUM('Pending', 'Processing', 'Completed') DEFAULT 'Pending',
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE order_detail (
    order_detail_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

CREATE TABLE delivery_information (
    delivery_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    recipient_name VARCHAR(100) NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    delivery_address TEXT NOT NULL,
    delivery_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE
);

-- Insert data into users
INSERT INTO users (name, email, password, role) 
VALUES ('Admin', 'admin@gmail.com', MD5('admin@123'), 'admin');

-- Insert data into categories
INSERT INTO categories (name) VALUES
('Note'),
('Write'),
('Gear');

-- Insert data into products
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
('3D Printing Pen', 'A pen for creating 3D objects', 25.00, 20, 2),
('Notebook for Notes', 'Compact notebook, easy to carry, anti-glare paper', 15.00, 120, 1),
('Yellow Sticky Notes', 'Yellow sticky notes, easy to write on and stick anywhere', 5.00, 300, 1),
('Multicolor Sticky', 'Multicolor sticky notes, ideal for highlighting important details', 7.00, 250, 1),
('Heart Sticky', 'Decorative sticky notes, heart-shaped design', 6.50, 200, 1),
('Spiral Notebook A5', 'A5-sized spiral notebook, 200 pages, convenient to use', 20.00, 100, 1),
('Vintage Notebook', 'Classic-style notebook with a luxurious leather cover', 50.00, 50, 1),
('Waterproof Sticky', 'Sticky notes made with special waterproof material', 10.00, 180, 1),
('Sticky Notes', 'Sticky notes with adhesive, perfect for sticking on any surface', 8.00, 250, 1),
('Student Notebook B5', 'B5-sized notebook, durable paper, perfect for studying', 18.00, 150, 1),
('Capybara Sticky', 'Sticky notes with cute animal designs like capybara, cats, and bears', 9.00, 200, 1),
('Hardcover Notebook', 'Hardcover notebook, A6 size, premium paper quality', 12.00, 140, 1),
('Creative Sticky', 'Sticky notes with creative designs, perfect for decoration', 7.50, 180, 1),
('Business Notebook', 'Elegant notebook for professionals, with soft leather cover', 60.00, 40, 1),
('Plastic Cover Notebook', 'Notebook with transparent plastic cover, waterproof and durable', 22.00, 90, 3),
('Backpack', 'A spacious backpack for carrying books and supplies', 45.00, 100, 3),
('Scissors', 'Durable scissors for cutting paper and crafts', 10.00, 200, 3),
('Ruler', 'A 12-inch ruler for measurements', 5.00, 150, 3),
('Stapler', 'A mini stapler with staples included', 7.00, 120, 3),
('Paper Clips', 'A pack of 100 metal paper clips', 3.50, 300, 3),
('Pencil Case', 'A stylish case for storing pencils and pens', 12.50, 150, 3),
('Tape Dispenser', 'A handy dispenser with clear tape', 10.00, 140, 3),
('Eraser', 'A soft eraser for clean corrections', 1.50, 500, 3),
('Sharpener', 'A compact pencil sharpener', 2.00, 400, 3),
('Geometry Set', 'A set including compass, protractor, and ruler', 12.00, 100, 3),
('Desk Organizer', 'A multi-section organizer for study supplies', 18.00, 80, 3),
('Calculator', 'A basic calculator for math operations', 20.00, 90, 3),
('Compass', 'A metal compass for geometry', 12.00, 150, 3),
('Binder Clips', 'A set of 12 medium binder clips', 5.00, 200, 3),
('Hole Puncher', 'A metal hole puncher for paper', 15.00, 100, 3),
('Whiteboard Eraser', 'A soft eraser for whiteboard cleaning', 8.00, 150, 3),
('Clipboard', 'A sturdy clipboard for holding papers', 12.00, 120, 3),
('File Folder', 'A set of 5 folders for organizing documents', 10.00, 180, 3);

-- Insert data into product_images
INSERT INTO product_images (product_id, image_url) VALUES
(1, 'https://i.pinimg.com/236x/db/65/55/db6555de65fd3f903b7ece9540087a4f.jpg'),
(1, 'https://i.pinimg.com/236x/db/65/55/db6555de65fd3f903b7ece9540087a4f.jpg'),
(1, 'https://i.pinimg.com/236x/db/65/55/db6555de65fd3f903b7ece9540087a4f.jpg'),
(2, 'https://i.pinimg.com/474x/b8/9d/ea/b89deaa04c601f09d292dc6ae8181df3.jpg'),
(2, 'https://i.pinimg.com/474x/b8/9d/ea/b89deaa04c601f09d292dc6ae8181df3.jpg'),
(2, 'https://i.pinimg.com/474x/b8/9d/ea/b89deaa04c601f09d292dc6ae8181df3.jpg'),
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
(9, 'https://i.pinimg.com/236x/fd/75/43/fd754398946e4c6d4a1bf3a93349e00d.jpg'),
(9, 'https://i.pinimg.com/236x/fd/75/43/fd754398946e4c6d4a1bf3a93349e00d.jpg'),
(9, 'https://i.pinimg.com/236x/fd/75/43/fd754398946e4c6d4a1bf3a93349e00d.jpg'),
(10, 'https://i.pinimg.com/736x/9e/10/63/9e1063b6269e7f1571238adce4dd9a7a.jpg'),
(10, 'https://i.pinimg.com/736x/9e/10/63/9e1063b6269e7f1571238adce4dd9a7a.jpg'),
(10, 'https://i.pinimg.com/736x/9e/10/63/9e1063b6269e7f1571238adce4dd9a7a.jpg'),
(11, 'https://i.pinimg.com/736x/62/3b/f1/623bf1ca5f9b8107924d6c3cf18d5df3.jpg'),
(11, 'https://i.pinimg.com/736x/62/3b/f1/623bf1ca5f9b8107924d6c3cf18d5df3.jpg'),
(11, 'https://i.pinimg.com/736x/62/3b/f1/623bf1ca5f9b8107924d6c3cf18d5df3.jpg'),
(12, 'https://i.pinimg.com/236x/c8/36/98/c8369893d1110574d70463877f1558ed.jpg'),
(12, 'https://i.pinimg.com/236x/c8/36/98/c8369893d1110574d70463877f1558ed.jpg'),
(12, 'https://i.pinimg.com/236x/c8/36/98/c8369893d1110574d70463877f1558ed.jpg'),
(13, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-ll0uals5ifgr23.webp'),
(13, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-ll0ualp3oatn9f.webp'),
(13, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-ll0ualpxn2yz76.webp'),
(14, 'https://down-vn.img.susercontent.com/file/vn-11134211-7r98o-lov9hlg5mjbve9.webp'),
(14, 'https://down-vn.img.susercontent.com/file/vn-11134211-7r98o-lov9hlg5wdaz6e.webp'),
(14, 'https://down-vn.img.susercontent.com/file/vn-11134211-7r98o-lov9hlg5tk6377.webp'),
(15, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lz3omnx9600x42.webp'),
(15, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lz3omnx8yz6p82.webp'),
(15, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lz3pbpcdruzl7f.webp'),
(16, 'https://down-vn.img.susercontent.com/file/7fc77e02a7d757562c7ac865a03b0184.webp'),
(16, 'https://down-vn.img.susercontent.com/file/7f3925f88317af34453ba288c89e6d3f.webp'),
(16, 'https://down-vn.img.susercontent.com/file/2c543a98af6e0808bcb11c691d79e746.webp'),
(17, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lla6k0hauo5293.webp'),
(17, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lla6k0hannau90.webp'),
(17, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lla6k0h9pxhk39.webp'),
(18, 'https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-li0dm4uvaldt87.webp'),
(18, 'https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-li0dm4uv7s8xce.webp'),
(18, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-loey5zgz627rb7.webp'),
(19, 'https://down-vn.img.susercontent.com/file/093c6589733850731e2ec9351c5efdc8.webp'),
(19, 'https://down-vn.img.susercontent.com/file/cn-11134207-7r98o-ltw4teijk8gtd9.webp'),
(19, 'https://down-vn.img.susercontent.com/file/cn-11134207-7r98o-ltw5d1hsqyu5e6.webp'),
(20, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lnx15lvgrfcq69.webp'),
(20, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lnx15lvgrffx68.webp'),
(20, 'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lnx15lvhmbuif0.webp'),
(21, 'https://down-vn.img.susercontent.com/file/sg-11134201-7rbk9-lpc0xjf632f271.webp'),
(21, 'https://down-vn.img.susercontent.com/file/sg-11134201-7rbld-lpc0xk4f24mr25.webp'),
(21, 'https://down-vn.img.susercontent.com/file/sg-11134201-7rbmu-lpc0xkqw583q92.webp'),
(22, 'https://down-vn.img.susercontent.com/file/cn-11134207-7ras8-m0shsq6j28qv4e.webp'),
(22, 'https://down-vn.img.susercontent.com/file/cn-11134207-7ras8-m0shsvp6zirr86.webp'),
(22, 'https://down-vn.img.susercontent.com/file/cn-11134207-7ras8-m0shsshhothq63.webp'),
(23, 'https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-lgvspjw14ttfb3.webp'),
(23, 'https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-lgvspjw0pdkj10.webp'),
(23, 'https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-lgvspjw13f3mc2.webp'),
(24, 'https://down-vn.img.susercontent.com/file/vn-11134211-7r98o-llnhcwbtf2d86c.webp'),
(24, 'https://down-vn.img.susercontent.com/file/vn-11134211-7r98o-llnhcwbthvi4e2.webp'),
(24, 'https://down-vn.img.susercontent.com/file/vn-11134211-7r98o-llnhcwbtkon0bf.webp'),
(25, 'https://down-vn.img.susercontent.com/file/vn-11134207-7ras8-m2j1e3jpra2cbb.webp'),
(25, 'https://down-vn.img.susercontent.com/file/vn-11134207-7ras8-m2j1exkzsyicc8.webp'),
(25, 'https://down-vn.img.susercontent.com/file/vn-11134207-7ras8-m2j1f84kdi2a67.webp'),
(26, 'https://down-vn.img.susercontent.com/file/vn-11134207-7ras8-m30egqfe1cqi97.webp'),
(26,'https://down-vn.img.susercontent.com/file/vn-11134207-7ras8-m30egqfe1czq3e.webp'),
(26,'https://down-vn.img.susercontent.com/file/vn-11134207-7ras8-m30egqfe2rk6a8.webp'),
(27,'https://down-vn.img.susercontent.com/file/db48893d5ac40b65327f98b048ed4342.webp'),
(27,'https://down-vn.img.susercontent.com/file/c9ab37478ac71d6b7eebc6c7eb2de924.webp'),
(27,'https://down-vn.img.susercontent.com/file/e4e53a5380844373b5aa0a7f2cc05a24.webp'),
(28,'https://down-vn.img.susercontent.com/file/sg-11134201-7rdwx-lz74z00ls5yg75@resize_w450_nl.webp'),
(28,'https://down-vn.img.susercontent.com/file/sg-11134201-7rdw9-lz74yye24fjre1.webp'),
(28,'https://down-vn.img.susercontent.com/file/sg-11134201-7rdvn-lz74yziui5ay89.webp'),
(29,'https://down-vn.img.susercontent.com/file/sg-11134201-7rdx4-ly41lfz2e8kza4.webp'),
(29,'https://down-vn.img.susercontent.com/file/sg-11134201-7rdxg-ly431y2igw6v6d.webp'),
(29,'https://down-vn.img.susercontent.com/file/sg-11134201-7rdws-ly41lggto8z4e4.webp'),
(30,'https://down-vn.img.susercontent.com/file/sg-11134201-7rd5q-ludbbojn4dgaaa.webp'),
(30,'https://down-vn.img.susercontent.com/file/sg-11134201-7rd46-ludbbmz1f7ks4b.webp'),
(30,'https://down-vn.img.susercontent.com/file/sg-11134201-7rd4g-ludbbm6qkmkn11.webp'),
(31,'https://down-vn.img.susercontent.com/file/ba318876939d1c2927eadc0d604c62bd.webp'),
(31,'https://down-vn.img.susercontent.com/file/58ee88e211c2daf712dec1309fe48cef.webp'),
(31,'https://down-vn.img.susercontent.com/file/f7762a312117d503294b23d42e145840.webp'),
(32,'https://down-vn.img.susercontent.com/file/cn-11134207-7qukw-ljy2lbnjit4kfa.webp'),
(32,'https://down-vn.img.susercontent.com/file/cn-11134207-7qukw-ljy2lbnjfzzobb.webp'),
(32,'https://down-vn.img.susercontent.com/file/cn-11134207-7qukw-ljy2lbnjlm9gdc.webp'),
(33,'https://down-vn.img.susercontent.com/file/sg-11134201-7rbmf-lpy1q4vinzjee1.webp'),
(33,'https://down-vn.img.susercontent.com/file/sg-11134201-7rblc-lpy10fvcarmo5e.webp'),
(33,'https://down-vn.img.susercontent.com/file/sg-11134201-7rbmb-lpy10dknp6fy3e.webp'),
(34,'https://down-vn.img.susercontent.com/file/sg-11134201-7rdwg-lxcwyzalxaw03b.webp'),
(34,'https://down-vn.img.susercontent.com/file/sg-11134201-7rdxq-lxc2d9g88ax862.webp'),
(34,'https://down-vn.img.susercontent.com/file/sg-11134201-7rdyk-lxcbk26r9xbd7d.webp'),
(35,'https://down-vn.img.susercontent.com/file/19633b0de405c1df066ada54727d299b.webp'),
(35,'https://down-vn.img.susercontent.com/file/27fa5be36e17b308d1510792b27f5044.webp'),
(35,'https://down-vn.img.susercontent.com/file/54f627b466af66ba472cb14398609313.webp'),
(36,'https://ph-live-02.slatic.net/p/032002bcafd0615b842f6a67be84f363.jpg'),
(36,'https://m.media-amazon.com/images/S/aplus-media/sc/dd99b10b-2367-433a-9e07-a4b8ab8cc64f.__CR0,0,300,300_PT0_SX300_V1___.jpg'),
(36,'https://img.lazcdn.com/g/p/38b933645c80ecd6cfceeca8579ed1d1.jpg_960x960q80.jpg_.webp'),
(37,'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-m0ck1br3jij3ae.webp'),
(37,'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-m0ck1br3i3ynea.webp'),
(37,'https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-m0ck1bqtjwtpfa.webp'),
(38,'https://down-vn.img.susercontent.com/file/sg-11134201-7qvf4-lk3n7mtc9hxhc8.webp'),
(38,'https://down-vn.img.susercontent.com/file/sg-11134201-7qvfw-lk3n7nop10xq90.webp'),
(38,'https://down-vn.img.susercontent.com/file/sg-11134201-7qven-lk3n7luxmg0ne0.webp'),
(39,'https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-ljzh0rtgnflg47.webp'),
(39,'https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-ljzh0rtgq8qcda.webp'),
(39,'https://down-vn.img.susercontent.com/file/vn-11134207-7qukw-ljzh0rtgx9kk45.webp'),
(40,'https://down-vn.img.susercontent.com/file/dd7dda3aeb5c5c3ab5a7d519b5bddf30.webp'),
(40,'https://down-vn.img.susercontent.com/file/613c529ebed59ebfa9bd09168f11e876.webp'),
(40,'https://down-vn.img.susercontent.com/file/1930ce5ee2152cb8e533784d89d659b2.webp'),
(41,'https://down-vn.img.susercontent.com/file/sg-11134201-7qve8-lgmjuyot6p5793.webp'),
(41,'https://down-vn.img.susercontent.com/file/sg-11134201-7qvcy-lgmjv00j621m75.webp'),
(41,'https://down-vn.img.susercontent.com/file/sg-11134201-7qvdo-lgmlge1xrqai5d.webp'),
(42,'https://down-vn.img.susercontent.com/file/669644e753cedcb5f3f6eeef5e85b1f9.webp'),
(42,'https://down-vn.img.susercontent.com/file/76151d0af34969dde9fd5f34bd73346e.webp'),
(42,'https://down-vn.img.susercontent.com/file/fe2076edc1e2372e9d5069ac32a7940b.webp'),
(43,'https://down-vn.img.susercontent.com/file/sg-11134201-7rdwv-lylbdha8mtzuce.webp'),
(43,'https://down-vn.img.susercontent.com/file/sg-11134201-7rdvh-lylbdi33gljab6.webp'),
(43,'https://down-vn.img.susercontent.com/file/sg-11134201-7rdyj-lylbj52oeue2f5.webp'),
(44,'https://down-vn.img.susercontent.com/file/sg-11134201-7qvfq-lhrxnwpzjzg780.webp'),
(44,'https://down-vn.img.susercontent.com/file/sg-11134201-7qvcq-lhrxo4is52rb70.webp'),
(44,'https://down-vn.img.susercontent.com/file/sg-11134201-7qvec-lhrxo3q7cat45b.webp');






