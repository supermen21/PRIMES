function getXMLHTTP() {
      var xmlhttp=false;

      try{
        xmlhttp=new XMLHttpRequest();
      }

      catch(e)  {
        try{
          xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(e){
          try{
          xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
          }
          catch(e1){
            xmlhttp=false;
          }
        }
      }

      return xmlhttp;
}

function getProvince(regId) {

    var strURL="find_prov.php?region="+regId;
    var req = getXMLHTTP();

    if (req) {

      req.onreadystatechange = function() {
        if (req.readyState == 4) {
              if (req.status == 200) {
                document.getElementById('provdiv').innerHTML=req.responseText;
              } else {
                alert("There was a problem while using XMLHTTP:\n" + req.statusText);
              }
        }
      }
      req.open("GET", strURL, true);
      req.send(null);
    }
}

function getDistrict(regId,provId) {

  var strURL="find_dist.php?region="+regId+"&province="+provId;
  var req = getXMLHTTP();


  if (req) {

    req.onreadystatechange = function() {
      if (req.readyState == 4) {
        // only if "OK"
        if (req.status == 200) {
          document.getElementById('distdiv').innerHTML=req.responseText;
        } else {
          alert("There was a problem while using XMLHTTP:\n" + req.statusText);
        }
      }
    }
    req.open("GET", strURL, true);
    req.send(null);
  }
}

function getMuni(regId,provId) {

  var strURL="find_muni.php?region="+regId+"&province="+provId;
  var req = getXMLHTTP();


  if (req) {

    req.onreadystatechange = function() {
      if (req.readyState == 4) {
        // only if "OK"
        if (req.status == 200) {
          document.getElementById('mundiv').innerHTML=req.responseText;
        } else {
          alert("There was a problem while using XMLHTTP:\n" + req.statusText);
        }
      }
    }
    req.open("GET", strURL, true);
    req.send(null);
  }
}

function getBar(regId,provId,munId) {

  var strURL="find_bar.php?region="+regId+"&province="+provId+"&municipality="+munId;
  var req = getXMLHTTP();


  if (req) {

    req.onreadystatechange = function() {
      if (req.readyState == 4) {
        // only if "OK"
        if (req.status == 200) {
          document.getElementById('barangaydiv').innerHTML=req.responseText;
        } else {
          alert("There was a problem while using XMLHTTP:\n" + req.statusText);
        }
      }
    }
    req.open("GET", strURL, true);
    req.send(null);
  }
}










function getXMLHTTP() {
      var xmlhttp=false;

      try{
        xmlhttp=new XMLHttpRequest();
      }

      catch(e)  {
        try{
          xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(e){
          try{
          xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
          }
          catch(e1){
            xmlhttp=false;
          }
        }
      }

      return xmlhttp;
}

function getfProvince(regId) {

    var strURL="find_fprov.php?region="+regId;
    var req = getXMLHTTP();

    if (req) {

      req.onreadystatechange = function() {
        if (req.readyState == 4) {
              if (req.status == 200) {
                document.getElementById('fprovdiv').innerHTML=req.responseText;
              } else {
                alert("There was a problem while using XMLHTTP:\n" + req.statusText);
              }
        }
      }
      req.open("GET", strURL, true);
      req.send(null);
    }
}

function getfDistrict(regId,provId) {

  var strURL="find_fdist.php?region="+regId+"&province="+provId;
  var req = getXMLHTTP();


  if (req) {

    req.onreadystatechange = function() {
      if (req.readyState == 4) {
        // only if "OK"
        if (req.status == 200) {
          document.getElementById('fdistdiv').innerHTML=req.responseText;
        } else {
          alert("There was a problem while using XMLHTTP:\n" + req.statusText);
        }
      }
    }
    req.open("GET", strURL, true);
    req.send(null);
  }
}

function getfMuni(regId,provId) {

  var strURL="find_fmuni.php?region="+regId+"&province="+provId;
  var req = getXMLHTTP();


  if (req) {
    
    req.onreadystatechange = function() {
      if (req.readyState == 4) {
        // only if "OK"
        if (req.status == 200) {
          document.getElementById('fmundiv').innerHTML=req.responseText;
        } else {
          alert("There was a problem while using XMLHTTP:\n" + req.statusText);
        }
      }
    }
    req.open("GET", strURL, true);
    req.send(null);
  }
}

function getfBar(regId,provId,munId) {

  var strURL="find_fbar.php?region="+regId+"&province="+provId+"&municipality="+munId;
  var req = getXMLHTTP();


  if (req) {

    req.onreadystatechange = function() {
      if (req.readyState == 4) {
        // only if "OK"
        if (req.status == 200) {
          document.getElementById('fbarangaydiv').innerHTML=req.responseText;
        } else {
          alert("There was a problem while using XMLHTTP:\n" + req.statusText);
        }
      }
    }
    req.open("GET", strURL, true);
    req.send(null);
  }
}



