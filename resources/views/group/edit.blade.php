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
                <h4 class="card-title">Edit Group</h4>

                <form action="{{ Route('group.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 mt-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Name</label>
                        <div class="col-md-10">
                            <input class="form-control" value="{{ $group->name }}" type="text" name="name">
                            <input value="{{ $group->id }}" type="hidden" name="id">
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

<div class="row">
    <div class="col-lg-12">
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
                <div class="card-title">
                    <div class="d-flex justify-content-between">
                        <h3>All Email</h3>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($group->totoalMail as $index => $email)
                                <tr>
                                    <th scope="row">{{ ++$index }}</th>
                                    <td>{{ $email->email }}</td>
                                    <td>
                                        <div class="d-flex justify-content-betwen gap-2">
                                            <a href="{{ Route('group.groupMailDelete', [$email->id]) }}"
                                                class="btn btn-danger btn-sm">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection