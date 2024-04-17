CREATE DATABASE verka;

USE verka;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    cn VARCHAR(255) NOT NULL,
    selection VARCHAR(255) NOT NULL,
    houseadd VARCHAR(255) NOT NULL,
    apartment VARCHAR(255),
    city VARCHAR(255) NOT NULL,
    state VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);