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
                        <h3>All Messages</h3>
                        <div>
                            <a href="{{Route('message.add')}}" class="btn btn-success">Add Message</a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $index => $message)
                                <tr>
                                    <th scope="row">{{ ++$index }}</th>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->subject }}</td>
                                    <td>
                                        <div class="d-flex justify-content-betwen gap-2">
                                            <a href="{{ Route('server-mail.edit', [$message->id]) }}"
                                                class="btn btn-info btn-sm">Edit</a>
                                            <a href="{{ Route('server-mail.delete', [$message->id]) }}"
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