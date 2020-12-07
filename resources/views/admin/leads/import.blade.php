@extends('admin.layouts.app')

@section('content')
<div id="page-inner">
    <div class="row">
        <div class="col-lg-12">
            <h2>IMPORT FROM EXCEL</h2>
        </div>
    </div>
    <hr />
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if (isset($errors) && $errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <div class="card-header">
                    Update leads from file:
                </div>
                <div class="card-body">
                    <form action="{{ route('import-leads') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="file" />
                            <button type="submit" class="btn btn-success">Import Lead Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection