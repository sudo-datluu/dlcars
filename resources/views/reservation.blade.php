@extends("layouts.app")
@section('content')
<div class="container row py-5 h-100">
    @if ($reservation and $car['available'])
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                <div class="card-body p-4 p-md-5">
                    <h3 class="mb-2 pb-md-0 mb-md-4">Renting Form</h3>
                    <div class="mb-md-4">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title custom-card-title">{{$car['name']}}</h4>
                            @if (isset($reservation->total))
                            <h4 class="text-primary"> Total: <span id="RFTotal">123</span>$ </h4>
                            @else
                            <h4 class="text-primary"> Total: <span id="RFTotal">{{$car['price_per_day']}}</span>$ </h4>
                            @endif
                        </div>
                        <img src="{{$car['image']}}" class="w-100 custom-card-img-top">
                    </div>
                    <form id="RForm">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div data-mdb-input-init class="form-outline">
                                    @if (isset($reservation->name))
                                    <input 
                                        value="{{$reservation->name}}" 
                                        type="text" 
                                        id="nameRForm" 
                                        name="nameRForm"
                                        class="form-control form-control-lg" 
                                        required
                                    />
                                    @else
                                    <input 
                                        value="{{$reservation->name}}" 
                                        type="text" 
                                        id="nameRForm" 
                                        name="nameRForm"
                                        class="form-control is-invalid form-control-lg" 
                                        required
                                    />
                                    @endif
                                    <label class="form-label" for="nameRForm">Name</label>
                                    <div class="invalid-feedback">Name is required.</div>
                                </div>

                            </div>
                            <div class="col-md-6 mb-4">
                                <div data-mdb-input-init class="form-outline">
                                    @if (isset($reservation->license))
                                    <input 
                                        value="{{$reservation->license}}" 
                                        type="text" 
                                        id="licenseRForm" 
                                        name="licenseRForm" 
                                        class="form-control form-control-lg" 
                                        pattern="[A-Za-z0-9]{9}"

                                    />
                                    @else
                                    <input 
                                        value="{{$reservation->license}}" 
                                        type="text" 
                                        id="licenseRForm" 
                                        name="licenseRForm" 
                                        class="form-control is-invalid form-control-lg" 
                                        pattern="[A-Za-z0-9]{9}"

                                    />
                                    @endif
                                    <label class="form-label" for="licenseRForm">License No</label>
                                    <div class="invalid-feedback">License number must be 9 characters.</div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4 pb-2">
                                <div data-mdb-input-init class="form-outline">
                                    @if (isset($reservation->email))
                                    <input 
                                        type="email" 
                                        value="{{$reservation->email}}" 
                                        id="emailRForm" 
                                        name="emailRForm" 
                                        class="form-control form-control-lg" 
                                        required
                                    />
                                    @else
                                    <input 
                                        type="email" 
                                        id="emailRForm" 
                                        name="emailRForm" 
                                        class="form-control form-control-lg is-invalid" 
                                        required
                                    />
                                    @endif
                                    <label class="form-label" for="emailRForm">Email</label>
                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>

                            </div>
                            <div class="col-md-6 mb-4 pb-2">

                                <div data-mdb-input-init class="form-outline">
                                    @if (isset($reservation->phone))
                                    <input 
                                        type="tel" 
                                        value="{{$reservation->phone}}" 
                                        id="phoneRForm" 
                                        name="phoneRForm" 
                                        class="form-control form-control-lg"
                                        pattern="\d{10}"
                                    />
                                    @else
                                    <input 
                                        type="tel" 
                                        id="phoneRForm" 
                                        name="phoneRForm" 
                                        class="form-control form-control-lg is-invalid"
                                        pattern="\d{10}"
                                    />
                                    @endif
                                    <div class="invalid-feedback">Phone number must be 10 digits.</div>
                                    <label class="form-label" for="phoneRForm">Phone Number</label>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-4 pb-2">
                                <label class="form-label">Rent duration</label>
                                <div data-mdb-input-init class="form-outline">
                                    @if (isset($reservation->startDate) and isset($reservation->endDate))
                                    <input 
                                        type="text" 
                                        id="durationRForm" 
                                        name="durationRForm"
                                        value="{{$reservation->startDate}} - {{$reservation->endDate}}"
                                        class="form-control form-control-lg"
                                    />
                                    @else
                                    <input 
                                        type="text" 
                                        name="durationRForm"
                                        id="durationRForm" 
                                        class="form-control form-control-lg"
                                    />
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col mb-4 pb-2">
                                <div class="form-outline" data-mdb-input-init>
                                    @if(isset($reservation->qty))
                                    <input 
                                        type="number" 
                                        id="qtyRForm" 
                                        name="qty"
                                        min="1" 
                                        value="{{$reservation->qty}}" 
                                        class="form-control form-control-lg" 
                                    />
                                    @else
                                    <input 
                                        type="number" 
                                        id="qtyRForm" 
                                        name="qty"
                                        min="1" 
                                        value="1" 
                                        class="form-control form-control-lg" 
                                    />
                                    @endif
                                    <div class="invalid-feedback">Quantity must be less than {{$car['quantity']}} and should be required.</div>
                                    <label class="form-label" for="qtyRForm">Quantity</label>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="mt-4 pt-2">
                        <button id="RForm-submit-btn" class="btn btn-primary btn-lg disabled">
                            Submit
                        </button>

                        <button id="RForm-cancel-btn" class="btn btn-dark btn-lg">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const carID = @json($car['id']);
        const carQty = @json($car['quantity']);
        const carPrice = @json($car['price_per_day']);
    </script>
    @else
    <div class="row">
        <div class="col-12 py-4">
            <img src="{{ asset('img/notfound.svg') }}" class="d-block m-auto py-4 w-50" alt="No results" loading="lazy" />
            <h1 class="text-center text-primary">No reservation found or your reservation car has became unavailable</h1>
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

@section('reservation-script')
<script type="text/javascript" src="{{ asset('js/reservation.js') }}"></script>
@endsection