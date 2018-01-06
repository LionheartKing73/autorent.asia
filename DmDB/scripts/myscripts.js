var ss=0;
onload=function () {
  var aTR=document.getElementsByTagName('table')[1].getElementsByTagName('tr');
  
  for (var i=1;i<aTR.length;i++) {
    if (aTR[i].addEventListener) { // Mozilla
       aTR[i].addEventListener('mouseover', function() { highLight(this); }, false);
       aTR[i].addEventListener('mouseout', function() { highLight(this); }, false);
    }
    else {
       aTR[i].onmouseover=function() {highLight(this);}
       aTR[i].onmouseout=function() {highLight(this);}
    }
  }
}

function highLight(obj) {
  if (obj.className != "hov"){
    ss = obj.className;
    obj.className = "hov";
  }
  else{
    obj.className=ss;
  }
}