-- 1. Base de datos
CREATE DATABASE IF NOT EXISTS obra_social;
USE obra_social;

-- 2. Tabla delegaciones
CREATE TABLE IF NOT EXISTS delegaciones (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL
);

INSERT INTO delegaciones (nombre) VALUES
('Delegación 1'),
('Delegación 2'),
('Delegación 3'),
('Delegación 4'),
('Delegación 5'),
('Delegación 6'),
('Delegación 7'),
('Delegación 8'),
('Delegación 9'),
('Delegación 10');

-- 3. Tabla afiliados
CREATE TABLE IF NOT EXISTS afiliados (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  apellido VARCHAR(50) NOT NULL,
  dni VARCHAR(20) NOT NULL,
  fecha_nacimiento DATE NOT NULL,
  numero_afiliado VARCHAR(30) NOT NULL,
  delegacion_id INT NOT NULL,
  CONSTRAINT fk_afiliados_delegaciones
    FOREIGN KEY (delegacion_id)
    REFERENCES delegaciones(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

INSERT INTO afiliados 
(nombre, apellido, dni, fecha_nacimiento, numero_afiliado, delegacion_id)
VALUES
('Juan', 'Pérez', '12345678', '1985-01-15', 'AFI-001', 1),
('María', 'Gómez', '22345678', '1990-03-22', 'AFI-002', 2),
('Carlos', 'Ramírez', '32345678', '1982-07-09', 'AFI-003', 3),
('Lucía', 'Fernández', '42345678', '1979-12-05', 'AFI-004', 4),
('Pedro', 'Díaz', '52345678', '1988-05-18', 'AFI-005', 5),
('Sofía', 'Herrera', '62345678', '1992-11-30', 'AFI-006', 6),
('Miguel', 'Sosa', '72345678', '1977-02-10', 'AFI-007', 7),
('Andrea', 'López', '82345678', '1983-08-25', 'AFI-008', 8),
('Diego', 'Silva', '92345678', '1986-09-17', 'AFI-009', 9),
('Valeria', 'Ortiz', '10345678', '1991-04-02', 'AFI-010', 10);

-- 4. Tabla tipos_tramite
CREATE TABLE IF NOT EXISTS tipos_tramite (
  id INT AUTO_INCREMENT PRIMARY KEY,
  descripcion VARCHAR(100) NOT NULL
);

INSERT INTO tipos_tramite (descripcion) VALUES
('Trámite 1'),
('Trámite 2'),
('Trámite 3'),
('Trámite 4'),
('Trámite 5'),
('Trámite 6'),
('Trámite 7'),
('Trámite 8'),
('Trámite 9'),
('Trámite 10');

-- 5. Tabla tramites con delegacion_inicia_id
CREATE TABLE IF NOT EXISTS tramites (
  id INT AUTO_INCREMENT PRIMARY KEY,
  afiliado_id INT NOT NULL,
  tramite_id INT NOT NULL,
  delegacion_inicia_id INT NOT NULL,
  fecha_inicio DATE NOT NULL,
  observaciones VARCHAR(255) NULL,
  expediente VARCHAR(20) NOT NULL UNIQUE,
  usuario_carga VARCHAR(50) NOT NULL,

  CONSTRAINT fk_tramites_afiliados
    FOREIGN KEY (afiliado_id)
    REFERENCES afiliados(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,

  CONSTRAINT fk_tramites_tipos
    FOREIGN KEY (tramite_id)
    REFERENCES tipos_tramite(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,

  CONSTRAINT fk_tramites_delegaciones
    FOREIGN KEY (delegacion_inicia_id)
    REFERENCES delegaciones(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

INSERT INTO tramites 
(afiliado_id, tramite_id, delegacion_inicia_id, fecha_inicio, observaciones, expediente, usuario_carga)
VALUES
(1, 1, 1, '2023-01-10', 'Trámite de afiliación', 'EX-0001', 'admin'),
(2, 3, 2, '2023-01-12', 'Solicitud de cambio de plan', 'EX-0002', 'admin'),
(3, 5, 3, '2023-01-15', 'Solicitud de turnos', 'EX-0003', 'operador1'),
(4, 2, 4, '2023-02-01', 'Renovación de carnet', 'EX-0004', 'operador2'),
(5, 4, 1, '2023-02-08', 'Autorización de práctica', 'EX-0005', 'admin'),
(6, 7, 5, '2023-03-05', 'Reclamo de reintegro', 'EX-0006', 'operador1'),
(7, 6, 6, '2023-03-11', 'Emisión de recibo', 'EX-0007', 'admin'),
(8, 1, 8, '2023-03-15', 'Pedido de nueva credencial', 'EX-0008', 'operador2'),
(9, 9, 9, '2023-04-02', 'Cambio de datos personales', 'EX-0009', 'admin'),
(10, 10, 10, '2023-04-10', 'Control de reintegro', 'EX-0010', 'operador1');
