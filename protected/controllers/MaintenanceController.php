<?php
class MaintenanceController extends Controller
{
	public $layout='/layouts/maintenance';
	public function actionIndex()
	{
		
		$this->render('index');
	}
}