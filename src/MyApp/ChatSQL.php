<?php


namespace MyApp;


class ChatSQL
{
    protected $link;
    protected $host = '192.168.1.5';
    protected $user = 'root';
    protected $password = '';

    public function __construct()
    {
        $this->open();

        if (!$this->link) {
            die(mysqli_error($this->link));
        }

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

        $this->close();
    }

    public function open()
    {
        $this->link = mysqli_connect($this->host, $this->user, $this->password);
        mysqli_query($this->link, "SET NAMES 'utf8'") or die(mysqli_error($this->link));
        mysqli_query($this->link, "CREATE DATABASE IF NOT EXISTS chat;") or die(mysqli_error($this->link));
        mysqli_query($this->link, "USE chat;") or die(mysqli_error($this->link));
    }

    public function close()
    {
        $this->link->close();
    }

    public function createUser($ip)
    {
        $this->open();

        $result = mysqli_query($this->link, "SELECT * FROM users WHERE ip = '{$ip}'") or die(mysqli_error($this->link));
        $data = null;

        if($result->num_rows == 0) {
            mysqli_query($this->link, "INSERT INTO users (ip, name, color) VALUES('{$ip}', 'anonymous', '#000')") or die(mysqli_error($this->link));
            $data['ip'] = $ip;
            $data['name'] = 'anonymous';
            $data['color'] = '#000';
        } else {
            while ($row = $result->fetch_assoc()) {
                $data['ip'] = $row['ip'];
                $data['name'] = $row['name'];
                $data['color'] = $row['color'];
            }
        }

        $this->close();

        return $data;
    }
}