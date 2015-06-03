<?php
 
namespace ashfinlayson\base;

/**
 * This is the widget base class.
 * All widgets MUST extend this class
 *
 * @author Ashley Finlayson
 */
class Widget extends View
{
    /**
     * Widget classname
     * @var String 
     */
    public $name;
    /**
     * Widget params
     * An associative array of params to be passed to the widget
     * @var Array 
     */
    public $params;
    /**
     * Widget context
     * The object that the class is loaded by ie. KHXC_Display
     * @var Object 
     */
    public $context;
    /**
     * Static counter for widget
     * this is incrimented everytime a widget is loaded
     * to uniquely identify each widget call
     * @var Int
     */
    public static $count = 0;
    /**
     * Prefix for widget identifier
     * @var String
     */
    public $idPrefix = 'w';
    /**
     * Unqiue ID for this widget call
     * @var String
     */
    public $id;

    /**
     * Constructor method
     * Called when widget is loaded, sets view context, stores config in params and runs the widget
     * @param String $name widget classname
     * @param Array $params
     * @param Object $context (KXHC_Display instance)
     * @return undifined
     */
    public function __construct($name, $params = array(), $context = null)
    {
        // Store widget classname
        $this->name = $name;
        // Store the context
        if ( $context ) {
            $this->context = $context;
        }
        // Set a unique identifier for the widget
        $this->setWidgetId();
    }
    
    /**
     * Creates an ID string unique to each widger call
     * ie. First widget on page would have id of 'w1', second would be 'w2' etc.
     */
    public function setWidgetId()
    {
        $this->id = $this->idPrefix . static::$count++ . '-' . $this->getClassName();
    }

    /**
     * Widgets init method. This method is to be overridden by your widget
     * if you want to run some logic before calling run()
     * if this method doesn't return TRUE then the widget will NOT run
     * @return boolean
     */
    public function init($run = true)
    {
        return $run;
    }

    /**
     * Widget's run method. This method should be overriden in your widget class
     * and It is where you should call your render() method.
     */
    public function run()
    {
        
    }

    /**
     * Renders the widget view
     * @param String $view
     * @param Array $params
     * @return Null
     */
    public function render($view, $params = array())
    {
        $this->renderView($view, $params);
    }
    
    /**
     * Returns the base path for widget views.
     * Used by the parent class (ashfinlayson\base\View) to build
     * the path to the view file for rendering
     * @return String
     */
    public function getViewsPath()
    {
        return dirname(dirname(__FILE__)) . '/Components/Widgets/';
    }
}