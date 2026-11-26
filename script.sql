-- Active: 1772525806919@@127.0.0.1@3306@velo
CREATE DATABASE IF NOT EXISTS velo utf8mb4;
USE velo;

 DROP TABLE IF EXISTS reservations;
DROP TABLE IF EXISTS bikes;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
   user_id INT AUTO_INCREMENT,
   firstname VARCHAR(255) NOT NULL,
   lastname VARCHAR(255) NOT NULL,
   login VARCHAR(50) NOT NULL,
   password VARCHAR(255) NOT NULL,
   role ENUM('user', 'employee', 'admin') NOT NULL DEFAULT 'user',
   PRIMARY KEY (user_id),
   UNIQUE (login)
);

CREATE TABLE bikes (
   bike_id INT AUTO_INCREMENT,
   registration_number VARCHAR(50) NOT NULL,
   availability BOOLEAN NOT NULL DEFAULT 1,
   photo VARCHAR(255),
   PRIMARY KEY (bike_id),
   UNIQUE (registration_number)
);

CREATE TABLE reservations (
   res_num INT AUTO_INCREMENT,
   user_id INT NOT NULL,
   bike_id INT NOT NULL,
   res_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   start_date DATETIME NOT NULL,
   end_date DATETIME NOT NULL,
   status ENUM('pending', 'accepted', 'rejected') NOT NULL DEFAULT 'pending',
   PRIMARY KEY (res_num),
   FOREIGN KEY (user_id) REFERENCES users(user_id),
   FOREIGN KEY (bike_id) REFERENCES bikes(bike_id)
);


INSERT INTO users (firstname, lastname, login, password, role) VALUES
('Admin',  'Mairie',  'admin', '$2y$12$JOjTP7a1M85yn5aqTQQXdOPI/PxgxlVkIgw18NwSWaVDependBhUq', 'admin'),
('Sophie', 'Martin',  'employe1', '$2y$12$JOjTP7a1M85yn5aqTQQXdOPI/PxgxlVkIgw18NwSWaVDependBhUq', 'employee'),
('Karim',  'Benali',  'employe2', '$2y$12$JOjTP7a1M85yn5aqTQQXdOPI/PxgxlVkIgw18NwSWaVDependBhUq', 'employee'),
('Marie',  'Dupont',  'marie.dupont', '$2y$12$JOjTP7a1M85yn5aqTQQXdOPI/PxgxlVkIgw18NwSWaVDependBhUq', 'user'),
('Lucas',  'Bernard', 'lucas.bernard', '$2y$12$JOjTP7a1M85yn5aqTQQXdOPI/PxgxlVkIgw18NwSWaVDependBhUq', 'user'),
('Emma',   'Petit',   'emma.petit', '$2y$12$JOjTP7a1M85yn5aqTQQXdOPI/PxgxlVkIgw18NwSWaVDependBhUq', 'user');
/* Identifiants de démonstration :
- Login : admin
- Mot de passe : Admin123!*/

INSERT INTO bikes (registration_number, availability, photo) VALUES
('VEL-001', 1, 'velo1.jpg'),
('VEL-002', 1, 'velo2.jpg'),
('VEL-003', 1, 'velo3.jpg'),
('VEL-004', 1, 'velo4.jpg'),
('VEL-005', 0, 'velo5.jpg'),
('VEL-006', 1, 'velo6.jpg');

INSERT INTO reservations (user_id, bike_id, start_date, end_date, status) VALUES
(4, 1, '2026-12-01', '2026-12-03  ', 'pending'),
(5, 2, '2026-12-02', '2026-12-02  ', 'pending'),
(6, 3, '2026-12-05', '2026-12-07  ', 'pending'),
(4, 2, '2026-11-28', '2026-11-29  ', 'accepted'),
(5, 4, '2026-11-26', '2026-11-27  ', 'rejected');