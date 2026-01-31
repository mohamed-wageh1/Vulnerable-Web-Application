create database portal;
use portal;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255),
    role VARCHAR(20),
    bio TEXT
);
INSERT INTO users (username, password, role)
VALUES 
('admin@corp.local', 'admin123', 'admin'),
('employee@corp.local', 'employee123', 'employee');
CREATE TABLE messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  content TEXT
);