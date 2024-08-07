-- Crear la base de datos y usarla
CREATE DATABASE IF NOT EXISTS db_reservas;
USE db_reservas;

-- Crear la tabla de Usuarios
CREATE TABLE IF NOT EXISTS tb_usuarios (
    u_id INT AUTO_INCREMENT PRIMARY KEY,
    u_nombre VARCHAR(255) NOT NULL,
    u_email VARCHAR(255) NOT NULL UNIQUE,
    u_contrasena VARCHAR(255) NOT NULL,
    u_rol VARCHAR(50) NOT NULL,
    u_creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    u_actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    u_session_token VARCHAR(255) NULL
);

-- Insertar datos en la tabla de Usuarios
INSERT INTO tb_usuarios (u_nombre, u_email, u_contrasena, u_rol, u_session_token) VALUES
('Juan Pérez', 'juan.perez@example.com', 'contrasena123', 'usuario', NULL),
('Ana Gómez', 'ana.gomez@example.com', 'contrasena123', 'usuario', NULL),
('Carlos Sánchez', 'carlos.sanchez@example.com', 'contrasena123', 'admin', NULL),
('María López', 'maria.lopez@example.com', 'contrasena123', 'usuario', NULL),
('Pedro Fernández', 'pedro.fernandez@example.com', 'contrasena123', 'usuario', NULL);

-- Crear la tabla de Categorías
CREATE TABLE IF NOT EXISTS tb_categorias (
    c_id INT AUTO_INCREMENT PRIMARY KEY,
    c_nombre VARCHAR(255) NOT NULL,
    c_descripcion TEXT
);

-- Insertar datos en la tabla de Categorías
INSERT INTO tb_categorias (c_nombre, c_descripcion) VALUES
('Urban', 'Escenarios urbanos con edificios y calles'),
('Forest', 'Escenarios en áreas boscosas'),
('Desert', 'Escenarios en áreas desérticas'),
('CQB', 'Escenarios de combate en espacios cerrados'),
('Mixed', 'Escenarios mixtos con varias características');

-- Crear la tabla de Escenarios
CREATE TABLE IF NOT EXISTS tb_escenarios (
    e_id INT AUTO_INCREMENT PRIMARY KEY,
    e_nombre VARCHAR(255) NOT NULL,
    e_descripcion TEXT,
    e_ubicacion VARCHAR(255) NOT NULL,
    e_capacidad INT NOT NULL,
    e_categoria_id INT,
    e_precio_por_hora DECIMAL(10, 2) NOT NULL,
    e_precio_por_dia DECIMAL(10, 2) NOT NULL,
    e_creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    e_actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (e_categoria_id) REFERENCES tb_categorias(c_id)
);

-- Insertar datos en la tabla de Escenarios
INSERT INTO tb_escenarios (e_nombre, e_descripcion, e_ubicacion, e_capacidad, e_categoria_id, e_precio_por_hora, e_precio_por_dia) VALUES
('Urban Warfare', 'Escenario urbano con edificios y vehículos', 'Ciudad A', 100, 1, 50.00, 400.00),
('Forest Ambush', 'Escenario en bosque con árboles y arbustos', 'Bosque B', 80, 2, 40.00, 300.00),
('Desert Siege', 'Escenario desértico con dunas y edificios abandonados', 'Desierto C', 60, 3, 45.00, 350.00),
('CQB Training', 'Escenario de combate en espacios cerrados', 'Base D', 50, 4, 60.00, 450.00),
('Mixed Battle', 'Escenario mixto con varias características', 'Zona E', 120, 5, 55.00, 420.00);

-- Crear la tabla de Equipos
CREATE TABLE IF NOT EXISTS tb_equipos (
    eq_id INT AUTO_INCREMENT PRIMARY KEY,
    eq_nombre VARCHAR(255) NOT NULL,
    eq_descripcion TEXT,
    eq_categoria_id INT,
    eq_precio_por_hora DECIMAL(10, 2) NOT NULL,
    eq_precio_por_dia DECIMAL(10, 2) NOT NULL,
    eq_cantidad_disponible INT NOT NULL,
    eq_creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    eq_actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (eq_categoria_id) REFERENCES tb_categorias(c_id)
);

-- Insertar datos en la tabla de Equipos
INSERT INTO tb_equipos (eq_nombre, eq_descripcion, eq_categoria_id, eq_precio_por_hora, eq_precio_por_dia, eq_cantidad_disponible) VALUES
('Rifle M4', 'Rifle de asalto M4', 1, 10.00, 80.00, 30),
('Pistola Glock', 'Pistola Glock 17', 2, 5.00, 40.00, 50),
('Francotirador', 'Rifle de francotirador', 3, 15.00, 120.00, 10),
('Granada de humo', 'Granada de humo de diferentes colores', 4, 2.00, 15.00, 100),
('Chaleco táctico', 'Chaleco táctico con bolsillos', 5, 3.00, 25.00, 20);

-- Crear la tabla de Reservas
CREATE TABLE IF NOT EXISTS tb_reservas (
    r_id INT AUTO_INCREMENT PRIMARY KEY,
    r_usuario_id INT,
    r_escenario_id INT,
    r_fecha_inicio DATE NOT NULL,
    r_fecha_fin DATE NOT NULL,
    r_costo_total DECIMAL(10, 2) NOT NULL,
    r_estado VARCHAR(50) NOT NULL,
    r_creada_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    r_actualizada_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    r_contacto_nombre VARCHAR(255) NULL,
    r_contacto_correo VARCHAR(255) NULL,
    r_contacto_apellidos VARCHAR(255) NULL,
    FOREIGN KEY (r_usuario_id) REFERENCES tb_usuarios(u_id),
    FOREIGN KEY (r_escenario_id) REFERENCES tb_escenarios(e_id)
);

-- Insertar datos en la tabla de Reservas
INSERT INTO tb_reservas (r_usuario_id, r_escenario_id, r_fecha_inicio, r_fecha_fin, r_costo_total, r_estado, r_contacto_nombre, r_contacto_correo, r_contacto_apellidos) VALUES
(1, 1, '2024-08-10', '2024-08-12', 800.00, 'confirmado', 'Juan Pérez', 'juan.perez@example.com', 'Pérez'),
(2, 2, '2024-08-15', '2024-08-17', 600.00, 'pendiente', 'Ana Gómez', 'ana.gomez@example.com', 'Gómez'),
(3, 3, '2024-08-20', '2024-08-22', 700.00, 'confirmado', 'Carlos Sánchez', 'carlos.sanchez@example.com', 'Sánchez'),
(4, 4, '2024-08-25', '2024-08-27', 900.00, 'pendiente', 'María López', 'maria.lopez@example.com', 'López'),
(5, 5, '2024-08-30', '2024-09-01', 840.00, 'confirmado', 'Pedro Fernández', 'pedro.fernandez@example.com', 'Fernández');

-- Crear la tabla de Pagos
CREATE TABLE IF NOT EXISTS tb_pagos (
    p_id INT AUTO_INCREMENT PRIMARY KEY,
    p_reserva_id INT,
    p_monto DECIMAL(10, 2) NOT NULL,
    p_metodo VARCHAR(50) NOT NULL,
    p_estado VARCHAR(50) NOT NULL,
    p_creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (p_reserva_id) REFERENCES tb_reservas(r_id)
);

-- Insertar datos en la tabla de Pagos
INSERT INTO tb_pagos (p_reserva_id, p_monto, p_metodo, p_estado) VALUES
(1, 800.00, 'tarjeta', 'pagado'),
(2, 600.00, 'paypal', 'pendiente'),
(3, 700.00, 'tarjeta', 'pagado'),
(4, 900.00, 'efectivo', 'pendiente'),
(5, 840.00, 'paypal', 'pagado');

-- Crear la tabla de Reservas_Equipos
CREATE TABLE IF NOT EXISTS tb_reservas_equipos (
    re_id INT AUTO_INCREMENT PRIMARY KEY,
    re_reserva_id INT,
    re_equipo_id INT,
    re_cantidad INT NOT NULL,
    FOREIGN KEY (re_reserva_id) REFERENCES tb_reservas(r_id),
    FOREIGN KEY (re_equipo_id) REFERENCES tb_equipos(eq_id)
);

-- Insertar datos en la tabla de Reservas_Equipos
INSERT INTO tb_reservas_equipos (re_reserva_id, re_equipo_id, re_cantidad) VALUES
(1, 1, 5),
(2, 2, 10),
(3, 3, 2),
(4, 4, 20),
(5, 5, 7);
