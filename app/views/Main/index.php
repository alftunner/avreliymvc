<button class="btn btn-secondary" id="send">Кнопка</button>
<?
new \vendor\widgets\menu\Menu([
        //'template' => WWW . '/menu/my_menu.php',
        'container' => 'select',
        'class' => 'my_menu',
        'table' => 'categories',
        'cache' => 60,
        'cacheKey' => 'menu_select',
]);
foreach ($posts as $post) { ?>
<figure class="text-right">
    <blockquote class="blockquote">
        <p><?=$post['post']?></p>
    </blockquote>
    <figcaption class="blockquote-footer">
        <?=$post['header']?>
    </figcaption>
</figure>
<? } ?>
<script src="/public/js/test.js"></script>
<script>
    $(function () {
        $('#send').click(function () {
            $.ajax({
                url: '/main/test',
                type: 'post',
                data: {'id' : 2},
                success: function (res) {
                    console.log(res);
                },
                error: function () {
                    alert('ERROR!');
                }
            });
        });
    });
</script>
