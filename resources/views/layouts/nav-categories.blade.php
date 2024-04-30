@section('nav-categories')
<div id="menu-icon" class="text-primary">&#9776;</div>
<div class="dlcar-sidenav" id="mySidenav">
    @if(getBrands()->isNotEmpty())
    @foreach(getBrands() as $brand)
    <ul class="categories-menu-ul">
        <li>
            <a href="{{ route('home', $brand->slug) }}"><i class="{{$brand->icon}}"></i> <span>{{$brand->name}}</span></a>
            <ul class="nav-flyout p-4">
                @if(getCarType()->isNotEmpty())
                @foreach(getCarType() as $type)
                <li>
                    <a href=" {{ route('home', [$brand->slug, $type->slug]) }} ">{{$type->name}}</a>
                </li>
                @endforeach
                @endif
            </ul>
        </li>
    </ul>
    @endforeach
    @endif
</div>
@endsection