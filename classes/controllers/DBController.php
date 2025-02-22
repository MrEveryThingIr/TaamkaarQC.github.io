<?php
require_once 'classes/Database.php';

class DBController
{
    private $model_key;
    private $requested;
    private $model;
    private $id;
    private $data;

    public function __construct($model_key, $requested, $id = null, $data = [])
    {
      
        $this->model_key = $model_key;
        $this->requested = $requested;
        $this->id = $id;
        $this->data = $data;
        $this->initializeModel();
    }

    private function initializeModel()
    {
        // Dynamically load the appropriate model based on $model_key
        switch ($this->model_key) {
            case 'project':
                require_once 'classes/TamkarProject.php';
                $this->model = new TamkarProject();
                break;
            case 'drawing':
                require_once 'classes/Drawing.php';
                $this->model = new Drawing();
                break;
            case 'part':
                require_once 'classes/Part.php';
                $this->model = new Part();
                break;
            case 'operator':
                require_once 'classes/Operator.php';
                $this->model = new Operator();
                break;
            case 'device':
                require_once 'classes/Device.php';
                $this->model = new Device();
                break;
            case 'sample':
                require_once 'classes/Sample.php';
                $this->model = new Sample();
                break;
            case 'dimension':
                require_once 'classes/Dimension.php';
                $this->model = new Dimension();
                break;
            case 'daily_report':
                require_once 'classes/DailyReport.php';
                $this->model = new DailyReport();
                break;
            default:
                throw new Exception("Invalid model key");
        }

        if ($this->model === null) {
            throw new Exception("Model not initialized");
        }
    }

    public function executeAction()
    {
        // Use a switch statement to handle the requested action
        switch ($this->requested) {
            case 'read_all':
                return $this->model->readAll();
            case 'readOne':
                return $this->model->readOne($this->id);
            case 'create':
                return $this->model->create($this->data);
            case 'update':
                return $this->model->update($this->id, $this->data);
            case 'delete':
                return $this->model->delete($this->id);
            default:
                throw new Exception("Invalid action requested");
        }
    }
}