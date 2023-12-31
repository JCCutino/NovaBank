DROP DATABASE IF EXISTS NovaBank;

CREATE DATABASE NovaBank;
USE NovaBank;


CREATE TABLE Persona (
    ID_Persona INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255),
    Apellidos VARCHAR(255),
    DNI VARCHAR(255),
    Fecha_nacimiento DATE,
    Direccion VARCHAR(255),
    CP VARCHAR(255),
    Ciudad VARCHAR(255),
    Provincia VARCHAR(255),
    Pais VARCHAR(255),
    Correo_Electronico VARCHAR(255),
    Contrasena VARCHAR(255),
    Url_Foto VARCHAR(255)
);

CREATE TABLE Mensajes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    mensaje TEXT,
    idEmisor INT,
    idReceptor INT
);

CREATE TABLE Cuenta (
    IBAN VARCHAR(255) PRIMARY KEY,
    Saldo DECIMAL(15, 2),
    Fecha_Apertura DATE,
    ID_Persona INT,
    FOREIGN KEY (ID_Persona) REFERENCES Persona(ID_Persona)
);


CREATE TABLE Transaccion (
    ID_Transaccion INT PRIMARY KEY AUTO_INCREMENT,
    Tipo_Transaccion VARCHAR(50),
    Cantidad DECIMAL(15, 2),
    Fecha_Hora VARCHAR(50),
    IBAN VARCHAR(255),
    FOREIGN KEY (IBAN) REFERENCES Cuenta(IBAN)
);

CREATE TABLE Prestamo (
    ID_Prestamo INT PRIMARY KEY AUTO_INCREMENT,
    Cantidad DECIMAL(15, 2),
    Concepto VARCHAR (255),
    Tasa_Interes DECIMAL(5, 2),
    Plazo_Prestamo INT,
    Estado_Prestamo VARCHAR(50),
    Fecha_Solicitud DATE,
    Fecha_Aprobacion DATE,
    Fecha_Pago DATE,
    Deuda DECIMAL (15, 2),
    ID_Persona INT,
    IBAN VARCHAR(255),
    FOREIGN KEY (ID_Persona) REFERENCES Persona(ID_Persona),
    FOREIGN KEY (IBAN) REFERENCES Cuenta(IBAN)
);

INSERT INTO Persona (Nombre, Correo_Electronico, Contrasena) 
VALUES ('admin', 'admin@admin.com', 'admin2023');


INSERT INTO Cuenta (IBAN, Saldo, Fecha_Apertura, ID_Persona) 
VALUES ('1111111111111111', 0.00, CURDATE(), 1);

