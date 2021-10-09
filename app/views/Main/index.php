<div class="container">
    <?
    foreach ($data as $item) {
        echo "<h3>{$item['header']}</h3>";
        echo "<h4>{$item['short']}</h4>";
        echo "<p>{$item['post']}</p><br><br>";
    }
    ?>
</div>

