<script>
function getType(str) 
{
    /* this is the dream solution */
    /* get request to a different page without reloading */
    /* returns input fields and the hint */
    /* i actually teared up when it worked allegedly */
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
        xmlhttp.open("GET", "gettype.php?key=" + str, true);
        xmlhttp.send();
    }
}
</script>