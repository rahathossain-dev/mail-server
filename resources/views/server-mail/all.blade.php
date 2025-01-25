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
                        <h3>All Server Mails</h3>
                        <div>
                            <a href="{{Route('server-mail.add')}}" class="btn btn-success">Add Mail</a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Email</th>
                                <th>Configure Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mails as $index => $mail)
                                <tr>
                                    <th scope="row">{{ ++$index }}</th>
                                    <td>{{ $mail->email }}</td>
                                    <td>
                                        @if (!(\App\Models\Credintial::where('user_id', $mail->id)->first()))
                                            <a class="btn btn-primary btn-xs"
                                                href="{{ Route('server-mail.authenticate', [$mail->id]) }}">Give
                                                permission</a>
                                        @else
                                            <span class="alert alert-success">Permited</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-betwen gap-2">
                                            <a href="{{ Route('server-mail.edit', [$mail->id]) }}"
                                                class="btn btn-info btn-sm">Edit</a>
                                            <a href="{{ Route('server-mail.delete', [$mail->id]) }}"
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