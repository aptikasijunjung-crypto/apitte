@extends('backend.template')


@section('konten')
    <div class="card card-header-actions mb-4">
        <div class="card-header">
            Daftar Akses Users
            <a href="{{ route('dashboard.create', ['slug' => Crypt::encrypt(['id' => 0, 'title' => 'Simpan User'])]) }}"
                class="btn btn-sm btn-primary">Tambah
                User</a>
        </div>
        <div class="card-body px-0">
            <div class="table-responsive table-billing-history">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>ORGANISASI/INSTANSI</th>
                            <th>EMAIL</th>
                            <th>KEGUNAAN/APLIKASI</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sql = DB::table('users')->get();
                        @endphp
                        @foreach ($sql as $item)
                            <tr id="baris-{{ $item->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->kegunaan }}</td>
                                <td class="text-center">
                                    <a class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                        href="{{ route('dashboard.create', ['slug' => Crypt::encrypt(['id' => $item->id, 'title' => 'Edit User'])]) }}"><i
                                            data-feather="edit"></i></a>
                                    <button type="button"
                                        class="btn btn-datatable btn-icon btn-transparent-dark modal-delete"
                                        id="{{ $item->id }}"><i data-feather="trash-2"></i></button>
                                    <a class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                        href="{{ route('nik.index', ['slug' => Crypt::encrypt(['id' => $item->id, 'title' => $item->name])]) }}"><i
                                            data-feather="user-check"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    @php
        echo myModal('myModal', 'modal-sm');
    @endphp
@endsection

@section('jquery')
    <script>
        $(document).on("click", "button.modal-delete", function() {
            $("#myModal").modal("show")
            id = $(this).attr('id')
            token = "{{ csrf_token() }}"
            $.post("{{ route('dashboard.modald') }}", {
                id: id,
                _token: token
            }, function(data) {
                $("div.myModal-body").html(data);
            });
        });
    </script>
@endsection
