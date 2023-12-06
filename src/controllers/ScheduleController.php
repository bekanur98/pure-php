<?php
require_once('./../models/Schedule.php');

class ScheduleController
{
    public function __construct(Schedule $scheduleModel)
    {
        $this->scheduleModel = $scheduleModel;
    }

    public function index()
    {
        try {
            $schedule = $this->scheduleModel->getScheduleForWeek();        

            include __DIR__ . '/../views/index.php';
        } catch (Throwable $e) {
            var_dump($e->getMessage());
        }
    }

    public function addSchedule($studentId, $courseId, $teacherId, $datetime)
    {

        // Проверка на невозможность добавить учеников на одно и тоже время по расписанию
        if (!$this->scheduleModel->isStudentFreeAtTime($studentId, $datetime)) {
            header('Location: index.php?action=add_schedule&error=Этот ученик уже занят в это время.');
            exit;
        }

        // Проверка на невозможность выбрать преподавателя повторно на одинаковое время (если он уже занят на другой курс)
        if (!$this->scheduleModel->isTeacherFreeAtTime($teacherId, $datetime)) {
            header('Location: index.php?action=add_schedule&error=Этот преподаватель уже занят в это время.');
            exit;
        }

        $success = $this->scheduleModel->addEntry($studentId, $courseId, $teacherId, $datetime);

        if ($success) {
            header('Location: index.php?action=view_schedule');
            exit;
        } else {
            header('Location: index.php?action=add_schedule&error=Неизвестная ошибка при добавлении ученика в расписание.');
            exit;
        }
    }

    public function showAddSheduleForm($errorMessage = null) {
        $students = $this->scheduleModel->getStudents();
        $courses = $this->scheduleModel->getCourses();
        $teachers = $this->scheduleModel->getTeachers();
        $errorMessage;

        include __DIR__ . '/../views/add_schedule_form.php';
    }
}

?>
