<?php
require_once 'Database.php';

class BaseController
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Handle different actions dynamically.
     *
     * @param string $action Action type ('add', 'show', 'list', 'update', 'delete')
     * @param array $data Data for the action
     * @return mixed
     */
    public function handleAction($action, $data = [])
    {
        switch ($action) {
            case 'add':
                return $this->create($data);
            case 'show':
                return $this->read($data);
            case 'list':
                return $this->list();
            case 'update':
                return $this->update($data);
            case 'delete':
                return $this->delete($data);
            default:
                return ['error' => 'Invalid action'];
        }
    }

    /**
     * Create a new record in the database.
     *
     * @param array $data Data to insert
     * @return mixed Inserted ID or false
     */
    public function create($data)
    {
        return $this->model->insert($data);
    }

    /**
     * Fetch a single record by ID.
     *
     * @param array $data Must contain 'id'
     * @return mixed Record data or error
     */
    public function read($data)
    {
        if (!isset($data['id'])) {
            return ['error' => 'ID is required'];
        }
        return $this->model->fetchOne($data['id']);
    }

    /**
     * Fetch all records.
     *
     * @return array All records
     */
    public function list()
    {
        return $this->model->fetchAll();
    }

    /**
     * Update a record by ID.
     *
     * @param array $data Must contain 'id'
     * @return mixed True if success, false otherwise
     */
    public function update($data)
    {
        if (!isset($data['id'])) {
            return ['error' => 'ID is required'];
        }
        return $this->model->update($data['id'], $data);
    }

    /**
     * Delete a record by ID.
     *
     * @param array $data Must contain 'id'
     * @return mixed True if success, false otherwise
     */
    public function delete($data)
    {
        if (!isset($data['id'])) {
            return ['error' => 'ID is required'];
        }
        return $this->model->delete($data['id']);
    }
}
?>