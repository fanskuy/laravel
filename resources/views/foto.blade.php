@extends('layouts.admin')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                    <div class="d-flex d-sm-block d-md-flex align-items-center">
                                        <a href="{{ route('album') }}" class="me-3"><i
                                                class="mdi mdi-chevron-left"></i></a>
                                        <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#createfoto">Unggah Foto</button>
                                        <!-- The Modal Create -->
                                        <div class="modal fade" id="createfoto">
                                            <div class="modal-dialog modal-dialog-centered modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="p-4 md:p-5 space-y-4">
                                                            <form action="{{ route('foto.store') }}" method="post"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="album_id"
                                                                    value="{{ Session('album_id') }}">
                                                                <div class="mb-3">
                                                                    <label for="image" class="form-label"><b>Unggah
                                                                            Foto</b></label>
                                                                    <input type="file" name="image"
                                                                        class="form-control text-white" id="image"
                                                                        placeholder="Foto" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="title" class="form-label"><b>Judul
                                                                            Foto</b></label>
                                                                    <input type="text" name="title"
                                                                        class="form-control text-white" id="title"
                                                                        placeholder="Judul Foto" required>
                                                                </div>
                                                                <div class="d-grid justify-content-end">
                                                                    <button type="submit"
                                                                        class="btn btn-outline-success w-100">Konfirmasi</button>
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
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    @if ($fotos->isEmpty())
                                        <p class="text-white"><b>Anda belum mengunggah foto apapun.</b></p>
                                    @else
                                        @foreach ($fotos as $item)
                                            <div class="col-md-3 mb-4">
                                                <div class="card-sl">
                                                    <div class="card-image">
                                                        <img src="{{ asset('images/' . $item->image) }}" />
                                                    </div>
                                                    <form action="{{ route('like', ['id' => $item->id]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="card-action">
                                                            <i class="mdi mdi-heart-outline"></i>
                                                        </button>
                                                    </form>
                                                    <div class="card-heading text-dark">
                                                        {{ $item->title }}
                                                    </div>
                                                    <div class="card-text">
                                                        {{ $item->like }}
                                                    </div>
                                                    <div class="card-buttons">
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#comment{{ $item->id }}"
                                                            class="card-button-comment"><i
                                                                class="mdi mdi-comment-text-outline"></i>{{ $item->comments->count() }}</a>
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#editfoto{{ $item->id }}"
                                                            class="card-button-pencil"><i class="mdi mdi-pencil"></i></a>
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#deletefoto{{ $item->id }}"
                                                            class="card-button-delete"><i class="mdi mdi-delete"></i></a>
                                                    </div>
                                                    <!-- The Modal Edit -->
                                                    <div class="modal fade" id="editfoto{{ $item->id }}"
                                                        aria-labelledby="editfoto{{ $item->id }}">
                                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <div class="p-4 md:p-5 space-y-4">
                                                                        <form
                                                                            action="{{ route('foto.update', ['id' => $item->id]) }}"
                                                                            method="post" enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            {{-- <div class="mb-3">
                                                                                <label for="image"
                                                                                    class="form-label"><b>Unggah
                                                                                        Foto</b></label>
                                                                                <input type="file" name="image"
                                                                                    class="form-control text-white"
                                                                                    id="image"
                                                                                    value="{{ asset('images/' . $item->image) }}"
                                                                                    required>
                                                                            </div> --}}
                                                                            <div class="mb-3">
                                                                                <label for="title"
                                                                                    class="form-label"><b>Judul
                                                                                        Foto</b></label>
                                                                                <input type="text" name="title"
                                                                                    class="form-control text-white"
                                                                                    id="title"
                                                                                    value="{{ $item->title }}" required>
                                                                            </div>
                                                                            <div class="d-grid justify-content-end">
                                                                                <button type="submit"
                                                                                    class="btn btn-outline-warning w-100">Konfirmasi</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- The Modal Delete -->
                                                    <div class="modal fade" id="deletefoto{{ $item->id }}"
                                                        aria-labelledby="deletefoto{{ $item->id }}">
                                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <div class="p-4 md:p-5 space-y-4">
                                                                        <form
                                                                            action="{{ route('foto.destroy', ['id' => $item->id]) }}"
                                                                            method="post" enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <div class="mb-3">
                                                                                <label for="title"
                                                                                    class="form-label text-white">Apakah
                                                                                    anda
                                                                                    ingin
                                                                                    menghapus <b>Foto
                                                                                        {{ $item->title }}</b>?</label>
                                                                            </div>
                                                                            <div class="d-grid justify-content-end">
                                                                                <button type="submit"
                                                                                    class="btn btn-outline-danger w-100"><i
                                                                                        class="mdi mdi-delete me-2"></i>Hapus
                                                                                    Foto</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- The Modal Comment -->
                                                    @foreach ($fotos as $item)
                                                        <!-- Modal untuk komentar -->
                                                        <div class="modal fade" id="comment{{ $item->id }}"
                                                            aria-labelledby="comment{{ $item->id }}">
                                                            <div class="modal-dialog modal-dialog-centered modal-md">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <div class="p-4 md:p-5 space-y-4">
                                                                            <!-- Menampilkan komentar -->
                                                                            @if ($item->comments->count() > 0)
                                                                                @foreach ($item->comments as $comment)
                                                                                    <div class="row">
                                                                                        <div class="col-md-10">
                                                                                            <p class="text-white komentar">
                                                                                                <b>{{ $comment->user->name }}</b>
                                                                                                {{ $comment->content }}
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <form class="text-center"
                                                                                                action="{{ route('comment.destroy', ['id' => $comment->id]) }}"
                                                                                                method="post"
                                                                                                enctype="multipart/form-data">
                                                                                                @csrf
                                                                                                @method('DELETE')
                                                                                                <button type="submit"
                                                                                                    class="btn btn-outline-danger"><i
                                                                                                        class="mdi mdi-delete"></i></button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            @else
                                                                                <p class="text-white">Tidak ada komentar.
                                                                                </p>
                                                                            @endif
                                                                        </div>
                                                                        <!-- Form untuk menambah komentar -->
                                                                        <div class="p-4 md:p-5 space-y-4">
                                                                            <form
                                                                                action="{{ route('comment', ['id' => $item->id]) }}"
                                                                                method="POST" class="d-flex">
                                                                                @csrf
                                                                                <textarea name="content" class="form-control text-white" placeholder="Tambahkan komentar..."></textarea>
                                                                                <button type="submit"
                                                                                    class="btn btn-outline-primary"><i
                                                                                        class="mdi mdi-telegram"></i></button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
