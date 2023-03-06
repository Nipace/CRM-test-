@if($message = Session::get('message'))
    <div class="col-12">
        <div class="alert alert-success alert-dismissible show fade">
            {{ $message }}
        </div>
    </div>
@endif
@if($message = Session::get('error'))
    <div class="col-12">
        <div class="alert alert-danger alert-dismissible show fade">
            {{ $message }}
        </div>
    </div>
@endif
