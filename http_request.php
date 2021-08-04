<!DOCTYPE html>
<html lang="en" dir="ltr">
  <header>
    <meta charset="utf-8">
    <?php require_once 'header.php'; ?>
    <title></title>

    <script type="text/javascript">
      var http = getXmlHttpRequestObject();
    </script>
  </header>
  <body>
    <h1>Here's a button</h1>
    <div class="btn">
      <button onclick="update('changeMe');" type="button" name="button">Click to Http Request</button>
    </div>
    <br>
        <div class="col-14 align-self-center" style="height: 50vh; margin-top: 25vh;" id="changeMe"> <h1>Please allow me to demonstrate the power of the Http Request</h1></div>
    <br>
  </body>
</html>
