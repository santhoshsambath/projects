var slideIndex = 1;
showDivs(slideIndex);

function show_next_picture(n) {
  showDivs(slideIndex += n);
}
function show_previous_picture(n) {
    showDivs(slideIndex += n);
  }
function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
  var captions = [ "Tanjore","Thirupathi","Madurai","Mylapore" ] ;
    var cap = document.getElementById("caption");
    cap.innerHTML = captions[slideIndex-1] ;  
}
////////////////////////////////////width--shrink----enlarge code////////////
var slideIndexWidth = 1;
showDivsWidth(slideIndexWidth);

function decreaseWidth(n) {
    showDivsWidthDecrease(slideIndexWidth += n);
}
function increaseWidth(n) {
    showDivsWidthIncrease(slideIndexWidth += n);
  
  }
function showDivsWidthIncrease(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndexWidth = 1}
  if (n < 1) {slideIndexWidth = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  x[slideIndexWidth-1].style.display = "block";  
  var wid = parseInt(x[slideIndexWidth-1].style.width);
  var data = wid + 100;  
  x[slideIndexWidth-1].style.width = data  +"px";
  //alert(wid);
}
function showDivsWidthDecrease(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    if (n > x.length) {slideIndexWidth = 1}
    if (n < 1) {slideIndexWidth = x.length}
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";  
    }
    x[slideIndexWidth-1].style.display = "block";  
    var wid = parseInt(x[slideIndexWidth-1].style.width);
    var data = wid - 100;  
    x[slideIndexWidth-1].style.width = data + "px";
    //alert(wid);
  }