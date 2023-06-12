@extends('layouts.main')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="my-4">Slider</h1>
            <a class="btn btn-primary mb-2" href="{{ route('slider.create') }}" role="button">Create New</a>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
