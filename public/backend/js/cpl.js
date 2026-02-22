function komentarku(status, titlex, textx) {
    if (status == 0) {
        iconx = "error";
    } else {
        iconx = "success";
    }
    Swal.fire({
        title: titlex,
        text: textx,
        icon: iconx,
    });
}
