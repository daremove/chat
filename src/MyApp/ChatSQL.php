<?php


namespace MyApp;


class ChatSQL
{
    protected $link;

    public function __construct()
    {
        $host = 'localhost';
        $user = 'root';
        $password = '';

        $this->link = mysqli_connect($host, $user, $password);

        if (!$this->link) {
            die(mysqli_error($this->link));
        }

        mysqli_query($this->link, "SET NAMES 'utf8'") or die(mysqli_error($this->link));
        mysqli_query($this->link, "CREATE DATABASE IF NOT EXISTS chat;") or die(mysqli_error($this->link));
        mysqli_query($this->link, "USE chat;") or die(mysqli_error($this->link));
        mysqli_query($this->link, "CREATE TABLE IF NOT EXISTS users (
                                            ip VARCHAR(45) UNIQUE,
                                            name VARCHAR(100),
                                            color VARCHAR(7),
                                            PRIMARY KEY(ip)
                                        )") or die(mysqli_error($this->link));

        mysqli_query($this->link, "CREATE TABLE IF NOT EXISTS messages (
                                            id INT PRIMARY KEY AUTO_INCREMENT,
                                            ip VARCHAR(45),
                                            name VARCHAR(100),
                                            color VARCHAR(7),
                                            text VARCHAR(300),
                                            date VARCHAR(10),
                                            FOREIGN KEY (ip) REFERENCES users (ip) ON DELETE CASCADE
                                        )") or die(mysqli_error($this->link));
    }

    public function createUser($ip)
    {
        $result = mysqli_query($this->link, "SELECT * FROM users WHERE ip = '{$ip}'") or die(mysqli_error($this->link));

        if($result->num_rows == 0) {
            $result = mysqli_query($this->link, "INSERT INTO users (ip, name, color) VALUES('{$ip}', 'anonymous', '#000')") or die(mysqli_error($this->link));
        }

        $data = null;

        while ($row = $result->fetch_assoc()) {
            $data['ip'] = $row['ip'];
            $data['name'] = $row['name'];
            $data['color'] = $row['color'];
        }
        return $data;
    }
}