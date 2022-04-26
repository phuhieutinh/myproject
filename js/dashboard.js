function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");

  var nofication = document.getElementById("myNofication");
  nofication.classList.toggle("show");
}

function addpopup() {
  var blur = document.getElementById("blur");
  blur.classList.toggle("active");

  var progress = document.getElementById("popupProgress");
  progress.classList.toggle("show");
}

$(".chosen-select").chosen({
  no_results_text: "Oops, nothing found!",
});

function popup_info() {
  var progress = document.getElementById("popupInfo");
  progress.classList.toggle("show");
}
