<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование студента</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            padding: 8px;
            margin-bottom: 10px;
            width: 100%;
        }

        .submit-button {
            padding: 10px 15px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h1>Редактирование студента</h1>

    <form action="index.php?action=update_student" method="post">
        <input type="hidden" name="student_id" value="<?= $student['student_id']; ?>">

        <label for="name">Полное имя студента:</label>
        <input type="text" name="full_name" value="<?= $student['full_name']; ?>" required>

        <label for="name">Телефон номер:</label>
        <input type="text" name="phone" value="<?= $student['phone']; ?>" required>

        <label for="name">Емайл:</label>
        <input type="text" name="email" value="<?= $student['email']; ?>" required>    

        <button type="submit" class="submit-button">Обновить студента</button>
    </form>

</body>
</html>
