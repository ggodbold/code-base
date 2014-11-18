@extends('master.layout')

@section('content')

<div id="cms" class="col-lg-12">
	<h1>CMS Page Setup</h1>
	<p class="alert alert-info">This is the CMS page for setup of new Languages, pages and page sections. Select a language from the dropdown will reveal all related pages. Selecting a page will reveal all the composite pages of that section.</p>
	
	<section id="languages"></section>

	<!-- filled in by ajax request -->
	<section id="pages"></section>

	<!-- filled in by ajax request -->	
	<section id="sections"></section>	

</div>

@stop