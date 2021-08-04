
<?php require_once '../header.php'; ?>

<head>
  <link rel="stylesheet" href="/payment/payment.js">
</head>

<div>
<h1>Poetry Submission Form</h1>


<!-- What do I already have from the user at this point?

- First Name
- Last Name
- Email
- Confirmation Code

What elements do I need to get from the user in a poetry submission form?

- Their Poem
- Their explanation of their poem's meaning
- Their confirmation that their work is their own original work
- Their Payment Information

What information do I need to provided the user with?

- The prompt for the poem
- The cost of the entrance to the Contest
- When the contest will end
- When the winner will be announced
- How much the winner will win
- The winner's poem will be featured on the website


**********   Next time   *************
  - try to get the http request to work to populate the payment form
    - now try to fix the formatting

  - instead of fixing the formatting, I just decided it would be best to handle payment on it's own page
    - right now this is a button leading to the next page, but it needs to be form completion that leads to the payment page
    - next time work on detecting poetry submission form completion



-->

<form class="" action="payment/payment.php" method="post">
    <?php nSpaces(3); ?>
    <label for="poem">Enter your poem below</label>
    <?php nSpaces(1); ?>
    <textarea rows="5" cols="60" name="poem" placeholder="Enter text"></textarea>
    <?php nSpaces(3); ?>
    <label for="explanation">Below, take a few words to explain what your poem means and why you wrote it.</label>
    <?php nSpaces(1); ?>
    <textarea rows="5" cols="60" name="explanation" placeholder="Enter text"></textarea>
    <?php nSpaces(2); ?>
    <label for="integrity">Check this box to confirm that this poem is your own original work: &nbsp</label>
    <input type="checkbox" name="integrity" onchange="getPayForm()">
    <!-- <a href="payment/payment.php"><button type="button" name="button">Go to pay</button></a> -->
    <?php nSpaces(2); ?>
    <input type="submit" name="Submit" value="Go to Pay">
</form>

<form class="" action="index.html" method="post">
    <div class="">
        <h1>Payment Information</h1>
        <div class="container">
          <div id="pay-info">

          </div>
        </div>
    </div>
</form>
</div>

<script type="text/javascript">
  function getPayForm() {
    updatev2('pay-info', 'payment/payment.php');
    alert("Hee");
  }


</script>
