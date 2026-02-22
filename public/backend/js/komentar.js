function komentar(judul, komen) {
  $.gritter.add({
    title: judul,
    text: komen,
    image:
      "http://s3.amazonaws.com/twitter_production/profile_images/132499022/myface_bigger.jpg",
    sticky: true,
    class_name: "gritter-light",
  });
}
