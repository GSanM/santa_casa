function content(elem) {
    var backgroundColor = elem.style.backgroundColor;

    if(backgroundColor == "green") {
        elem.style.backgroundColor = "white";
    } else {
        elem.style.backgroundColor = "green";
    }
  
    document.getElementById("i" + elem.id).value = 1;
}