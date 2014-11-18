				<div id="section-{{ $section->id }}">
                    @if($section->order > 1)
                        <hr> 
                    @endif

                    <h2 class="menuItem">
                        {{ $section->title }}
                    </h2>

                    <p>{{ $section->content }}</p>
                </div>