<?php

class CMSLanguageController extends BaseController {
	
	public function index() {
		$viewModel = new CMSPage();
		$languages = Language::orderBy('name')->get();
		$viewModel->languages[0] = 'Please select a language';

		foreach ($languages as $key => $language) {
			$viewModel->languages[$language->id] = $language->name;
		}
		
		return View::make('partials.cms.languages')->with('viewModel', $viewModel);	
	}

	public function show() {
		return $this->index();
	}

	public function edit($id) {
		$viewModel = new CMSPage();
		$language = Language::find($id);
		$viewModel->languageDetails = $language;
		$viewModel->saveUrl = '/cms/languages/' . $language->id;
		$viewModel->dropDownContentUrl = '/cms/languages/' . $language->id;
		$viewModel->dropDownId = "languages";
		$viewModel->action = "Edit";
		
		$ajaxData = (string) View::make('partials.cms.language-details')->with('viewModel', $viewModel);

		return Response::json($ajaxData);
	}

	public function create() {
		$viewModel = new CMSPage();
		$language = new Language();
		$language->save();

		$viewModel->languageDetails = $language;
		$viewModel->saveUrl = '/cms/languages/' . $language->id;
		$viewModel->deleteUrl = '/cms/languages/' . $language->id;
		$viewModel->dropDownContentUrl = '/cms/languages/' . $language->id;
		$viewModel->dropDownId = "languages";
		$viewModel->action = "New";
		
		$ajaxData = (string) View::make('partials.cms.language-details')->with('viewModel', $viewModel);

		return Response::json($ajaxData);
	}

	public function destroy($id) {
		$language = Language::find($id);

		if ( $language->pages->count() != 0 ) {
			return 'This language has related page records. These must be deleted first!';
		}

		if ( $language->delete() ) {
			return 'Success';
		} else {
			return 'There was an error attempting to delete this record';
		}	
	}

	public function update($id) {
		$languageDetails = Language::find($id);
		$languageDetails->name = Input::get('name');
		$languageDetails->logo_path = Input::get('logo');

		if( $languageDetails->save() ) {
			return 'Success';
		} else {
			return 'failed';
		}
	}
}


	