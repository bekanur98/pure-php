<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница расписания</title>
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

    <h1>Общее расписание на ближайшую неделю</h1>

    <table>
        <tr>
            <th>Курс</th>
            <th>Учитель</th>
            <th>Ученик</th>
            <th>Время</th>
        </tr>
        <?php foreach ($schedule as $entry): ?>
            <tr>
                <td><?= $entry['course_name']; ?></td>
                <td><?= $entry['teacher_name']; ?></td>
                <td><?= $entry['student_name']; ?></td>
                <td><?= $entry['time']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="index.php?action=add_schedule" class="add-button">Добавить новую запись</a>

</body>
</html>
