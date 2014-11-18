@extends('master.layout')

@section('content')

<div class="col-lg-9">

    @include('partials.page-heading')

	@foreach($viewModel->sections as $section)
	    @include('partials.sections.' . $section->sectionType->type)
	@endforeach

</div>

<!-- Blog Sidebar Widgets Column -->
<div class="col-lg-3">

    @include('partials.quick-links')

</div>

@stop