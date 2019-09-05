<?php
$host = 'localhost';
$user = 'root';
$password = '';

$link = mysqli_connect($host, $user, $password);

if (!$link) {
    die(mysqli_error($link));
}

mysqli_query($link, "SET NAMES 'utf8'") or die(mysqli_error($link));
mysqli_query($link, "CREATE DATABASE IF NOT EXISTS chat;") or die(mysqli_error($link));
mysqli_query($link, "USE chat;") or die(mysqli_error($link));
mysqli_query($link, "CREATE TABLE IF NOT EXISTS users (
    ip VARCHAR(45) UNIQUE,
    name VARCHAR(100),
    color VARCHAR(7),
    PRIMARY KEY(ip)
)") or die(mysqli_error($link));

mysqli_query($link, "CREATE TABLE IF NOT EXISTS messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ip VARCHAR(45),
    name VARCHAR(100),
    color VARCHAR(7),
    text VARCHAR(300),
    date VARCHAR(10),
    FOREIGN KEY (ip) REFERENCES users (ip) ON DELETE CASCADE
)") or die(mysqli_error($link));