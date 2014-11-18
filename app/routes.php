<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/cms', function() {
	return View::make('layouts.cms-main-page');
});

//Route::any('/cms/pages/{id}', 'CMSController@ajaxShowPages');
Route::resource('/cms/languages', 'CMSLanguageController'); //a proper comment
Route::resource('/cms/pages', 'CMSPageController');
Route::resource('/cms/sections', 'CMSSectionController');

// composer l
View::composer('partials.navigation', function($view) {
	$viewModel = new Navigation();
	$viewModel->languages = language::all();
	$view->with('navigation', $viewModel); // another comment
});

Route::get('/admin', array('before' => 'auth', function() {
	return 'sdfsdfsd';
}));

Route::get('/layout-test', function() {
	$viewModel = new StandardPage();
	$viewModel->pageDetails = Page::with('language')->find(12);
	$viewModel->sections = Section::with('sectionType')->where('page_id', '=', $viewModel->pageDetails->id)->orderBy('order')->get();
	return View::make('layouts.main-page')->with('viewModel', $viewModel);
});

Route::get('defaults', function() {
	
	$language = new Language();
	$language->name = 'Laravel';
	$language->logo_path = './assets/images/logos/laravel.png';
	$language->save();

	$page = new Page();
	$page->title = 'Eloquent ORM';
	$page->language_id = 1;
	$page->save();

	$sectionType = new SectionType();
	$sectionType->type = 'Text & Title';
	$sectionType->save();

	$sectionType = new SectionType();
	$sectionType->type = 'Code';
	$sectionType->save();

	$section = new Section();
	$section->title = 'Introduction';
	$section->content = 'The Eloquent ORM included with Laravel provides a beautiful, simple ActiveRecord implementation for 
						working with your database. Each database table has a corresponding "Model" which is used to interact with that table.
						Before getting started, be sure to configure a database connection in app/config/database.php.';
	$section->order = 1;
	$section->page_id = 1;
	$section->section_type_id = 1;
	$section->save();

	$section = new Section();
	$section->title = 'Basic Usage';
	$section->content = 'To get started, create an Eloquent model. Models typically live in the app/models directory,
						 but you are free to place them anywhere that can be auto-loaded according to your composer.json file.';
	$section->order = 2;
	$section->page_id = 1;
	$section->section_type_id = 1;
	$section->save();

	$section = new Section();
	$section->title = 'Defining An Eloquent Model';
	$section->content = 'class User extends Eloquent {}';
	$section->order = 3;
	$section->page_id = 1;
	$section->section_type_id = 2;
	$section->save();





});

Route::get('test', function() {
	
	return $language->subjects->first();
});