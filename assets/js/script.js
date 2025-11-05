$(document).ready(function () {
  // Change carousel on tab click
  $(".tab-item").on("click", function () {
    let index = $(this).data("index");
    $("#sectionSlider").carousel(index);
    $(".tab-item").removeClass("active");
    $(this).addClass("active");
  });

  // Update right image and active tab on carousel change
  $("#sectionSlider").on("slid.bs.carousel", function (e) {
    let $active = $(e.relatedTarget);
    let img = $active.data("image");
    $("#slideImage").attr("src", "files/images/" + img);

    let index = $active.data("index");
    $(".tab-item").removeClass("active");
    $('.tab-item[data-index="' + index + '"]').addClass("active");
  });
});
