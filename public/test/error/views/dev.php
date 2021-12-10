<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="/public/bootstrap/css/bootstrap.css" rel="stylesheet">
    <title>Error</title>
</head>
<body>
<div class="container">
    <div class="alert alert-danger" role="alert">
        Произошла ошибка! Давайте разбираться, я помогу вам информацией в таблице :)
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">инфо</th>
                <th scope="col">файл</th>
                <th scope="col">строка</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th><?=$errstr?></th>
                <th><?=$errfile?></th>
                <th><?=$errline?></th>
            </tr>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
<script src="/public/bootstrap/js/bootstrap.js"></script>
</html>