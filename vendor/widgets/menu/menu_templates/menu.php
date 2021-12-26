<li>
    <a href="?id=<?=$id;?>"><?=$category['title']?></a>
    <? if (isset($category['childes'])) { ?>
        <ul>
            <?=$this->getMenuHtml($category['childes']);?>
        </ul>
    <? } ?>
</li>
