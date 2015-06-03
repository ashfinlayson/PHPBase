<?php

namespace ashfinlayson\base\components\widgets;

use ashfinlayson\base\components\helpers\UrlHelper;
use ashfinlayson\base\Html;

/**
 * MenuWidget is a component for generating list menus
 * from an array of list data & HTML attributes
 *
 * @author Ashley Finlayson
 */
class MenuWidget extends ashfinlayson\base\Widget
{
    const MENU_ITEM_FIRST_CLASS = 'first';
    const MENU_ITEM_LAST_CLASS = 'last';
    const MENU_ITEM_ACTIVE_CLASS = 'active';
    const MENU_ID = 'MenuWidget';
    const MENU_CLASS = 'MenuWidget';
    /**
     * Associative array of list & link data and attributes
     * @var Array 
     */
    public $menuItems = array();
    /**
     * Id attribute for the list menu
     * @var String
     */
    public $menuId;
    /**
     * Class attribute for the list menu
     * @var String 
     */
    public $menuClass;
    
    public function init()
    {
        // Validate menuItems before attempting to run widget
        if (!$this->isArrayWithData($this->menuItems)) {
            return;
        }
        return true;
    }
    
    /**
     * Run the widget, render the list menu
     */
    public function run()
    {
        $this->render($this->getWidgetView());
    }
    
    /**
     * Returns the path to the widget view file
     * @return String
     */
    public function getWidgetView()
    {
        return '/Views/MenuWidget/MenuWidgetView';
    }
    
    public function createListItems(array $items)
    {
        $ret = '';
        $i = 0;
        foreach($items as $item) {
            // Create last item class string
            $firstLastClass = ($i === 0 ? $this->getFirstItemClass() : ($i === (count($items)-1) ? $this->getLastItemClass() : ''));
            // Create Active class string
            $activeClass = (UrlHelper::instance()->isActivePage($item['url']) ? $this->getActiveItemClass() : '');
            // Create opening li tag
            $listItem = Html::openTag('li', $this->getListItemAttributes($item, $firstLastClass, $activeClass));
            // Add link tag to the list item
            $listItem.= Html::tag('a', array(
                'href' => $item['url'],
                'title'=> $item['title'],
            ), $item['title']);
            // If item has children, reload this method and wrap return in a <ul />
            if ( isset($item['items'])) {
                $listItem.= Html::tag('ul', array(), $this->createListItems($item['items']));
            }
            // Close list item
            $listItem.= Html::closeTag('li');
            
            $ret.= $listItem;
            $i++;
        }
        
        return $ret;
    }
    
    /**
     * Returns first menu item list (li) class or returns default value
     * @return String
     */
    public function getFirstItemClass()
    {
        if ($this->menuFirstItemClass) {
            return $this->menuFirstItemClass;
        }
        return self::MENU_ITEM_FIRST_CLASS;
    }
    
    /**
     * Returns last menu item list (li) class or returns default value
     * @return type
     */
    public function getLastItemClass()
    {
        if ($this->menuLastItemClass) {
            return $this->menuLastItemClass;
        }
        return self::MENU_ITEM_LAST_CLASS;
    }
    
    /**
     * Sets the following attributes for list items
     * id, class
     * @param Attay $item
     * @param String $firstLastClass
     * @return Array
     */
    public function getListItemAttributes($item, $firstLastClass, $activeClass)
    {
        $attributes = array();
        // Set list item id
        if (isset($item['id'])) {
            $attributes['id'] = $item['id'];
        }
        // Set list item class
        $attributes['class'] = ( isset($item['class']) ? $item['class'] . ' ' . $firstLastClass . ' ' .$activeClass : $firstLastClass . ' '. $activeClass);
        
        return $attributes;
    }
    
    public function getMenuId()
    {
        if (isset($this->menuId)) {
            return $this->menuId;
        }
        return $this->id;
    }
    
    public function getMenuClass()
    {
        if (isset($this->menuClass)) {
            return $this->menuClass;
        }
        return self::MENU_CLASS;
    }
    
    public function getActiveItemClass()
    {
        return self::MENU_ITEM_ACTIVE_CLASS;
    }

}
