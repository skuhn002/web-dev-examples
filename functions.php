<?php
  function nSpaces($n, $type="br") {
   /* Inserts n break spaces.
   --------------------
   Parameters:
    n
      - int : the number of break spaces to insert
    type
      - str : the type of space to insert
      - Set to 'br' by default
      - Can be set to:
          - 'tab': gives a tab like space i.e. 3 non-breaking spaces
          - 'br': gives a vertical break
   */

    if ($type == "vertical break" || $type == "br") {
     for ($i = 0; $i < $n; $i++) {
          echo "<br>";
        }
      }

    if ($type == "tab") {
      for ($i = 0; $i < $n; $i++) {
           echo "&nbsp&nbsp&nbsp";
         }
    }

   }





   function pathRel2Root($curFile) {
     /* This function gets a path relative to the server root
     --------------------------------------------------------
      Parameters:
        curFile
          - str : the file location requesting a root relative path
      Returns:
        path
          - str : the curFile's path relative to the root
     */

     $abs_root = $_SERVER['DOCUMENT_ROOT'];

     nSpaces(1);

     $path = substr($curFile, strlen($abs_root));
     //echo "path relative to root is: ".$path."\n";
     nSpaces(2);

     return $path;
   }








   function fixSlashes($str2fix) {
     /* This is a function to switch the direction of all of the slashes in a string
     -------------------------------------------------------------------------------
      Parameters:
        str2fix
          - str : the string whose slashes need to be fixed
      Returns:
        fixdStr
          - str : the string with fixed slashes
     */

     $length = strlen($str2fix);

     for($i=0; $i < $length; $i++){
       if($str2fix[$i] == "/" or $str2fix[$i] == "\\"){
         if($str2fix[$i] == "/"){
           $str2fix[$i] = "\\";
         }
         else {
           $str2fix[$i] = "/";
         }
       }
     }

     $fixdStr = $str2fix;

     return $fixdStr;
   }





   function sendEmail($mail="none", $sendTo="none"){
     /* A general function for sending an email.
     -------------------------------------------
     Parameters:
     mail
       - obj : The mail object
      sendTo
        - str : The email address to send this email to
     Return:
      status
        - str : A string explaining the status of the email
     */



   }
   ?>
