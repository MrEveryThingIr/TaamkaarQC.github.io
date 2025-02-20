<?php
require_once 'classes/controllers/BaseController.php';
require_once 'classes/Report.php';

class ReportController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new Report());
    }
}
?>
