<?php

class Schedule
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getScheduleForWeek()
    {
        try {

            $query = "SELECT 
                schedule.id AS schedule_id,
                courses.name AS course_name,
                teachers.full_name AS teacher_name,
                students.full_name AS student_name,
                schedule.time
            FROM schedule
            INNER JOIN courses ON schedule.course_id = courses.id
            INNER JOIN teachers ON schedule.teacher_id = teachers.id
            INNER JOIN students ON schedule.student_id = students.id
            WHERE schedule.time >= CURDATE() AND schedule.time <= DATE_ADD(CURDATE(), INTERVAL 1 WEEK)
            ORDER BY schedule.time;";
            
            $result = $this->db->query($query);
            
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Throwable $e) {
            var_dump($e->getMessage());
            die();
        }
        
    }

    public function addEntry($studentId, $courseId, $teacherId, $time)
    {
        $query = "INSERT INTO schedule (student_id, course_id, teacher_id, time)
                  VALUES (?, ?, ?, ?)";

        $statement = $this->db->prepare($query);
        $statement->bind_param('iiis', $studentId, $courseId, $teacherId, $time);

        return $statement->execute();
    }

    public function getStudents()
    {
        $query = "SELECT * FROM students";

        $result = $this->db->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCourses()
    {
        $query = "SELECT * FROM courses";

        $result = $this->db->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTeachers()
    {
        $query = "SELECT * FROM teachers";

        $result = $this->db->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function isStudentFreeAtTime($studentId, $datetime) {
        $checkStudentQuery = "SELECT * FROM schedule WHERE student_id = ? AND time = ?";
        $checkStudentStatement = $this->db->prepare($checkStudentQuery);
        $checkStudentStatement->bind_param('is', $studentId, $datetime);
        $checkStudentStatement->execute();
        $checkStudentResult = $checkStudentStatement->get_result();

        if ($checkStudentResult->num_rows > 0) {
            return false;
        }

        return true;
    }

    public function isTeacherFreeAtTime($teacherId, $datetime) {
        $checkTeacherQuery = "SELECT * FROM schedule WHERE teacher_id = ? AND time = ?";
        $checkTeacherStatement = $this->db->prepare($checkTeacherQuery);
        $checkTeacherStatement->bind_param('is', $teacherId, $datetime);
        $checkTeacherStatement->execute();
        $checkTeacherResult = $checkTeacherStatement->get_result();

        if ($checkTeacherResult->num_rows > 0) {
            return false;
        }

        return true;
    }
}

?>
