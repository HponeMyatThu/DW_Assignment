<?php
$comma = ",";

$create_admin_table = "
CREATE TABLE IF NOT EXISTS admin
    (
    id int not null auto_increment
    firstname varchar(50) not null
    surname varchar(50) not null
    email varchar(100) not null unique
    password varchar(255) not null
    pin varchar(10) not null
    phone varchar(30) not null unique
    address varchar(255) not null
    login_on_other_device enum('true', 'false') default 'false'
    status enum('ACTIVE', 'INACTIVE', 'PENDING') default 'PENDING'
    primary key(id)
    )";

$create_user_table = "
CREATE TABLE IF NOT EXISTS user
    (
    id int not null auto_increment
    firstname varchar(50) not null
    surname varchar(50) not null
    email varchar(100) not null unique
    password varchar(255) not null
    pin varchar(10) not null
    phone varchar(30) not null unique
    address varchar(255) not null
    login_on_other_device enum('true', 'false') default 'false'
    status enum('ACTIVE', 'INACTIVE', 'PENDING') default 'PENDING'
    primary key(id)
    )";

$create_contact_us_table = "
CREATE TABLE IF NOT EXISTS contact_us (
    id INT NOT NULL AUTO_INCREMENT, 
    email VARCHAR(100) NOT NULL, 
    phone VARCHAR(30) NOT NULL, 
    address VARCHAR(255) NOT NULL, 
    status enum('DONE', 'PENDING') default 'PENDING',
    user_id INT NOT NULL, 
    PRIMARY KEY(id), 
    FOREIGN KEY(user_id) REFERENCES user(id)
    )";

$create_media_table = "
CREATE TABLE IF NOT EXISTS media (
    id INT NOT NULL AUTO_INCREMENT, 
    name VARCHAR(50) NOT NULL,
    image VARCHAR(255) NOT NULL,
    media_link VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
    )";

$create_campign_type_table = "
CREATE TABLE IF NOT EXISTS campign_type (
    id INT NOT NULL AUTO_INCREMENT, 
    name VARCHAR(50) NOT NULL, 
    PRIMARY KEY(id)
    )";

$create_technique_table = "
CREATE TABLE IF NOT EXISTS technique (
        id INT NOT NULL AUTO_INCREMENT, 
        name VARCHAR(100) NOT NULL, 
        description TEXT NOT NULL, 
        image1 VARCHAR(255) NOT NULL, 
        image2 VARCHAR(255) NOT NULL, 
        media_id INT NOT NULL,
        PRIMARY KEY(id),
        FOREIGN KEY(media_id) REFERENCES media(id)
    );";

$create_campign_table = "
CREATE TABLE IF NOT EXISTS campign (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    image1 VARCHAR(255) NOT NULL,
    image2 VARCHAR(255) NOT NULL,
    image3 VARCHAR(255) NOT NULL,
    image4 VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL DEFAULT CURRENT_DATE,
    end_date DATE NOT NULL DEFAULT CURRENT_DATE,
    fees INT NOT NULL,
    aims VARCHAR(100) NOT NULL,
    vision VARCHAR(100) NOT NULL,
    map TEXT NOT NULL,
    status ENUM('ACTIVE', 'INACTIVE', 'DRAFT') DEFAULT 'DRAFT',
    media_id INT NOT NULL,
    camp_type_id INT NOT NULL,
    tech_id INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (media_id) REFERENCES media(id),
    FOREIGN KEY (camp_type_id) REFERENCES campign_type(id),
    FOREIGN KEY (tech_id) REFERENCES technique(id)
)";

$create_join_table = "
    CREATE TABLE IF NOT EXISTS `join` (
        id INT NOT NULL AUTO_INCREMENT,
        user_id INT NOT NULL,
        campign_id INT NOT NULL,
        status ENUM('REQUESTED', 'ACCEPTED', 'REJECTED') DEFAULT 'REQUESTED',
        register_date DATE NOT NULL DEFAULT CURRENT_DATE,
        PRIMARY KEY(id),
        FOREIGN KEY (user_id) REFERENCES user(id),
        FOREIGN KEY (campign_id) REFERENCES campign(id)
    );";
