@extends('layouts.main')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="my-4">Slider</h1>
            <div class="card mb-4">
                <div class="card-body">
                    <table id="dataTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Caption</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Approve</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->caption }}</td>
                                    <td>
                                        @if ($slider->image == null)
                                            <span class="badge bg-primary">No Image</span>
                                        @else
                                        <img src="{{ asset('storage/slider/' . $slider->image) }}" class="img-fluid" style="max-width: 100px;"
                                            alt="{{ $slider->image }}">
                                        @endif
                                    </td>
                                    <td><span class="badge bg-success">{{ $slider->status}}</span></td>
                                    <td>
                                        <div class="d-grid gap d-md-flex justify-content-md-start">
                                            @if ($slider->status == 'Pending')
                                                <form method="POST" action="{{ route('slider.accept', $slider->id) }}">
                                                    @csrf
                                                    <button class="btn btn-success me-md-2" type="submit">Accept</button>
                                                </form>
                                            @endif
                                            @if ($slider->status == 'Pending')
                                                <form method="POST" action="{{ route('slider.reject', $slider->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Reject</button>
                                                </form>
                                            @endif
                                          </div>
                                    </td>
                                    <td>
                                        <form onsubmit="return confirm('Are you sure? ');" action="{{ route('slider.destroy', $slider->id) }}" method="POST">
                                            <a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
