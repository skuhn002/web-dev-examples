<?php require_once  '../header.php'; ?>

<?php $pathRel2Root = pathRel2Root(fixSlashes(__FILE__)); ?>


  <div class="container w-50">
    <p class="text-center">Contest Navigation bar (use ajax reloads)</p>
    <div class="dropdown">
          <div class="dropdown">
      <button class="dropbtn">Dropdown</button>
      <div class="dropdown-content">
        <a onclick="javascript: updatev2('hot-content', 'http://localhost:8080/fourth_approach/contest/enter-contest.php');">Enter a Contest</a>
        <a onclick="javascript: updatev2('hot-content', 'http://localhost:8080/fourth_approach/contest/view.php');">View the Competition</a>
        <a onclick="javascript: updatev2('hot-content', 'http://localhost:8080/fourth_approach/contest/vote.php');">Vote for an Artist</a>
      </div>
    </div>
  <?php nSpaces(3); ?>
</div>
<p class="text-center" id="hot-content"></p>
</div>
