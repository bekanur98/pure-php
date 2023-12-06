<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление нового студента</title>
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

    <h1>Добавление нового студента</h1>

    <form action="index.php?action=add_student" method="post">
        <label for="name">Полное имя студента:</label>
        <input type="text" name="full_name" required>

        <label for="name">Телефон номер:</label>
        <input type="text" name="phone" required>

        <label for="name">Емайл:</label>
        <input type="text" name="email" required>

        <button type="submit" class="submit-button">Добавить студента</button>
    </form>

</body>
</html>
