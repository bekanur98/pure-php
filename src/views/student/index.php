<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список студентов</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .add-button {
            display: inline-block;
            padding: 10px 15px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            margin-top: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <h1>Список студентов</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Тел.</th>
            <th>Емайл</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= $student['student_id']; ?></td>
                <td><?= $student['full_name']; ?></td>
                <td><?= $student['phone']; ?></td>
                <td><?= $student['email']; ?></td>
                <td>
                    <a href="index.php?action=edit_student&id=<?= $student['student_id']; ?>">Редактировать</a>
                    <a href="index.php?action=delete_student&id=<?= $student['student_id']; ?>" onclick="return confirm('Вы уверены?')">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="index.php?action=add_student" class="add-button">Добавить нового студента</a>

</body>
</html>
