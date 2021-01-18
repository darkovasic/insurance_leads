@extends('admin.layouts.app')

@section('content')
<div id="page-inner">
    <div class="row">
        <div class="col-lg-12">
            <h2>IMPORT LEADS FROM FILE</h2>
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

                {{-- @if (session()->has('failures'))
                    <table class="table table-danger">
                        <tr>
                            <th>Row</th>
                            <th>Attribute</th>
                            <th>Errors</th>
                            <th>Value</th>
                        </tr>
                        @foreach (session()->get('failures') as $validation)
                            <tr>
                                <td>{{ $validation->row() }}</td>
                                <td>{{ $validation->attribute() }}</td>
                                <td>
                                    <ul>
                                        @foreach ($validation->errors() as $e)
                                            <li>{{ $e }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $validation->values()[$validation->attribute()] }}</td>
                            </tr>
                        @endforeach
                    </table>
                @endif --}}

                <div class="card-header">
                    Update leads from file:
                </div>
                <div class="card-body">
                    <form action="{{ route('import-leads') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" name="file" />
                        </div>
                        <button type="submit" class="btn btn-success">Import Leads</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection