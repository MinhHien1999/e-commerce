@if((session('message')))
    <div class="alert alert-success">
    <strong>Success!</strong> {{session('message')}}
    </div>
@endif

@if((session('error')))
    <div class="alert alert-danger">
        <strong>Danger!</strong> {{session('error')}}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif