@extends('backend.template')

@section('konten')
    <div class="card card-header-actions mb-4">
        <div class="card-header ">Pengaturan</small>
        </div>
        <div class="card-body">

            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-8">
                    <h5 class="card-title mb-4">Enter your Settings information</h5>
                    <form action="{{ route('setting.store') }}" method="POST">
                        @csrf
                        {{-- <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users
                                on the site)</label>
                            <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username"
                                value="username">
                        </div> --}}
                        <div class="row gx-3">
                            <div class="mb-3 col-md-6">
                                <label class="small mb-1" for="inputFirstName">Keterangan</label>
                                <input class="form-control" id="name" name="name" type="text"
                                    placeholder="Keterangan"
                                    value="{{ isset($data['detail']->name) ? $data['detail']->name : old('name') }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="small mb-1" for="inputLastName">Host TTE</label>
                                <input class="form-control" id="host_tte" name="host_tte" type="text"
                                    placeholder="Host TTE"
                                    value="{{ isset($data['detail']->host_tte) ? $data['detail']->host_tte : old('host_tte') }}">
                            </div>
                        </div>

                        <hr class="my-4">
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
