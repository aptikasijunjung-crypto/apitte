@extends('backend.template')

@section('konten')
    <div class="card mb-4">
        <div class="card-header">Account Details</div>
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
            <form action="{{ route('dashboard.store') }}" method="POST">
                <input type="hidden" name="id" id="id" value="{{ $data['slug']['id'] }}">
                @csrf
                <!-- Form Group (username)-->
                <div class="mb-3">
                    <label class="small mb-1">Nama Instansi/Perusahaan</label>
                    <input class="form-control" id="name" name="name" type="text"
                        placeholder="Nama Instansi/Perusahaan"
                        value="{{ empty($data['slug']['id']) ? old('name') : $data['detail']->name }}">
                </div>
                <!-- Form Row-->
                <div class="row gx-3 mb-3">
                    <!-- Form Group (first name)-->
                    <div class="col-md-6">
                        <label class="small mb-1">Email</label>
                        <input class="form-control" id="email" name="email" type="text" placeholder="Email"
                            value="{{ empty($data['slug']['id']) ? old('email') : $data['detail']->email }}">
                    </div>
                    <!-- Form Group (last name)-->
                    <div class="col-md-6">
                        <label class="small mb-1">Password</label>
                        <input class="form-control" id="inputLastName" type="password" placeholder="Password"
                            name="password">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="small mb-1">Kegunaan</label>
                    <textarea name="kegunaan" id="kegunaan" class="form-control" placeholder="Kegunaan">{{ empty($data['slug']['id']) ? old('kegunaan') : $data['detail']->kegunaan }}</textarea>
                </div>
                <button class="btn btn-primary" type="submit">Save</button>
                <a href="{{ route('dashboard') }}" class="btn btn-light">Batal</a>
            </form>
        </div>
    </div>
@endsection
