<?php

require_once('./../models/Student.php');
require_once('./../models/StudentEntity.php');

class StudentController
{
    public function __construct(Student $studentModel)
    {
        $this->studentModel = $studentModel;
    }

    public function index()
    {
        $students = $this->studentModel->getAll();
        include __DIR__ . '/../views/student/index.php';
    }

    public function showAddStudentForm()
    {
        include __DIR__ . '/../views/student/create.php';
    }

    public function addStudent($fullName, $phone, $email)
    {
        $student = new StudentEntity();
        $student->setFullName($fullName);
        $student->setPhone($phone);
        $student->setEmail($email);
        
        $this->studentModel->save($student);
        
        header('Location: index.php?action=view_student');
    }

    public function edit($id)
    {
        $student = $this->studentModel->find($id);
        include __DIR__ . '/../views/student/edit.php';
    }

    public function update($id, $fullName, $phone, $email)
    {
        $student = new StudentEntity();
        $student->setFullName($fullName);
        $student->setPhone($phone);
        $student->setEmail($email);
        $this->studentModel->update($id, $student);
        header('Location: index.php?action=view_student');
    }

    public function delete($id)
    {
        $this->studentModel->delete($id);
        header('Location: index.php?action=view_student');
    }
}

?>
