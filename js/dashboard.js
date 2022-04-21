function myFunction() {
  var popup = document.getElementById("myPopup");
  var nofication = document.getElementById("myNofication");
  popup.classList.toggle("show");
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
