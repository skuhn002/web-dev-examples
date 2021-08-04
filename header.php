<?php
  $devType = "Localhost"; #"Localhost"

  if ($devType == "Livehost"){
    $ROOTPATH = "/my_site/second_approach-Mobile_First/first-try/";
  }

  if ($devType == "Localhost"){
    $ROOTPATH = "C:/MAMP/htdocs/practice-try/fourth_approach/";
  }
?>

<?php echo "<a href='http://localhost:8080/index.php'> <h3>Return to home page</h3> </a>"; ?>

<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

<!--Bootstrap--->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<link rel="stylesheet" href="http://localhost:8080/fourth_approach/main.css">

<script src="https://fattjs.fattpay.com/js/fattmerchant.js"></script>



<!-- javascript functions -->

<script type="text/javascript">
  //Gets the browser specific XmlHttpRequest Object
  function getXmlHttpRequestObject() {
    /* Gets an HTTP Request object that works with the users browser.
    ------------------------------------------------------------------
    Returns:
      obj : the http object
    */
    if (1) {
      return new XMLHttpRequest(); //Not Internet Explorers (IE)
    }
    else if (window.ActiveXObject) {
      return new ActiveXObject("Microsoft.XMLHTTP"); //Internet Explorer Object
    }
    else {
      alert("Your browser doesn't support the XmlHttpRequest object.  Better upgrade to Firefox or try using Google Chrome.");
    }
  }


  function updateByHTTP(id="error", file="no file"){
    /* Updates text on a webpage using an http request.
    ----------------------------------------------------
    Parameters:
      id
          - str : the element id to update
          - Set to 'error' by default
      file
          - str : file to use for http update
          - Set to 'no file' by default
    */

    http = getXmlHttpRequestObject();

    if (file != "no file") {
      if (http.readyState == 4 || http.readyState == 0) {
        http.open("GET", file, true);
        http.onreadystatechange = function(){handleHttp(id)};
        http.send(null)
      }
    }
    if (file == "no file") {
      if (id != "error"){
        if (http.readyState == 4 || http.readyState == 0) {
          http.open("GET", 'import.html', true);
          http.onreadystatechange = function(){handleHttp(id)};
          http.send(null)
        }
      }
      else {
        alert("ERROR: no element id to fulfil http request");
      }
    }
  }

  function handleHttp(id) {
    /* Handles the http object on completion of the http request.
    --------------------------------------------------------------
    Parameters:
      id  - str : the element id to update
    */

      if (http.readyState == 4) {
        http.responses = http.responseText.split(',');
        document.getElementById(id).innerHTML = "<h1>" + http.responses[0] + "</h1>";
        nResponses = http.responses.length;
      }
  }

   function update(id, file = "no file"){
    /* Coordinates multiple types of content Updates
    ------------------------------------------------
    Parameters:
      id
          - str : the element id to update
      file
          - str : file to use for http update
          - Set to 'no file' by default
    Notes:
      This function should only be used in the case of the http_request.php example. In any other case it is much more generalizable to use updatev2().
    */

      if (file != "no file") {
        if (!window.hasOwnProperty('nUpdates')) {
          nUpdates = 0;
          updateByHTTP(id, file);
        }
        else {
          alert("test 2");
          nUpdates = (nUpdates + 1) % nResponses;
          document.getElementById(id).innerHTML = "<h1>" + http.responses[nUpdates] + "</h1>";
        }
      }
      if (file == "no file") {
        if (!window.hasOwnProperty('nUpdates')) {
          nUpdates = 0;
          updateByHTTP(id);
        }
        else {
          nUpdates = (nUpdates + 1) % nResponses;
          document.getElementById(id).innerHTML = "<h1>" + http.responses[nUpdates] + "</h1>";
        }
      }
    }







    function updatev2(id, file = "no file") {
    /* The second (better) version of update.
    ----------------------------------------
    Same as update except for:
      - doesn't try to cycle through nUpdates
    */

    if (file != "no file") {
      updateByHTTP(id, file);
    }

    if (file == "no file") {
      updateByHTTP(id);
    }


    }






</script>

<?php

  require_once 'functions.php';

 ?>
