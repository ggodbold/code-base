<?php

class CMSSectionController extends BaseController {
	
	public function show($id) {
		$viewModel = new CMSPage();
		$sections = Section::with('SectionType')->where('page_id', '=', $id)->orderBy('order')->get();
		$viewModel->sections[0] = 'Please select a section';

		foreach ($sections as $key => $section) {
			$viewModel->sections[$section->id] = $section->title;
		}

		return View::make('partials.cms.sections')->with('viewModel', $viewModel);	
	}

	public function edit($id) {
		$viewModel = new CMSPage();
		$section = Section::find($id);
		$viewModel->sectionDetails = $section;
		$viewModel->saveUrl = '/cms/sections/' . $section->id;
		$viewModel->dropDownContentUrl = '/cms/sections/' . $section->page_id;
		$viewModel->dropDownId = "sections";
		$viewModel->action = "Edit";
		$sectionTypes = SectionType::all();

		foreach ($sectionTypes as $sectionType) {
			$viewModel->sectionTypes[$sectionType->id] = $sectionType->type;
		}

		$ajaxData = (string) View::make('partials.cms.section-details')->with('viewModel', $viewModel);

		return Response::json($ajaxData);
	}

	public function create() {
		$viewModel = new CMSPage();
		$section = new Section();
		$section->page_id = Input::get('pageId');
		$section->section_type_id = 1; // set this to default section type
		$section->save();

		$viewModel->sectionDetails = $section;
		$viewModel->saveUrl = '/cms/sections/' . $section->id;
		$viewModel->deleteUrl = '/cms/sections/' . $section->id;
		$viewModel->dropDownContentUrl = '/cms/sections/' . $section->page_id;
		$viewModel->dropDownId = "sections";
		$viewModel->action = "New";
		$sectionTypes = SectionType::all();

		foreach ($sectionTypes as $sectionType) {
			$viewModel->sectionTypes[$sectionType->id] = $sectionType->type;
		}

		$ajaxData = (string) View::make('partials.cms.section-details')->with('viewModel', $viewModel);

		return Response::json($ajaxData);
	}

	public function destroy($id) {
		$section = Section::find($id);

		if ( $section->delete() ) {
			return 'Success';
		} else {
			return 'Failed to update';
		}	
	}

	public function update($id) {
		$sectionDetails = Section::find($id);
		$sectionDetails->title = Input::get('title');
		$sectionDetails->content = Input::get('content');
		

		$sectionDetails->order = Input::get('order');
		$sectionDetails->page_id = Input::get('page_id');
		$sectionDetails->section_type_id = Input::get('section-type');

		if( $sectionDetails->save() ) {
			return 'Success';
		} else {
			return 'failed';
		}
	}
}


	