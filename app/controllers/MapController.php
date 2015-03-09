<?php

class MapController extends BaseController {

	public function indexAction() {
		return View::make('map/index');
	}

	public function showWelcome()
	{
		return View::make('home/hello');
	}

}
