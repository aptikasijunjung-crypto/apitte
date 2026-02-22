$("form#box-dokumen").submit(function (e) {
  $.LoadingOverlay("show");
  $.post(
    "pages/dokumen/box-dokumen.php",
    $(this).serialize(),
    function (data) {
      if (data.id == 0) {
        komentar("Pesan Kesalahan", data.komen);
      } else {
        $("div.content-center").html(data.box);
      }
      // $("div.content-center").html(data);
      $.LoadingOverlay("hide");
    },
    "json"
  );
});
