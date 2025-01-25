@extends('welcome')

@section('content')


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h4 class="card-title">Add Group</h4>

                <form action="{{ Route('group.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 mt-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Name</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="name">
                        </div>
                    </div>
                    <div class="mb-3 mt-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">File</label>
                        <div class="col-md-10">
                            <input class="form-control" type="file" name="file">
                            <small class="text text-danger">Accept: .xlsx File extension</small>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->


@endsection