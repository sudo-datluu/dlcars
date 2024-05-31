@extends("layouts.app")
@extends("layouts.nav-categories")
@extends("layouts.nav-search")
@section('content')
<div class="container">
    @if ($cars)
    <div class="row" id="car-grid">
        @foreach ($cars as $car)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card custom-card home-display-card">
                <a href="{{ route('car', $car['id']) }}">
                    <div class="card-img-wrapper custom-card-img-wrapper">
                        <img src="{{ $car['image'] }}" class="card-img-top custom-card-img-top" alt="{{ $car['brand'] }} {{ $car['model'] }}">
                        <div class="card-overlay custom-card-overlay">
                            <div class="card-body custom-card-body">
                                <div class="d-flex">
                                    <div class="py-2 me-2 text-primary"> {{ $car['brand'] }} </div>
                                    <div class="py-2 text-primary"> {{ $car['type'] }} </div>
                                    @if($car['available'])
                                    <div class="ms-auto py-2 text-white"> {{ $car['quantity'] }} Left</div>
                                    @else
                                    <div class="ms-auto py-2 text-danger"> Unavailable</div>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title custom-card-title text-white">{{ $car['model'] }}</h4>
                                    <h5 class="text-white"> ${{ $car['price_per_day'] }}/day </h5>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="py-2 me-2 text-white"> <i class="fa-solid fa-gas-pump"></i> {{ $car['fuel_type'] }} </div>
                                    <div class="py-2 me-2 text-white"> <i class="fa-solid fa-road"></i> {{ $car['mileage'] }} </div>
                                    <div class="py-2 me-2 text-white"> <i class="fa-solid fa-person"></i> {{ $car['seats'] }} </div>
                                </div> 
                            </div>
                            <div class="card-footer none-border-card-footer">
                                @if($car['available'])
                                <a data-id="{{ $car['id'] }}" href="#" class="btn-rent btn btn-primary">
                                    Rent
                                </a>
                                @else
                                <a class="btn btn-light disabled" aria-disabled="true" role="button">
                                    Unavailable
                                </a>
                                @endif

                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="row">
        <div class="col-12 py-4">
            <img src="{{ asset('img/notfound.svg') }}" class="d-block m-auto py-4 w-50" alt="No results" loading="lazy" />
            <h1 class="text-center text-primary">No cars found</h1>
            <h1 class="text-center text-primary">Please try another keyword</h1>
        </div>
    </div>
    @endif
</div>
@endsection