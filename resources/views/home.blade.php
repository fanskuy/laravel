@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#createalbum">Buat
                            Album</button>
                        <!-- The Modal Create -->
                        <div class="modal fade" id="createalbum">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="p-4 md:p-5 space-y-4">
                                            <form action="{{ route('album.store') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="name" class="form-label"><b>Nama
                                                            Album</b></label>
                                                    <input type="text" name="name" class="form-control" id="name"
                                                        placeholder="Nama Album" required>
                                                </div>
                                                <div class="d-grid justify-content-end">
                                                    <button type="submit" class="btn btn-outline-success w-100">Buat
                                                        Album</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($albums->isEmpty())
                    <p class="text-white"><b>Anda belum mempunyai Album.</b></p>
                @else
                    @foreach ($albums as $item)
                        @if (auth()->check() && auth()->user()->id === $item->user_id)
                            <div class="col mb-3">
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('album.foto', $item->id) }}"
                                        class="d-flex align-items-center text-decoration-none">
                                        <img src="https://img.icons8.com/color/100/000000/folder-invoices.png"
                                            width="90" class="mr-3" />
                                    </a>
                                    <div class="dropdown text-white">
                                        <h6 class="dropdown-toggle text-white me-2" id="action" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"><b>{{ $item->name }}</b></h6>
                                        <div class="about " style="font-size: 12px;">
                                            <span class="ymd">{{ $item->created_at->format('Y-m-d') }}</span>
                                            <p class="time">{{ $item->created_at->format('H:i:s') }}</p>
                                        </div>
                                        <div class="dropdown-menu" aria-labelledby="action">
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#editalbum{{ $item->id }}"><i
                                                    class="mdi mdi-pencil text-warning me-2"></i><span
                                                    class="text-warning">Ubah</span></a>
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#deletealbum{{ $item->id }}"><i
                                                    class="mdi mdi-delete text-danger me-2"></i><span
                                                    class="text-danger">Hapus</span></a>
                                        </div>
                                        <!-- The Modal Edit -->
                                        <div class="modal fade" id="editalbum{{ $item->id }}"
                                            aria-labelledby="editalbum{{ $item->id }}">
                                            <div class="modal-dialog modal-dialog-centered modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="p-4 md:p-5 space-y-4">
                                                            <form action="{{ route('album.update', ['id' => $item->id]) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="name" class="form-label"><b>Nama
                                                                            Album</b></label>
                                                                    <input type="text" name="name"
                                                                        class="form-control text-white" id="name"
                                                                        value="{{ $item->name }}" required>
                                                                </div>
                                                                <div class="d-grid justify-content-end">
                                                                    <button type="submit"
                                                                        class="btn btn-outline-warning w-100">Ubah
                                                                        Album</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- The Modal Delete -->
                                        <div class="modal fade" id="deletealbum{{ $item->id }}"
                                            aria-labelledby="deletealbum{{ $item->id }}">
                                            <div class="modal-dialog modal-dialog-centered modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="p-4 md:p-5 space-y-4">
                                                            <form
                                                                action="{{ route('album.destroy', ['id' => $item->id]) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="mb-3">
                                                                    <label for="name" class="form-label">Apakah anda
                                                                        ingin
                                                                        menghapus <b>Album
                                                                            {{ $item->name }}</b>?</label>
                                                                </div>
                                                                <div class="d-grid justify-content-end">
                                                                    <button type="submit"
                                                                        class="btn btn-outline-danger w-100"><i
                                                                            class="mdi mdi-delete me-2"></i>Hapus
                                                                        Album</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
