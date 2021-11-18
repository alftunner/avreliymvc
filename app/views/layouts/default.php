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
<? if (!empty($menu)) { ?>
    <nav class="nav">
        <? foreach ($menu as $item) { ?>
            <a class="nav-link active" aria-current="page" href="#"><?=$item['title']?></a>
        <? } ?>
    </nav>
<? } ?>
<?=$content?>

<script src="/public/bootstrap/js/bootstrap.js"></script>
</html>


