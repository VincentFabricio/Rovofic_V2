function correcto() {
    alert("Su proceso se ha creado con exito");
}

function activateDiv(n) {
    x = "myDiv";
    x = x + n;
    document.getElementById(x).style.display = "block";
    document.getElementById("buttomx").style.visibility = "hidden";
}

function activateForm(m) {
    y = "myForm";
    y = y + m;
    x = "desc";
    x = x + m;
    z = "buttom";
    z = z + m;
    document.getElementById(y).style.display = "block";
    document.getElementById(x).style.display = "none"
    document.getElementById(z).style.display = "none"
}

function closeForm(m) {
    y = "myForm";
    y = y + m;
    x = "desc";
    x = x + m;
    z = "buttom";
    z = z + m;
    document.getElementById(y).style.display = "none";
    document.getElementById(x).style.display = "block"
    document.getElementById(z).style.display = "block"
}

function sortTable(n, tableId) {
    console.log(tableId);
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    if (tableId == 1) {
        table = document.getElementById("myTable");
    } else if (tableId == 2) {
        table = document.getElementById("myTable2");
    } else {
        alert("Error");
    }
    switching = true;
    //Set the sorting direction to ascending:
    dir = "asc";
    /*Make a loop that will continue until
    no switching has been done:*/
    while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
            one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /*check if the two rows should switch place,
            based on the direction, asc or desc:*/
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            //Each time a switch is done, increase this count by 1:
            switchcount++;
        } else {
            /*If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again.*/
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}

function myFunctions(x) {
    $(document).ready(function() {
        if (x == 1) {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase()
                        .indexOf(value) > -1)
                });
            });
        } else {
            $("#myInput2").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#tbody2 tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase()
                        .indexOf(value) > -1)
                });
            });
        }
    });
}

/*Selecciona la fila y se cambia el estilo cuando le das click con el ratón*/
function myFunction(x) {
    if (document.getElementsByClassName("trselected").length > 0) {
        var element = document.getElementsByClassName("trselected");
        if (parseInt(element[0].id) % 2 != 0) element[0].className = "impar";
        else element[0].className = "";
    }
    x.className = "trselected";
}

function myFunction2(evnt) {
    var info = "";
    var ev = (evnt) ? evnt : event;
    var code = (ev.which) ? ev.which : event.keyCode;
    if (code == 40) {
        if (document.getElementsByClassName("trselected").length > 0) {
            var element = document.getElementsByClassName("trselected");
            var num = (parseInt(element[0].id) + 1).toString();
            myFunction(document.getElementById(num));
        } else myFunction(document.getElementById(1))
    } else if (code == 38) {
        if (document.getElementsByClassName("trselected").length > 0) {
            var element = document.getElementsByClassName("trselected");
            var num = (parseInt(element[0].id) - 1).toString();
            myFunction(document.getElementById(num))
        } else myFunction(document.getElementById(document.getElementById("tbody").rows
            .length.toString()))
    } else if (code == 13) {
        if (document.getElementsByClassName("trselected").length > 0) {
            var element = document.getElementsByClassName("trselected");
            info = element[0].cells[0].innerText;
            //Mostrar en un div --7w7-- document.getElementById('resultado').innerHTML = info;
            document.getElementsByName("clase")[0].value = info;
        }

    }
}
//Escucha y reacciona el evento cuando se pulsa una tecla
if (window.document.addEventListener) {
    window.document.addEventListener("keydown", myFunction2, false);
} else {
    window.document.attachEvent("onkeydown", myFunction2);
}

//Tabla2
/*Selecciona la fila y se cambia el estilo cuando le das click con el ratón*/
function myFunction_2(x) {
    if (document.getElementsByClassName("trselected_2").length > 0) {
        var element = document.getElementsByClassName("trselected_2");
        if (parseInt(element[0].id) % 2 != 0) element[0].className = "impar";
        else element[0].className = "";
    }
    x.className = "trselected_2";
}

function myFunctionTable_2(evnt) {
    var info = "";
    var ev = (evnt) ? evnt : event;
    var code = (ev.which) ? ev.which : event.keyCode;
    if (code == 40) {
        if (document.getElementsByClassName("trselected_2").length > 0) {
            var element = document.getElementsByClassName("trselected_2");
            var num = (parseInt(element[0].id) + 1).toString();
            myFunction_2(document.getElementById(num));
        } else myFunction_2(document.getElementById(1))
    } else if (code == 38) {
        if (document.getElementsByClassName("trselected_2").length > 0) {
            var element = document.getElementsByClassName("trselected_2");
            var num = (parseInt(element[0].id) - 1).toString();
            myFunction_2(document.getElementById(num))
        } else myFunction_2(document.getElementById(document.getElementById("tbody2").rows
            .length.toString()))
    } else if (code == 13) {
        if (document.getElementsByClassName("trselected_2").length > 0) {
            var element = document.getElementsByClassName("trselected_2");
            info = element[0].cells[0].innerText;
            //Mostrar en un div --7w7-- document.getElementById('resultado').innerHTML = info;
            document.getElementsByName("clase_2")[0].value = info;
        }

    }
}
//Escucha y reacciona el evento cuando se pulsa una tecla
if (window.document.addEventListener) {
    window.document.addEventListener("keydown", myFunctionTable_2, false);
} else {
    window.document.attachEvent("onkeydown", myFunctionTable_2);
}

var count = 1;

function ocultarismo() {
    if (count == 1) {
        document.getElementById('oculto2').style.display = 'block';
        count = 2;
    } else if (count == 2) {
        document.getElementById('oculto3').style.display = 'block';
        document.getElementById('ocultoBtt').style.display = 'block';
        count = 3;
    }
}

function resetOcult() {
    document.getElementById('oculto2').style.display = 'none';
    document.getElementById('oculto3').style.display = 'none';
    document.getElementById('ocultoBtt').style.display = 'none';
}