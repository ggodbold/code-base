                <!-- Quick Links -->
                <div class="well">
                    <h4></span>Quick Links</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <dl id="nav">
                                @foreach ($viewModel->pageDetails->sections as $section)
                                    @if(!empty($section->title))
                                        
                                        @if(!$section->parent_id)
                                            <dt><a href="#section-{{ $section->id }}">{{ $section->title }}</a></dt>
                                        @else
                                            <dd><a href="#section-{{ $section->id }}">{{ $section->title }}</a></dd>
                                        @endif

                                    @endif
                                
                                @endforeach
                            </dl>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

