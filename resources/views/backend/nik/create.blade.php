@extends('backend.template')

@section('konten')
    <div class="card card-header-actions mb-4">
        <div class="card-header ">Account Details <small>{{ $data['slug']['name'] }}</small>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><code>{{ $error }}</code></li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session()->has('error'))
                <code>{{ session('error') }}</code>
            @endif
            <form action="{{ route('nik.store') }}" method="POST">
                <input type="hidden" name="id" id="id" value="{{ $data['slug']['id'] }}">
                <input type="hidden" name="user_id" id="user_id" value="{{ $data['slug']['kode'] }}">
                <input type="hidden" name="perusahaan" id="perusahaan" value="{{ $data['slug']['name'] }}">
                @csrf
                <!-- Form Group (username)-->
                <div class="mb-3">
                    <label class="small mb-1">Nama Penandatangan</label>
                    <input class="form-control" id="name" name="name" type="text"
                        placeholder="Nama Penandatangan"
                        value="{{ empty($data['slug']['id']) ? old('name') : $data['detail']->name }}">
                </div>
                <div class="mb-3">
                    <label class="small mb-1">NIK</label>
                    <input class="form-control" id="nik" name="nik" type="text" placeholder="NIK Pengguna"
                        value="{{ empty($data['slug']['id']) ? old('nik') : $data['detail']->nik }}">
                </div>
                <!-- Form Row-->

                <button class="btn btn-primary" type="submit">Save</button>
                <a href="{{ route('nik.index', ['slug' => Crypt::encrypt(['id' => $data['slug']['kode'], 'title' => $data['slug']['name']])]) }}"
                    class="btn btn-light">Batal</a>
            </form>
        </div>
    </div>
@endsection
