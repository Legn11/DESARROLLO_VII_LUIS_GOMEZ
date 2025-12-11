
CREATE DATABASE techparts_db;

USE techparts_db;

CREATE TABLE productos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(120) NOT NULL,
    categoria VARCHAR(80) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    cantidad INT NOT NULL,
    fecha_registro DATETIME DEFAULT NOW()
);
