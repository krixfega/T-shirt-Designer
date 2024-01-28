@extends('layouts.app')

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

                            <div class="form-group my-3 ">
                                <label for="image">Upload Image:</label><br>
                                <input type="file" name="image" id="image" class="form-control-file" required accept="image/*">
                            </div>

                            <button type="submit" class="btn btn-primary">Customize T-Shirt</button>
                        </form>

                        <!-- Display the uploaded image and generated code -->
                        @if(isset($imagePath))
                            <div class="mt-3">
                                <h5>Customized T-Shirt:</h5>
                                <img src="{{ asset('storage/' . $imagePath) }}" alt="Customized T-Shirt Image" class="img-fluid">
                            </div>
                            <div class="mt-3">
                                <h5>Generated Code:</h5>
                                <pre>{{ $generatedCode }}</pre>
                            </div>
                        @endif

                        <!-- Display a list of previous customizations -->
                    @if(isset($previousCustomizations))
                        <div class="mt-5">
                            <h3>Previous Customizations:</h3>
                            <ul>
                                @foreach($previousCustomizations as $customization)
                                    <li>
                                        <a href="{{ route('customization.details', $customization->id) }}">
                                            {{ $customization->design }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection