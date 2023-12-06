<?php
try {
    $config = require_once __DIR__ . '/../config/database.php';
    require_once __DIR__ . '/../models/Schedule.php';
    require_once __DIR__ . '/../models/Student.php';
    require_once __DIR__ . '/../controllers/ScheduleController.php';
    require_once __DIR__ . '/../controllers/StudentController.php';

    $db = new mysqli($config['host'], $config['username'], $config['password'], $config['database']);
    
    $action = isset($_GET['action']) ? $_GET['action'] : '';

    $scheduleController = new ScheduleController(new Schedule($db));
    $studentController = new StudentController(new Student($db));

    switch ($action) {
        case 'view_schedule':
            $scheduleController->index();
            break;
        case 'add_schedule':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $studentId = $_POST['student_id'];
                $courseId = $_POST['course_id'];
                $teacherId = $_POST['teacher_id'];
                $datetime = $_POST['datetime'];
    
                $scheduleController->addSchedule($studentId, $courseId, $teacherId, $datetime);
            } else {
                $errorMessage = $_GET['error'] ?? null;
                $scheduleController->showAddSheduleForm($errorMessage);
            }
            break;
        case 'view_student':
            $studentController->index();
            break;
        case 'add_student':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $fullName = $_POST['full_name'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $studentController->addStudent($fullName, $phone, $email);
            } else {
                $studentController->showAddStudentForm();
            }
            break;
        case 'edit_student':
            $id = $_GET['id'] ?? null;
            if ($id) {
                $studentController->edit($id);
                break;
            }
            $studentController->index();
            break;
        case 'update_student':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['student_id'];
                $fullName = $_POST['full_name'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $studentController->update($id, $fullName, $phone, $email);
            } else {
                $studentController->index();
            }
            break;
        case 'delete_student':
            $id = $_GET['id'] ?? null;
            if ($id) {
                $studentController->delete($id);
                break;
            }
            $studentController->index();
            break;
        default:
            $scheduleController->index();
            break;
    }
} catch (Throwable $e) {
    var_dump([$e->getMessage(), $e->getTraceAsString()]);
    die();
}

