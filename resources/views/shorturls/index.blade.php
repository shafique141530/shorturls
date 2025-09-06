 

@extends('layouts.default')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-10 offset-md-1">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Shorturls</h5>
                    <a href="{{ route('shorturl.create') }}" class="btn btn-light btn-sm">
                        Add Shorturl
                    </a>
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Long URL</th>
                                <th>Short URL</th>
                                <th>views</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($shorturls as $index => $shorturl)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $shorturl->long_url }}</td>
                                    <td><a href="{{ route('shorturl.hit', base64_encode($shorturl->id))  }}" target="_blank">{{ route('shorturl.hit', base64_encode($shorturl->id) )  }}</a></td>
                                    
                                    <td>{{ $shorturl->views }}</td>
									<td class="text-end">
									<a href="{{ route('shorturl.edit', $shorturl->id) }}" class="btn btn-light btn-sm">
										Edit
									</a>
									</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No shorturls found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                
            </div>

        </div>
    </div>
</div>

@stop