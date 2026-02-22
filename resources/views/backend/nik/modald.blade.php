<form id="proses" onsubmit="return false;">
    @csrf
    <input type="hidden" value="{{ $data['id'] }}" name="id" id="id">
    <button type="submit" class="btn btn-danger">Hapus</button>
    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
</form>

<script>
    $("form#proses").submit(function(e) {
        e.preventDefault();
        $.post("{{ route('nik.delete') }}", $(this).serialize(),
            function(data) {
                if (data.id == 0) {
                    alert(data.komen)
                } else {
                    $('tr#baris-' + data.vid).fadeOut('slow', function() {
                        $(this).remove();
                    });
                    alert(data.komen);
                }
                $('#myModal').modal('hide');
            }, "json");

    });
</script>
