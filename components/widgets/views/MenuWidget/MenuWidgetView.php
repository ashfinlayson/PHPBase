<?php

use JBGlobal\Base\Html;

if (count($this->menuItems)) {
    echo Html::tag('ul', array(
        'id' => $this->getMenuId(),
        'class' => $this->getMenuClass(),
    ), $this->createListItems($this->menuItems));
}

