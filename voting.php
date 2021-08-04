<!---



--->



<?php require_once 'header.php'; ?>

Hello, this is for voting

<br>
<br>

<button onclick="javascript:updateByHTTP('artist-1', 'update_vote_count.php?n=1');" type="button" name="button">Click here to increase the vote count for artist 1</button>

<br>
<br>

<div id="artist-1">
  Vote Count Update Here
</div>

<br>
<br>

<button onclick="javascript:updateByHTTP('artist-2', 'update_vote_count.php?n=2');" type="button" name="button">Click here to increase the vote count for artist 2</button>

<br>
<br>

<div id="artist-2">
  Vote Count Update Here
</div>

<br>
<br>
