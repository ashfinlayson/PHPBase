<?php
 
namespace ashfinlayson\base;

/**
 * @title View
 * @author Ashley Finlayson <ash.finlayson@gmail.com> <github.com/ashfinlayson>
 * @description View rendering class for returning the content view file as a string
 * 
 * 
 * @param string    $viewPath                The path to the views directory
 * @param mixed     $context    optional     Instance of application, controller etc
 * 
 * @usage
 * 
 *      // Instantiate 
 *      $view = new View('/path/to/views/directory);
 *      $view->setContext($yourControllerInstance);
 * 
 *      // Render a view
 *      echo $view->render('your-view-file', [
 *          'youParamName' => 'your param value',
 *          'SomeParamsArray' => ['some', 'values', 'here'],
 *      ]);
 * 
 *      // Fetch values from outside of scope
 *      echo $this->getContext()->pagetitle
 * 
 * @scope View
 * - You can call $this->render() to render a view inside a view
 * - Call $this->getContext() to fetch a value from outside of scope:
 *      eg. echo $this->getContext()->pagetitle;
 */
class View extends Component
{
    /**
     * Default file suffix for view files to be rendered
     * @type String
     */
    protected $fileSuffix = 'php';
    /**
     * Path to views directory
     * @var string
     */
    protected $viewPath = '/';
    /**
     * Instance of controller/application
     * @var mixed
     */
    protected $context = null;
    
    /**
     * public constructor
     * @param string|null $viewPath path to the views directory used in this instance 
     * @param object|null $context instance of application or controller that is instantiating the view renderer
     */
    public function __construct($viewPath = null, $context = null, $fileSuffix = null)
    {
        if ($viewPath) {
            $this->setViewPath($viewPath);
        }
        
        if ($context) {
            $this->setContext($context);
        }
        
        if ($fileSuffix) {
            $this->setFileSuffix($fileSuffix);
        }
    }
    
    /**
     * Gets the file path references in $view param and passes to View::rebderViewFile
     * @param String $view (partial path to view file, excluding vews base path)
     * @param Array $params
     */
    public function render($view, $params = array())
    {
        // Create path to php file
        $file = $this->getViewPath() . $view . '.' . $this->getFileSuffix();
        // Render view file
        return $this->renderViewFile($file, $params);
    }
    
    /**
     * Public getter for $viewPath.
     * @return string
     */
    public function getViewPath()
    {
        return $this->viewPath;
    }
    
    /**
     * Public setter for $viewPath
     * @param string $path
     */
    public function setViewPath($path)
    {
        $this->viewPath = $path;
    }
    
    /**
     * Public settfor for $context
     * @param mixed $value
     */
    public function setContext($context)
    {
        $this->context = $context;
    }
    
    /**
     * Public getter for $context
     * @return mixed
     */
    public function getContext()
    {
        return $this->context;
    }
    
    /**
     * Public setter for $fileSuffix
     * @param string $fileSuffix
     */
    public function setFileSuffix($fileSuffix)
    {
        $this->fileSuffix = $fileSuffix;
    }
    
    /**
     * Public getter for $fileSuffix
     * @return string
     */
    public function getFileSuffix()
    {
        return $this->fileSuffix;
    }
    
    /**
     * Render a file with passed params array
     * @param String $file (full path to view file) 
     * @param Array $params
     * @return String (view file's output)
     */
    public function renderViewFile($file, $params = array())
    {
        // New output buffer
        ob_start();
        // Do not flush
        ob_implicit_flush(false);
        // Pass view params in to required file but overwrite existing
        extract($params, EXTR_OVERWRITE);
        // Require the view file
        require($file);
        // Return the view files output
        return ob_get_clean();
    }
}
