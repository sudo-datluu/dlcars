@extends("layouts.app")
@extends("layouts.nav-categories")
@section('content')
<div class="d-flex align-content-start flex-wrap" style="max-width: 1024px;">

    <div class="card mb-3 me-3" style="max-width: 480px;">
        <img src="https://mdbcdn.b-cdn.net/img/new/slides/041.webp" class="card-img-top" alt="Wild Landscape" />
        <div class="card-body">
            <div class="d-flex">
                <div class="py-2 me-2 text-primary"> Brand </div>
                <div class="py-2 text-primary"> Type </div>
                <div class="ms-auto py-2"> Qty </div>
            </div>
            <div class="d-flex justify-content-between">
                <h4 class="card-title">Card title</h4>
                <h5> $15,000 </h5>
            </div>
            <p class="card-text">
                This is a wider card with supporting text below as a natural lead-in to additional
                content. This content is a little bit longer.
            </p>
            <p class="card-text">
                <small class="text-muted">Last updated 3 mins ago</small>
            </p>
        </div>
    </div>

    <div class="card mb-3" style="max-width: 480px;">
        <img src="https://mdbcdn.b-cdn.net/img/new/slides/041.webp" class="card-img-top" alt="Wild Landscape" />
        <div class="card-body">
            <div class="d-flex">
                <div class="py-2 me-2 text-primary"> Brand </div>
                <div class="py-2 text-primary"> Type </div>
                <div class="ms-auto py-2"> Qty </div>
            </div>
            <div class="d-flex justify-content-between">
                <h4 class="card-title">Card title</h4>
                <h5> $15,000 </h5>
            </div>
            <p class="card-text">
                This is a wider card with supporting text below as a natural lead-in to additional
                content. This content is a little bit longer.
            </p>
            <p class="card-text">
                <small class="text-muted">Last updated 3 mins ago</small>
            </p>
        </div>
    </div>
</div>
@endsection