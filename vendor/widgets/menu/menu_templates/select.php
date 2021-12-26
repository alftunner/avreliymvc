<option value=""><?=$tab . $category['title']?></option>
<? if (isset($category['childes'])) { ?>
    <?=$this->getMenuHtml($category['childes'], '&nbsp' . $tab .= '-');?>
<? } ?>
