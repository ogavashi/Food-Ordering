const modal = document.querySelector("#myModal");
const btn = document.querySelector("#user-register");
const span = document.querySelector(".close");

btn.addEventListener("click", () => {
  modal.style.display = "block";
});

span.addEventListener("click", () => {
  modal.style.display = "none";
});

$(window).scroll(function () {
  var scroll = $(window).scrollTop();
  if (scroll > 0) {
    $("header").addClass("active");
  } else {
    $("header").removeClass("active");
  }
});
