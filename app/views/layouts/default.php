<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?=$meta['description']?>">
    <meta name="keywords" content="<?=$meta['keywords']?>">
    <title><?=$meta['title']?></title>
    <!-- Bootstrap CSS -->
    <link href="/public/bootstrap/css/bootstrap.css" rel="stylesheet">
    <title>DEFAULT</title>
</head>
<body>
<div class="container">
    <? if (!empty($menu)) { ?>
        <nav class="nav">
            <? foreach ($menu as $item) { ?>
                <a class="nav-link active" aria-current="page" href="#"><?=$item['title']?></a>
            <? } ?>
        </nav>
    <? } ?>
    <?=$content?>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
<script src="/public/bootstrap/js/bootstrap.js"></script>
<? foreach ($scripts as $script) {
    echo $script;
} ?>
</html>


