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
                    var select = document.getElementById("citySelection");
                    if(select.length >0){
                        for (var i=0; i<select.length;i++){
                            select.remove(select.options[i]);
                        }
                    }
                    document.getElementById("locationState").value = "";
                }else{
                    var result = JSON.parse(xmlhttp.responseText);
                    document.getElementById("location_error").innerHTML = "";
                    var select = document.getElementById("citySelection");
                    select.removeAttribute("readonly");
                    select.removeAttribute("disabled");
                    if(select.length >0){
                        for (var i=0; i<select.length;i++){
                            select.remove(select.options[i]);
                        }
                    }
                    for(var i =0; i<result.length; i++){
                        var option = document.createElement('option');
                        option.value = result[i].city_id;
                        option.innerHTML = result[i].city_name;

                        select.appendChild(option);
                    }



                    document.getElementById("locationState").value = result[0].state_name;
                }
            }
        };
        xmlhttp.open("GET","../ind/checkPostcode.php?q=" + locPostcode.value, true);
        xmlhttp.send();
    }
}

function isImage(filename) {
    var ext = getExtension(filename);
    switch (ext.toLowerCase()) {
        case 'jpg':
        case 'gif':
        case 'bmp':
        case 'png':
            //etc
            return true;
    }
    return false;
}


function checkImageAttached(){
    var file = document.getElementById("fileToUpload");
    if(!isImage(file.value)){
        alert("Please choose image to upload");
    }

}