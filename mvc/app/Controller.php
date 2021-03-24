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
        require_once(ROOT.'views/'.$file.'.php');
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