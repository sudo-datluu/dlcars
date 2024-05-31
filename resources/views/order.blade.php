@extends("layouts.app")
@section('content')
<div class="container row py-5 h-100">
    @if ($order and $car)
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                <div class="card-header p-md-5">
                    <h5 class="text-muted mb-0">Thanks for your reservation, <span class="text-primary">{{$order->name}}</span></h5>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex justify-content-between">
                        <p class="lead fw-bold mb-5 text-primary">Order detail</p>
                        @if ($order->status)
                        <p id="order-status" class="lead fw-bold mb-5 text-success">Confirmed</p>
                        @else
                        <p id="order-status" class="lead fw-bold mb-5 text-muted">Unconfirmed</p>
                        @endif
                    </div>
                    <div class="mb-md-4">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title custom-card-title">{{$car['name']}}</h4>
                            <h4 class="text-primary"> Total: <span id="RFTotal">{{$order->total}}</span>$ </h4>
                        </div>
                        <img src="{{$car['image']}}" class="w-100 custom-card-img-top">
                    </div>

                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="small text-muted mb-1">License</p>
                            <p>{{$order->license}}</p>
                        </div>
                        <div>
                            <p class="small text-muted mb-1">Phone</p>
                            <p>{{$order->phone}}</p>
                        </div>
                        <div>
                            <p class="small text-muted mb-1">Email</p>
                            <p>{{$order->email}}</p>
                        </div>
                    </div>

                    <div class="mx-n5 px-5 pt-2">
                        <div class="d-flex justify-content-between">
                            <p>Duration</p>
                            <p>{{$order->start}} - {{$order->end}}</p>
                        </div>

                        <div class="d-flex justify-content-between">
                            <p>Number of cars</p>
                            <p>{{$order->qty}}</p>
                        </div>
                    </div>
                    
                    
                </div>
                @if (!$order->status)
                <div class="card-footer p-md-5">
                    <button id="order-confirm-btn" class="btn btn-primary btn-lg">
                        Confirm your order
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        const orderID = @json($order['id']);
    </script>
    @else
    <div class="row">
        <div class="col-12 py-4">
            <img src="{{ asset('img/notfound.svg') }}" class="d-block m-auto py-4 w-50" alt="No results" loading="lazy" />
            <h1 class="text-center text-primary">No order found</h1>
            <h1 class="text-center text-primary">
                Please click
                <a class="text-primary" href="{{route('home')}}">
                    <u>here</u>    
                </a>
                to find your dream car
            </h1>
        </div>
    </div>
    @endif
</div>
@endsection

@section('order-script')
<script type="text/javascript" src="{{ asset('js/order-script.js') }}"></script>
@endsection
