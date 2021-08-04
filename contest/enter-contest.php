<link rel="stylesheet" href="http://localhost:8080/fourth_approach/main.css">

<div class="container">
  <p>Do you want to enter your art in a contest to possibly win $100? Fill out the form below to get started!</p>

</div>
<br>
<br>
<form class="form group" method="POST" action="entry-handler.php">
  <label for="name-section">Name</label>
  <div id="name-section">
    <input type="text" class="form-control" name="first-name" id="first-name" aria-describedby="emailHelp" placeholder="First name" value="Samuel">
    <br>
    <input type="text" class="form-control" name="last-name" id="last-name" aria-describedby="emailHelp" placeholder="Last name" value="Kuhn">
  </div>
  <br>
  <label for="email-section">Email</label>
  <div id="email-section">
    <input type="email" name="email" placeholder="johnDoe@example.com" value="johnDoe@example.com" style="padding-left: 10px; height: 4vh; width: 100%; font-size: 16px;">
  </div>
  <br>
  <label for="contest-type">Contest Type</label>
  <div id="contest-type">
    <input type="radio" name="poetry" value="poetry" checked="true">
    <label for="poetry"><p class="h4">Poetry</p></label>
  </div>
  <input style="font-size: 18px; background-color: aqua;" type="submit">
</form>
<br>
<br>
<br>
<br>
