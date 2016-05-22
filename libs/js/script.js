/**
 * Created by Wilson on 5/19/2016.
 */
function searchPostcode(){
    var locPostcode = document.getElementById("locationPostcode");
    if(locPostcode.value.trim() != ""){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status==200){
                if(xmlhttp.responseText == "false"){
                    document.getElementById("location_error").innerHTML = "No such POSTCODE exist.";
                    document.getElementById("locationCity").value = "";
                    document.getElementById("locationState").value = "";
                }else{
                    var result = JSON.parse(xmlhttp.responseText);
                    document.getElementById("location_error").innerHTML = "";
                    document.getElementById("locationCity").value = result.city_name;
                    document.getElementById("locationState").value = result.state_name;
                }
            }
        };
        xmlhttp.open("GET","../psm/ind_adv/checkPostcode.php?q=" + locPostcode.value, true);
        xmlhttp.send();
    }
}