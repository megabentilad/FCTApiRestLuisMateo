/**
 * Author:  Luis Mateo Rivera Uriarte
 * Created: 09-may-2020
 */

-- Crear base de datos
    CREATE DATABASE if NOT EXISTS apiREST_Autentication;
-- Uso de la base de datos
    USE apiREST_Autentication;

    CREATE TABLE IF NOT EXISTS Usuarios(
        name varchar(25) PRIMARY KEY,
        password varchar(255) NOT null,
        token varchar(255) NOT null,
        num_uses int default 0 NOT null
    );

    CREATE TABLE IF NOT EXISTS tmp_tokens(
        name varchar(25) PRIMARY KEY,
        token varchar(255) DEFAULT null,
        date date DEFAULT null,
        FOREIGN KEY (name) REFERENCES Usuarios(name) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB;

-- Crear evento de eliminación de tokens temporales
    CREATE EVENT eliminar_tokens_temporales ON SCHEDULE EVERY 30 MINUTE ON COMPLETION NOT PRESERVE ENABLE DO UPDATE tmp_tokens SET tmp_tokens.token = null, tmp_tokens.date = null where tmp_tokens.date < CURDATE() - INTERVAL 1 DAY;
-- Crear del usuario
    CREATE USER IF NOT EXISTS 'administradorApiAutentication'@'%' IDENTIFIED BY 'paso1234'; 
-- Dar permisos al usuario
    GRANT ALL PRIVILEGES ON apiREST_Autentication.* TO 'administradorApiAutentication'@'%'; 
-- Hacer el flush privileges, por si acaso
    FLUSH PRIVILEGES;
