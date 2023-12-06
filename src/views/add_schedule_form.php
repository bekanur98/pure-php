<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление ученика в расписание</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        select,
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h1>Добавление ученика в расписание</h1>

    <?php if (isset($errorMessage)): ?>
        <script>
            // Показать предупреждение, если есть ошибка
            alert('<?= $errorMessage; ?>');
        </script>
    <?php endif; ?>

    <form action="index.php?action=add_schedule" method="post" onsubmit="return isFormValid()">
        <label for="student_id">Выберите ученика:</label>
        <select name="student_id" required>
            <?php foreach ($students as $student): ?>
                <option value="<?= $student['id']; ?>"><?= $student['full_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="course_id">Выберите курс:</label>
        <select name="course_id" required>
            <?php foreach ($courses as $course): ?>
                <option value="<?= $course['id']; ?>"><?= $course['name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="teacher_id">Выберите преподавателя:</label>
        <select name="teacher_id" required>
            <?php foreach ($teachers as $teacher): ?>
                <option value="<?= $teacher['id']; ?>"><?= $teacher['full_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="datetime">Выберите день и время:</label>
        <input type="datetime-local" name="datetime" id="datetime" required>

        <button type="submit">Добавить в расписание</button>
    </form>

    <script>
        document.getElementById('datetime').addEventListener('input', function() {
            let parts = this.value.split(":");
            parts[1] = "00";
            this.value = parts.join(":");
            // this.value = selectedDate.toISOString();
        });

        function isFormValid() {
            const selectedDate = new Date(document.getElementById('datetime').value);
            const selectedTime = selectedDate.getHours();

            // Ограничиваем часы с 9 утра до 6 вечера
            if (selectedTime < 9 || selectedTime >= 18) {
                alert('Выберите время с 9 утра до 6 вечера.');
                return false;
            }

            return true;
        }
    </script>

</body>
</html>
