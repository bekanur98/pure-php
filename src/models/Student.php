<?php

require_once __DIR__ . '/StudentEntity.php';

class Student
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        try {

            $query = "SELECT 
                id AS student_id,
                full_name,
                phone,
                email
            FROM students";
            
            $result = $this->db->query($query);
            
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Throwable $e) {
            var_dump($e->getMessage());
            die();
        } 
    }

    public function find($id)
    {
        try {

            $query = "SELECT 
                id AS student_id,
                full_name,
                phone,
                email
            FROM students WHERE id = ?";
            
            $statement = $this->db->prepare($query);
            $statement->bind_param('i', $id);
            $statement->execute();

            $result = $statement->get_result();

            return $result->fetch_assoc();
        } catch (Throwable $e) {
            var_dump($e->getMessage());
            die();
        } 
    }

    public function save(StudentEntity $student)
    {
        $query = "INSERT INTO students (full_name, phone, email)
                  VALUES (?, ?, ?)";

        $statement = $this->db->prepare($query);
        $statement->bind_param('sss', $student->getFullName(), $student->getPhone(), $student->getEmail());
        return $statement->execute();
    }

    public function update($id, StudentEntity $student)
    {
        $query = "UPDATE students set full_name = ?, phone = ?, email = ?
                  WHERE id = ?";

        $statement = $this->db->prepare($query);
        $statement->bind_param(
            'sssi', 
            $student->getFullName(), 
            $student->getPhone(), 
            $student->getEmail(), 
            $id
        );

        return $statement->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM students WHERE id = ?";

        $statement = $this->db->prepare($query);
        $statement->bind_param('i', $id);

        return $statement->execute();
    }
}
