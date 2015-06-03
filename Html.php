<?php

namespace ashfinlayson\base;

/**
 * Wrapper class for Axelarge's HTML Helper
 *
 * @author Ashley Finlayson
 */
class Html extends \Axelarge\HtmlHelpers\Html
{
    public static $br = '<br />';
    /**
     * Returns an opening tag for an html element with attributes
     * @param String $tagName
     * @param Array $attributes
     * @return String
     */
    public static function openTag($tagName, $attributes = array())
    {
        return '<' . $tagName . static::attributes($attributes) . '>';
    }
    
    /**
     * Returns a closing tag for an html element
     * @param String $tagName
     * @return String
     */
    public static function closeTag($tagName)
    {
        return '</' . $tagName . '>';
    }
    
    /**
     * Shorthand method for Html::openTag/Html::closeTag
     * @param String $tagName
     * @param Array $attributes
     * @param String $content
     * @return String
     */
    public static function tag($tagName, $attributes, $content)
    {
        return self::openTag($tagName, $attributes) . $content . self::closeTag($tagName);
    }
    
    /**
     * Returns a fully rendered image tag ie. <img src="" />
     * @param String $src image file source
     * @param Array $attributes such as id, alt etc
     * @return String image tag
     */
    public static function image($src, $attributes = array()) {
        return '<img src="'.$src.'" '.static::attributes($attributes).' />';
    }
    
    /**
     * Generates a <hr /> tag
     * @param array $attributes
     * @return string
     */
    public static function hr($attributes = array()) {
        return '<hr '.static::attributes($attributes).' />';
    }
    
    /**
     * Shorthand method for parsing html links
     * @param string $href
     * @param string $content
     * @param array $attributes
     * @return string
     */
    public static function a($href, $content, $attributes = array()) {
        $attributes['href'] = $href;
        return self::tag('a', $attributes, $content);
    }
}
