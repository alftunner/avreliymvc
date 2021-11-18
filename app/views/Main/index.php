<div class="container">
    <h1><?=$meta['title']?></h1>
        <?
        foreach ($posts as $post) { ?>
            <h6><?=$post['header']?></h6>
            <p><?=$post['post']?></p>
            <br><br>
        <? } ?>
</div>

