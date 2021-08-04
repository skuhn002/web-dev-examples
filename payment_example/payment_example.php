<head>
  <link rel="stylesheet" href="payment_example.css">
</head>

<body>
  <form onsubmit="return false;" style="width: 600px;">
<!--      Make your own form or copy this one -->
    <div class="group">
      <label>
        <span>First Name</span>
        <input
 name="cardholder-first-name" class="field input-box" placeholder="Jane" />
      </label>
      <label>
        <span>Last Name</span>
        <input name="cardholder-last-name" class="field input-box" placeholder="Doe" />
      </label>
      <label>
        <span>Phone</span>
        <input name="phone" class="field input-box"  placeholder="+1000000000000" />
      </label>
    </div>
    <div class="group">
          <label for="card-element" style="height: 120px !important;">
            <span style="margin-top: 40px;">Card</span>
            <div id="card-element" class="field">
              <div>
                <span display="inline">Card number</span> <span display="inline" style="margin-left: 100px;">CWW</span>
              </div>
              <div id="fattjs-number" style="width:180px; height:35px; display: inline-block; margin:3px"></div>
              <div id="fattjs-cvv" style="width:50px; height:35px; display: inline-block; margin:3px"></div>
            </div>

            <div>
              <span style="color: black;">MM/YYYY</span>
              <div style="margin-top: 30px;">
                <div style="width:40px; height:35px; display: inline-block;">
                  <input name="month" size="3" maxlength="2" placeholder="MM" style="width: 30px; height:18px; border-radius: 3px; border: 1px solid #ccc; padding: .5em .5em; font-size: 91%; margin-top: 10px">
                </div>
                /
                <div style="width:55px; height:35px; display: inline-block;padding: 0 8px 0 0">
                  <input name="year" size="5" maxlength="4" placeholder="YYYY" style="width: 50px; height:18px; border-radius: 3px; border: 1px solid #ccc; padding: .5em .5em; font-size: 91%; margin-top: 10px; margin-left: 3px;">
                </div>
              </div>
            </div>
          </label>
        </div>
    <button id="payButton">Pay $1</button>
    <button id="tokenizeButton">Tokenize Card</button>
    <!-- <button id="verifybutton">verify $1</button> -->
    <div class="outcome">
      <div class="error"></div>
      <div class="success">
        Successful! The ID is
        <span class="token"></span>
      </div>
      <div class="loader" style="margin: auto">
      </div>
  </form>
</body>


  <script src="https://fattjs.fattpay.com/js/fattmerchant.js"></script>
  <script src="payment_example.js"></script>
  <link rel="shortcut icon" type="image/png" href="/favicon.png">
