use computadora_db;

CREATE TABLE computadoras (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    marca VARCHAR(255) NOT NULL,
    modelo VARCHAR(255) NOT NULL,
    ram INT(11) NOT NULL,
    procesador VARCHAR(255) NOT NULL,
    almacenamiento INT(11) NOT NULL
);

INSERT INTO computadoras (marca, modelo, ram, procesador, almacenamiento) VALUES 
    ('HP', 'OMEN', 6, 'i5 12th G', 600),
    ('ASUS', 'GAMER 4K', 16, 'i7 12th G', 1024);

CREATE USER 'admin'@'%' IDENTIFIED BY 'admin12345';
GRANT ALL PRIVILEGES ON *.* TO 'admin'@'%';
FLUSH PRIVILEGES;

