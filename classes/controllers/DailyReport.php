<?php
require_once 'BaseController.php';
require_once 'DailyReport.php';

class DailyReportController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new DailyReport());
    }
}
?>
