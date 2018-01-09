function addTask() {
    var xhttp;    

        var mypostrequest=new XMLHttpRequest();

        var libTache=document.getElementById("libTache").value;
        var parameters="value="+libTache;
        mypostrequest.open("POST", "addTask.php", false);
        mypostrequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        mypostrequest.send(parameters);
        window.location.reload();

}

function dellTask(dell){
    var xhttp;
    var mypostrequest=new XMLHttpRequest();
    var dellid=dell.id;
    var parameters="value="+dellid;
    mypostrequest.open("POST", "dellTask.php", false);
    mypostrequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    mypostrequest.send(parameters);
    window.location.reload();
}