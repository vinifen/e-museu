// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementsByClassName("clickable-image");
var modalImg = document.getElementById("modal-img");
var captionText = document.getElementById("modal-caption");

// Loop through all images with the class "clickable-image" and attach a click event listener
for (var i = 0; i < img.length; i++) {
  img[i].addEventListener("click", function() {
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  });
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks outside the modal content, close the modal
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
