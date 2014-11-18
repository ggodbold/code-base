<?php

class CMSPageController extends BaseController {
	
	public function show($id) {
		$viewModel = new CMSPage();
		$pages = Page::where('language_id', '=', $id)->orderBy('title')->get();
		$viewModel->pages[0] = 'Please select a page';

		foreach ($pages as $key => $page) {
			$viewModel->pages[$page->id] = $page->title;
		}

		return View::make('partials.cms.pages')->with('viewModel', $viewModel);	
	}

	public function edit($id) {
		$viewModel = new CMSPage();
		$page = Page::find($id);
		$viewModel->pageDetails = $page;
		$viewModel->saveUrl = '/cms/pages/' . $page->id;
		$viewModel->dropDownContentUrl = '/cms/pages/' . $page->language_id;
		$viewModel->dropDownId = "pages";
		$viewModel->action = "Edit";
		$ajaxData = (string) View::make('partials.cms.page-details')->with('viewModel', $viewModel);

		return Response::json($ajaxData);
	}

	public function create() {
		$viewModel = new CMSPage();
		$page = new Page();
		$page->language_id = Input::get('languageId');
		$page->save();

		$viewModel->pageDetails = $page;
		$viewModel->saveUrl = '/cms/pages/' . $page->id;
		$viewModel->deleteUrl = '/cms/pages/' . $page->id;
		$viewModel->dropDownContentUrl = '/cms/pages/' . $page->language_id;
		$viewModel->dropDownId = "pages";
		$viewModel->action = "New";

		$ajaxData = (string) View::make('partials.cms.page-details')->with('viewModel', $viewModel);

		return Response::json($ajaxData);
	}

	public function destroy($id) {
		$page = Page::find($id);	
		
		if ( $page->sections->count() != 0 ) {
			return 'This page has related section records. These must be deleted first!';
		}

		if ( $page->delete() ) {
			return 'Success';
		} else {
			return 'Failed to update';
		}	
	}

	public function update($id) {
		$pageDetails = Page::find($id);
		$pageDetails->title = Input::get('title');

		if( $pageDetails->save() ) {
			return 'Success';
		} else {
			return 'failed';
		}
	}
}


	