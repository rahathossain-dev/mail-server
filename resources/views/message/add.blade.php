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
                <h4 class="card-title">Add Message</h4>

                <form action="{{ Route('message.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 mt-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Name</label>
                        <div class="col-md-10">
                            <input class="form-control" placeholder="Name" type="text" name="name">
                        </div>
                    </div>
                    <div class="mb-3 mt-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Subject</label>
                        <div class="col-md-10">
                            <input class="form-control" placeholder="Subject" type="text" name="subject">
                        </div>
                    </div>
                    <div class="mb-3 mt-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">body</label>
                        <div class="col-md-10">
                            <textarea class="form-control" placeholder="Message" rows="7" name="body"></textarea>
                        </div>
                    </div>
                    <div class="mb-3 mt-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Attachments</label>
                        <div class="col-md-10">
                            <div id="repatImage">
                                <div class="row">
                                    <div class="col-md-8">
                                        <input type="file" name="images[]" class="form-control my-2" id="">
                                    </div>
                                </div>
                            </div>
                            <button id="addImage" class="btn btn-primary mt-3">Add Image</button>
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

<script>
    const addImage = document.getElementById('addImage')
    const repatImage = document.getElementById('repatImage')
    const singleElement = `<div class="row">
                                    <div class="col-md-8">
                                        <input type="file" name="images[]" class="form-control my-2" id="">
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-danger my-2" onclick="removeField(event)">Remove</button>
                                    </div>
                                </div>`;
    addImage.addEventListener('click', (e) => {
        e.preventDefault();
        repatImage.innerHTML += singleElement;
    })

    function removeField(event) {
        event.preventDefault();
        event.target.closest('div').parentElement.remove()
    }
</script>

@endsection