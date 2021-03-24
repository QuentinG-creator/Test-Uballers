<?php
abstract class Controller
{
	/**
     * Show a views
     *
     * @param string $file
     * @param array $data
     * @return void
     */
	public function render(string $file, array $data = [])
	{
		extract($data);
        //start the buffering
        ob_start();


        require_once(ROOT.'views/'.strtolower($file).'/'.$file.'.php');

        //We stock all the content in the variable $content
        $content=ob_get_clean();

        //We create the template
        require_once(ROOT.'views/layout/default.php');
	}

	/**
     * Generate the model
     *
     * @param string $model
     * @return void
     */

    public function loadModel(string $model){
        
        require_once(ROOT.'models/'.$model.'.php');
        $this->$model = new $model();
    }
}
?>