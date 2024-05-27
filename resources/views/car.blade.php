@extends("layouts.app")
@extends("layouts.nav-categories")
@extends("layouts.nav-search")
@section('content')
<div style="max-width: 600px;">
    <div class="d-flex justify-content-between">
        <h4 class="card-title custom-card-title">{{ $car['name'] }}</h4>
        @if($car['available'])
        <a href="#" class="btn btn-primary">
            Rent
        </a>
        @else
        <a class="btn btn-dark disabled" aria-disabled="true" role="button">
            Unavailable
        </a>
        @endif
    </div>
    <h5 class="text-primary"> ${{ $car['price_per_day'] }}/day </h5>
    <img src="{{ $car['image'] }}" class="w-100 custom-card-img-top" alt="{{ $car['name'] }}">
    <div class="d-flex justify-content-between my-4">
        <div class="row">
            <div class="col-md-6 pe-0 align-self-center">
                <i class="fa-solid fa-2x fa-gas-pump"></i>
            </div>
            <div class="col-md-6 ps-0">
                <div style="width: max-content;">
                    <div class=""> {{ $car['fuel_type'] }} </div>
                    <div>Fuel type</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 pe-0 align-self-center">
                <i class="fa-solid fa-2x fa-road"></i>
            </div>
            <div class="col-md-6 ps-0">
                <div style="width: max-content;">
                    <div class=""> {{ $car['mileage'] }} </div>
                    <div>Mileage</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 pe-0 align-self-center">
                <i class="fa-solid fa-2x fa-person"></i>
            </div>
            <div class="col-md-6 ps-0">
                <div style="width: max-content;">
                    <div class=""> {{ $car['seats'] }} </div>
                    <div>Seats</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="max-width: 1020px;">
    <h4 class="card-title custom-card-title">Description</h4>
    <p>{{ $car['description'] }}</p>
    <p>{{ $car['description'] }}</p>
    <p>{{ $car['description'] }}</p>
</div>
@endsection