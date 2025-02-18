<?php
require_once 'classes/controllers/ReportController.php';
class ReportController
{
    private $report;

    public function __construct()
    {
        // Initialize the Report class
        $this->report = new Report();
    }

    /**
     * Handle the action and return the result.
     *
     * @param string $action The action to perform (e.g., 'add', 'show', 'list', 'update', 'delete').
     * @param array $data The data required for the action.
     * @return mixed The result of the action.
     */
    public function handleAction($action, $data = [])
    {
        switch ($action) {
            case 'add':
                return $this->add($data);

            case 'show':
                return $this->show($data);

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
     * Add a new report.
     *
     * @param array $data The report data.
     * @return bool True if successful, false otherwise.
     */
    private function add($data)
    {
        return $this->report->insert($data);
    }

    /**
     * Show a single report by ID.
     *
     * @param array $data The data containing the report ID.
     * @return array|array[] The report data or an error message.
     */
    private function show($data)
    {
        if (!isset($data['id'])) {
            return ['error' => 'ID is required'];
        }
        return $this->report->fetchOne($data['id']);
    }

    /**
     * List all reports.
     *
     * @return array All reports.
     */
    private function list()
    {
        return $this->report->fetchAll();
    }

    /**
     * Update a report by ID.
     *
     * @param array $data The report data including the ID.
     * @return bool|array[] True if successful, false otherwise, or an error message.
     */
    private function update($data)
    {
        if (!isset($data['id'])) {
            return ['error' => 'ID is required'];
        }
        return $this->report->update($data['id'], $data);
    }

    /**
     * Delete a report by ID.
     *
     * @param array $data The data containing the report ID.
     * @return bool|array[] True if successful, false otherwise, or an error message.
     */
    private function delete($data)
    {
        if (!isset($data['id'])) {
            return ['error' => 'ID is required'];
        }
        return $this->report->delete($data['id']);
    }
}
?>