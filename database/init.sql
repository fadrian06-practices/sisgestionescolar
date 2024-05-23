CREATE DATABASE IF NOT EXISTS sisgestionescolar;
USE sisgestionescolar;
SET foreign_key_checks = 0;

DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS roles;

CREATE TABLE roles (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL UNIQUE,
  fechaRegistro DATETIME NOT NULL,
  fechaActualizacion DATETIME,
  activo BOOL NOT NULL DEFAULT TRUE
);

CREATE TABLE usuarios (
  id INTEGER PRIMARY KEY AUTO_INCREMENT,
  nombreCompleto VARCHAR(255) NOT NULL UNIQUE,
  correo VARCHAR(255) NOT NULL UNIQUE,
  clave TEXT NOT NULL,
  fechaRegistro DATETIME NOT NULL,
  fechaActualizacion DATETIME,
  activo BOOL NOT NULL DEFAULT TRUE,
  idRol INTEGER NOT NULL,

  FOREIGN KEY (idRol) REFERENCES roles (id)
);

INSERT INTO roles (id, nombre, fechaRegistro) VALUES
(1, 'Administrador', '2024-05-23 13:45:59'),
(2, 'Director Académico', '2024-05-23 13:45:59'),
(3, 'Director Administrativo', '2024-05-23 13:45:59'),
(4, 'Contador', '2024-05-23 13:45:59'),
(5, 'Secretaría', '2024-05-23 13:45:59');

INSERT INTO usuarios (nombreCompleto, correo, clave, fechaRegistro, idRol)
VALUES ('Franyer Adrián Sánchez Guillén', 'admin@admin.com',
'$2y$10$2p6WabqPlfHVzApQzHtt3uMjVesbus4qWN7prb3CfhfdOQdxhwXZK',
'2024-05-23 00:47:13', 1);
