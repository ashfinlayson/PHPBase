<?php

namespace ashfinlayson\base;

/**
 * Wrapper class for Axelarge's HTML Helper
 *
 * @author Ashley Finlayson
 */
class Html
{
    /**
     * Generate a <br /> tag
     * @type string
     */
    public static $br = '<br />';
    /**
     * Generates a <hr /> tag
     * @type string
     */
    public static $hr = '<hr />';
    /**
	 * Converts an array of HTML attributes to a string
	 *
	 * If an attribute is false or null, it will not be set.
	 *
	 * If an attribute is true or is passed without a key, it will
	 * be set without an explicit value (useful for checked, disabled, ..)
	 *
	 * If an array is passed as a value, it will be joined using spaces
	 *
	 * Note: Starts with a space
	 * <code>
	 * Html::attributes(array('id' => 'some-id', 'selected' => false, 'disabled' => true, 'class' => array('a', 'b')));
	 * //=> ' id="some-id" disabled class="a b"'
	 * </code>
	 *
	 * @author axelarge https://github.com/axelarge/php-html-helpers
	 * @param array $attributes Associative array of attributes
	 *
	 * @return string
	 */
	public static function attributes(array $attributes)
	{
		$result = '';

		foreach ($attributes as $attribute => $value) {
			if ($value === false || $value === null) continue;
			if ($value === true) {
				$result .= ' ' . $attribute;
			} else if (is_numeric($attribute)) {
				$result .= ' ' . $value;
			} else {
				if (is_array($value)) { // support cases like 'class' => array('one', 'two')
					$value = implode(' ', $value);
				}
				$result .= ' ' . $attribute . '="' . static::escape($value) . '"';
			}
		}

		return $result;
	}

	/**
	 * Escapes a string for output in HTML
	 * @author axelarge https://github.com/axelarge/php-html-helpers
	 * @static
	 * @param string $string
	 * @return string
	 */
	public static function escape($string)
	{
		return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	}
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
