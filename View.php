<?php
 
namespace ashfinlayson\base;

/**
 * View object. Currently this is just used to render view files
 * in the context of a Widget. But should be used as a base for views
 * when moving forward with MVC.
 *
 * @author Ashley Finlayson
 */
class View extends Component
{
    /**
     * Default file suffix for view files to be rendered
     * @type String
     */
    const FILE_SUFFIX = 'php';
    
    protected $viewsPath = '/';
    
    /**
     * Gets the file path references in $view param and passes to View::rebderViewFile
     * @param String $view (partial path to view file, excluding vews base path)
     * @param Array $params
     */
    public function renderView($view, $params = array())
    {
        // Create path to php file
        $file = $this->getViewsPath() . $view .'.'.self::FILE_SUFFIX;
        // Render view file
        echo $this->renderViewFile($file, $params);
    }
    
    /**
     * Public getter for views path.
     * @return string
     */
    public function getViewsPath()
    {
        return $this->viewsPath;
    }
    
    /**
     * Public setting view viewPath
     */
    public function setViewsPath($path)
    {
        $this->viewsPath = $path;
    }
    
    /**
     * Render a PHP file with passed params array
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
