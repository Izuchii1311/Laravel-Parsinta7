{{-- Alert Condition --}}
@if (session()->has('success'))
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                </div>
            </div>
        </div>
    </div>
@elseif (session()->has('error'))
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-4">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session()->get('error') }}
                </div>
            </div>
        </div>
    </div>
@endif
