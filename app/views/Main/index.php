<div class="container">
    <h1><?=$title?></h1>
    <nav class="nav">
        <? foreach ($menu as $item) { ?>
            <a class="nav-link active" aria-current="page" href="#"><?=$item['title']?></a>
        <? } ?>
    </nav>
        <?
        foreach ($posts as $post) { ?>
            <h6><?=$post['header']?></h6>
            <p><?=$post['post']?></p>
            <br><br>
        <? } ?>
</div>

