@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Test Page</div>
                
                <div class="card-body">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('test.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">   
                            <div class="col-md-6">
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success">Upload</button>
                            </div>         
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
