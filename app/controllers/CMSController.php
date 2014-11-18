<?php

class CMSController extends BaseController {

	public function ajaxShowPages($id) {
		$viewModel = new CMSPage();
		$pages = Page::where('language_id', '=', $id)->orderBy('title')->get();
		$viewModel->pages[0] = 'Please select a page';

		foreach ($pages as $key => $page) {
			$viewModel->pages[$page->id] = $page->title;
		}

		return View::make('partials.cms.pages')->with('viewModel', $viewModel);	
	}

}
