function getType(str) 
{
    /* get request to a different page without reloading */
    /* returns input fields and the hint */
    if (str.length == 0) {
        document.getElementById("dynamic").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("dynamic").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "../php/gettype.php?key=" + str, true);
        xmlhttp.send();
    }
}
