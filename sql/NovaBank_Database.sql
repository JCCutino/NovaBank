DROP DATABASE IF EXISTS NovaBank;

CREATE DATABASE NovaBank;
USE NovaBank;


CREATE TABLE Persona (
    ID_Persona INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(255),
    Apellidos VARCHAR(255),
    Correo_Electronico VARCHAR(255),
    Contrasena VARCHAR(255),
    Url_Foto VARCHAR(255)
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
    Fecha_Hora DATETIME,
    IBAN VARCHAR(255),
    FOREIGN KEY (IBAN) REFERENCES Cuenta(IBAN)
);

CREATE TABLE Prestamo (
    ID_Prestamo INT PRIMARY KEY AUTO_INCREMENT,
    Cantidad DECIMAL(15, 2),
    Tasa_Interes DECIMAL(5, 2),
    Plazo_Prestamo INT,
    Estado_Prestamo VARCHAR(50),
    Fecha_Solicitud DATE,
    Fecha_Aprobacion DATE,
    Fecha_Pago DATE,
    ID_Persona INT,
    IBAN VARCHAR(255),
    FOREIGN KEY (ID_Persona) REFERENCES Persona(ID_Persona),
    FOREIGN KEY (IBAN) REFERENCES Cuenta(IBAN)
);