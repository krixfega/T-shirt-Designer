
@extends('layouts.app') <!-- Assuming you have a layout file, adjust as needed -->

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('T-Shirt Customization') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ url('/customize') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="design">T-Shirt Design:</label>
                                <input type="text" name="design" id="design" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="image">Upload Image:</label>
                                <input type="file" name="image" id="image" class="form-control-file" required accept="image/*">
                            </div>

                            <button type="submit" class="btn btn-primary">Customize T-Shirt</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
