function showAllPost() {

    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("col-8").innerHTML=this.responseText;
        
      }
    }
    xmlhttp.open("GET","../View/AllNotice.php?",true);
    xmlhttp.send();
  }
  
  showAllPost();


