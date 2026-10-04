CREATE DATABASE IF NOT EXISTS student_management;

USE student_management;

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    course VARCHAR(100) NOT NULL,
    gender VARCHAR(20) NOT NULL,
    city VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO students
(name, email, phone, course, gender, city)
VALUES
('Rahul Sharma', 'rahul@gmail.com', '9876543210', 'BCA', 'Male', 'Bhopal'),
('Priya Patel', 'priya@gmail.com', '9876543211', 'BBA', 'Female', 'Ahmedabad'),
('Aman Kumar', 'aman@gmail.com', '9876543212', 'B.Tech', 'Male', 'Indore');