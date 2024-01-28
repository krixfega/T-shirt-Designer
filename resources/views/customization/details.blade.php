@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Customization Details') }}</div>

                    <div class="card-body">
                        <h5>Design:</h5>
                        <p>{{ $customization->design }}</p>

                        <h5>Customized T-Shirt:</h5>
                        <img src="{{ asset('storage/' . $customization->image_path) }}" alt="Customized T-Shirt Image" class="img-fluid">

                        <h5>Generated Code:</h5>
                        <pre>{{ $customization->generated_code }}</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
