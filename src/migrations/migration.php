<?php

class Migration {
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function up() {
        $query = "CREATE TABLE IF NOT EXISTS courses (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL
        );
        
        CREATE TABLE IF NOT EXISTS teachers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            full_name VARCHAR(255) NOT NULL,
            course_id INT,
            FOREIGN KEY (course_id) REFERENCES courses(id)
        );


        CREATE TABLE IF NOT EXISTS students (
            id INT AUTO_INCREMENT PRIMARY KEY,
            full_name VARCHAR(255) NOT NULL,
            phone VARCHAR(20) NOT NULL,
            email VARCHAR(255) NOT NULL
        );

        CREATE TABLE IF NOT EXISTS schedule (
            id INT AUTO_INCREMENT PRIMARY KEY,
            student_id INT,
            course_id INT,
            teacher_id INT,
            time DATETIME NOT NULL,
            FOREIGN KEY (student_id) REFERENCES students(id),
            FOREIGN KEY (course_id) REFERENCES courses(id),
            FOREIGN KEY (teacher_id) REFERENCES teachers(id)
        );
        ";

        $this->db->query($query);

        echo true;
    }

    public function down() {
        $query = "
            DROP TABLE IF EXISTS courses; 
            DROP TABLE IF EXISTS teachers; 
            DROP TABLE IF EXISTS students; 
            DROP TABLE IF EXISTS schedule; 
            ";

        $this->db->query($query);

        echo true;
    }
}