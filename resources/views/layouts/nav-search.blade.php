@section('nav-search')
<div class="d-flex input-group w-auto">
    <form action="{{route('home')}}", method="get" onsubmit="searchCars()">
        <input 
            id="autoComplete" 
            type="search" 
            name="search"
            dir="ltr" 
            spellcheck=false 
            autocorrect="off" 
            autocomplete="off" 
            autocapitalize="off" 
            maxlength="2048" 
            tabindex="1"
        >
    </form>
</div>
@endsection
@section('search-script')
<script type="text/javascript" src="{{ asset('js/search-script.js') }}"></script>
@endsection