function content(elem) {
    var backgroundColor = elem.style.backgroundColor;

    if(backgroundColor == "green") {
        elem.style.backgroundColor = "white";
        document.getElementById("i" + elem.id).value = 0;
    } else {
        elem.style.backgroundColor = "green";
        document.getElementById("i" + elem.id).value = 1;
    }
}

var btnManha = document.getElementById("btnManha");
var btnTarde = document.getElementById("btnTarde");
var btnTodos = document.getElementById("btnTodos");

btnManha.onclick = function() {
    content(document.getElementById("seg8"));  
    content(document.getElementById("seg9"));
    content(document.getElementById("seg10"));
    content(document.getElementById("seg11"));

    content(document.getElementById("ter8"));
    content(document.getElementById("ter9"));
    content(document.getElementById("ter10"));
    content(document.getElementById("ter11"));

    content(document.getElementById("qua8"));
    content(document.getElementById("qua9"));
    content(document.getElementById("qua10"));
    content(document.getElementById("qua11"));

    content(document.getElementById("qui8"));
    content(document.getElementById("qui9"));
    content(document.getElementById("qui10"));
    content(document.getElementById("qui11"));

    content(document.getElementById("sex8"));
    content(document.getElementById("sex9"));
    content(document.getElementById("sex10"));
    content(document.getElementById("sex11"));
}

btnTarde.onclick = function() {

    content(document.getElementById("seg13"));
    content(document.getElementById("seg14"));
    content(document.getElementById("seg15"));
    content(document.getElementById("seg16"));
    content(document.getElementById("seg17"));
    content(document.getElementById("seg18"));

    content(document.getElementById("ter13"));
    content(document.getElementById("ter14"));
    content(document.getElementById("ter15"));
    content(document.getElementById("ter16"));
    content(document.getElementById("ter17"));
    content(document.getElementById("ter18"));

    content(document.getElementById("qua13"));
    content(document.getElementById("qua14"));
    content(document.getElementById("qua15"));
    content(document.getElementById("qua16"));
    content(document.getElementById("qua17"));
    content(document.getElementById("qua18"));

    content(document.getElementById("qui13"));
    content(document.getElementById("qui14"));
    content(document.getElementById("qui15"));
    content(document.getElementById("qui16"));
    content(document.getElementById("qui17"));
    content(document.getElementById("qui18"));

    content(document.getElementById("sex13"));
    content(document.getElementById("sex14"));
    content(document.getElementById("sex15"));
    content(document.getElementById("sex16"));
    content(document.getElementById("sex17"));
    content(document.getElementById("sex18"));
}

btnTodos.onclick = function() {
    content(document.getElementById("seg8"));  
    content(document.getElementById("seg9"));
    content(document.getElementById("seg10"));
    content(document.getElementById("seg11"));
    content(document.getElementById("seg12"));
    content(document.getElementById("seg13"));
    content(document.getElementById("seg14"));
    content(document.getElementById("seg15"));
    content(document.getElementById("seg16"));
    content(document.getElementById("seg17"));
    content(document.getElementById("seg18"));

    content(document.getElementById("ter8"));
    content(document.getElementById("ter9"));
    content(document.getElementById("ter10"));
    content(document.getElementById("ter11"));
    content(document.getElementById("ter12"));
    content(document.getElementById("ter13"));
    content(document.getElementById("ter14"));
    content(document.getElementById("ter15"));
    content(document.getElementById("ter16"));
    content(document.getElementById("ter17"));
    content(document.getElementById("ter18"));

    content(document.getElementById("qua8"));
    content(document.getElementById("qua9"));
    content(document.getElementById("qua10"));
    content(document.getElementById("qua11"));
    content(document.getElementById("qua12"));
    content(document.getElementById("qua13"));
    content(document.getElementById("qua14"));
    content(document.getElementById("qua15"));
    content(document.getElementById("qua16"));
    content(document.getElementById("qua17"));
    content(document.getElementById("qua18"));

    content(document.getElementById("qui8"));
    content(document.getElementById("qui9"));
    content(document.getElementById("qui10"));
    content(document.getElementById("qui11"));
    content(document.getElementById("qui12"));
    content(document.getElementById("qui13"));
    content(document.getElementById("qui14"));
    content(document.getElementById("qui15"));
    content(document.getElementById("qui16"));
    content(document.getElementById("qui17"));
    content(document.getElementById("qui18"));
    
    content(document.getElementById("sex8"));
    content(document.getElementById("sex9"));
    content(document.getElementById("sex10"));
    content(document.getElementById("sex11"));
    content(document.getElementById("sex12"));
    content(document.getElementById("sex13"));
    content(document.getElementById("sex14"));
    content(document.getElementById("sex15"));
    content(document.getElementById("sex16"));
    content(document.getElementById("sex17"));
    content(document.getElementById("sex18"));
}