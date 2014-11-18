<div id="section-{{ $section->id }}" class="code">
                        
    @if($section->title)
        <h4>
            <a href="#">{{ $section->title }}</a>
        </h4>
    @endif

    <pre class="prettyprint">{{ htmlentities($section->content) }}</pre>
</div>