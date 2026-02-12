CREATE DATABASE IF NOT EXISTS tienda_fiestas;
USE tienda_fiestas;

CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT
);

CREATE TABLE roles_permissions (
    role_id INT NOT NULL,
    permission_id INT NOT NULL,
    PRIMARY KEY (role_id, permission_id),
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
    FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol VARCHAR(50) DEFAULT 'cliente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL,
    created_by INT NULL,
    updated_by INT NULL,
    deleted_by INT NULL
);

CREATE TABLE user_roles (
    user_id INT NOT NULL,
    role_id INT NOT NULL,
    assigned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, role_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL, 
    stock INT NOT NULL DEFAULT 0,
    image VARCHAR(255) NULL,       
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE invoices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    status VARCHAR(20) DEFAULT 'completado',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE invoice_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invoice_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (invoice_id) REFERENCES invoices(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO roles (id, name) VALUES 
(1, 'admin'),
(2, 'empleado'),
(3, 'cliente');

INSERT INTO permissions (id, name, description) VALUES
(1, 'ver_dashboard_admin', 'Acceso total al panel'),
(2, 'gestionar_productos', 'Crear y editar productos'),
(3, 'gestionar_usuarios', 'Crear y editar usuarios'),
(4, 'ver_mis_compras', 'Ver historial de pedidos propios');

INSERT INTO roles_permissions (role_id, permission_id) VALUES 
(1, 1), (1, 2), (1, 3),
(2, 2),
(3, 4);

INSERT INTO users (nombre, apellido, email, password, rol) VALUES 
('Carlos', 'Administrador', 'admin@correo.com', '123456', 'admin'),
('Laura', 'Vendedora', 'empleado@correo.com', '123456', 'empleado'),
('Pepe', 'Comprador', 'cliente@correo.com', '123456', 'cliente');

INSERT INTO user_roles (user_id, role_id) VALUES 
(1, 1),
(2, 2),
(3, 3);

INSERT INTO products (name, description, price, stock, image) VALUES 
('Kit de Globos Dorados', 'Paquete de 50 globos metálicos y de látex color oro.', 15.50, 100, NULL),
('Máquina de Humo', 'Máquina de humo compacta para fiestas en casa.', 45.00, 10, NULL),
('Luces LED Neón', 'Tira de luces LED RGB de 5 metros con control remoto.', 12.99, 50, NULL);

INSERT INTO invoices (user_id, total_amount, status) VALUES (3, 28.49, 'completado');

INSERT INTO invoice_items (invoice_id, product_id, quantity, unit_price) VALUES 
(1, 1, 1, 15.50),
(1, 3, 1, 12.99);