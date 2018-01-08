function ajaxRequest(){
    var activexmodes=["Msxml2.XMLHTTP", "Microsoft.XMLHTTP"] //activeX versions to check for in IE
    if (window.ActiveXObject){ //Test for support for ActiveXObject in IE first (as XMLHttpRequest in IE7 is broken)
     for (var i=0; i<activexmodes.length; i++){
      try{
       return new ActiveXObject(activexmodes[i])
      }
      catch(e){
       //suppress error
      }
     }
    }
    else if (window.XMLHttpRequest) // if Mozilla, Safari etc
     return new XMLHttpRequest()
    else
     return false
   }
   
function addTask(str) {
    var xhttp;    
    if (str == null) {
        alert("no content"+ str);
      return;
    }
    else {
        var mypostrequest=new ajaxRequest()
        mypostrequest.onreadystatechange=function(){
            if (mypostrequest.readyState==4){
                if (mypostrequest.status==200 || window.location.href.indexOf("http")==-1){
                    document.getElementById("result").innerHTML=mypostrequest.responseText
                }
                else{
                    alert("An error has occured making the request")
                }
            }
        }
        var libTache=encodeURIComponent(document.getElementById("libTache").value)
        var parameters="value="+libTache+"&val="+str
        mypostrequest.open("POST", "index.php", true)
        mypostrequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
        mypostrequest.send(parameters)
    }


}
function dellTask(){
    alert("dell");
    var xhr_object = new XMLHttpRequest(); 
    xhr_object.open("POST", "index2.php", true);
}