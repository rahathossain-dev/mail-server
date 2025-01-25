@extends('welcome')
@section('content')

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
                        <h3>All Group</h3>
                        <div>
                            <a href="{{Route('group.add')}}" class="btn btn-success">Add Group</a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Total Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $index => $group)
                                <tr>
                                    <th scope="row">{{ ++$index }}</th>
                                    <td>{{ $group->name }}</td>
                                    <td>{{ $group?->totoalMail?->count() }}</td>
                                    <td>
                                        <div class="d-flex justify-content-betwen gap-2">
                                            <a href="{{ Route('group.edit', [$group->id]) }}"
                                                class="btn btn-info btn-sm">Edit</a>
                                            <a href="{{ Route('group.delete', [$group->id]) }}"
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