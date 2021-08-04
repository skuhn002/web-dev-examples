<?php require_once 'header.php'; ?>

<link rel="stylesheet" href="omni-payment-style.css">

<?php
  nSpaces(10);
 ?>

 <html>

 <head>
 </head>

 <body>
   <form onsubmit="return false;">
 <!--      Make your own form or copy this one -->
     <div class="group">
       <label>
         <span>First Name</span>
         <input name="cardholder-first-name" class="field input-box" placeholder="Jane" value="Jon"/>
       </label>
       <label>
         <span>Last Name</span>
         <input name="cardholder-last-name" class="field input-box" placeholder="Doe" value="Doe"/>
       </label>
       <label>
         <span>Phone</span>
         <input name="phone" class="field input-box"  placeholder="+1000000000000" value="+1111111111111111"/>
       </label>
     </div>
     <div class="group">
       <label>
         <span>Card</span>
         <div id="card-element" class="field">
           <div id="fattjs-number" style="width:180px; height:35px; display: inline-block; margin:3px"></div>
           <div id="fattjs-cvv" style="width:50px; height:35px; display: inline-block; margin:3px"></div>
         </div>
         <div style="width:40px; height:35px; display: inline-block;">
           <input name="month" size="3" maxlength="2" placeholder="MM" style="width: 40px; height:18px; border-radius: 3px; border: 1px solid #ccc; padding: .5em .5em; font-size: 80%; margin-top: 10px;" value=11>
         </div>
         <?php nSpaces(1, 'tab'); ?>/<?php nSpaces(1, 'tab'); ?>
         <div style="width:55px; height:35px; display: inline-block; padding: 0 8px 0 0;">
           <input name="year" size="5" maxlength="4" placeholder="YYYY" style="width: 50px; height:18px; border-radius: 3px; border: 1px solid #ccc; padding: .5em .5em; font-size: 91%; margin-top: 10px;" value=202>
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

 </html>






<script type="text/javascript">

    var fattjs = new FattJs( "Red-Millenial-024f8d11fddd" , {
      number: {
        id: 'card-number',     // the html id of the div you want to contain the credit card number field
        placeholder: '0000 0000 0000 0000',    // the placeholder the field should contain
        style: 'height: 30px; width: 100%; font-size: 15px;',    // the style to apply to the field
        type: 'text',    // the input type (optional)
        format: 'prettyFormat'    // the formatting of the CC number (prettyFormat || plainFormat || maskedFormat)
      },
      cvv: {
        id: 'card-cvv',    // the html id of the div you want to contain the cvv field
        placeholder: '000',    // the placeholder the field should contain
        style: 'height: 30px; width: 100%; font-size: 15px;',    // the style to apply to the field
        type: 'text'    // the input type (optional)
      }
    });

    console.log('check after')

    fattjs.showCardForm().then(handler => {
      console.log(handler);
    });

  //   fattjs.showCardForm().then(handler => {
  //     console.log('form loaded');
  //
  //     // for testing!
  //     handler.setTestPan('4111111111111111');
  //     handler.setTestCvv('123');
  //     var form = document.querySelector('form');
  //     form.querySelector('input[name=month]').value = 11;
  //     form.querySelector('input[name=year]').value = 2025;
  //     form.querySelector('input[name=cardholder-first-name]').value = 'Jon';
  //     form.querySelector('input[name=cardholder-last-name]').value = 'Doe';
  //     form.querySelector('input[name=phone]').value = '+1111111111111111';
  //   })
  //   .catch(err => {
  //     console.log(err);
  //     //console.log('error init form ' + err);
  //     // reinit form
  //   });
  //
  //   fattjs.on('card_form_complete', (message) => {
  //     // activate pay button
  //     payButton.disabled = false;
  //     tokenizeButton.disabled = false;
  //     console.log(message);
  //   });
  //
  //   fattjs.on('card_form_incomplete', (message) => {
  //     // deactivate pay button
  //     payButton.disabled = true;
  //     tokenizeButton.disabled = true;
  //     console.log(message);
  //   });
  //
  //
  // const extraDetails = {
  //     total: 10,
  //     firstname: "John",
  //     lastname: "Doe",
  //     month: "10",
  //     year: "2020",
  //     phone: "5555555555",
  //     address_1: "100 S Orange Ave",
  //     address_2: "Suite 400",
  //     address_city: "Orlando",
  //     address_state: "FL",
  //     address_zip: "32811",
  //     address_country: "USA",
  //     send_receipt: false,
  //     validate: false,
  //     meta: {
  //       reference: 'invoice-reference-num',// optional - will show up in emailed receipts
  //       memo: 'notes about this transaction',// optional - will show up in emailed receipts
  //       otherField1: 'other-value-1', // optional - we don't care
  //       otherField2: 'other-value-2', // optional - we don't care
  //       subtotal: 1, // optional - will show up in emailed receipts
  //       tax: 0, // optional - will show up in emailed receipts
  //       lineItems: [ // optional - will show up in emailed receipts
  //         {
  //             "id": "optional-fm-catalog-item-id",
  //             "item":"Demo Item",
  //             "details":"this is a regular demo item",
  //             "quantity":10,
  //             "price": .1
  //         }
  //       ],
  //       invoice_merchant_custom_fields: [
  //         {
  //             "id": "dc4b-6c74-00dd-fab1-fe00", // Required, must be a unique string.
  //             "name": "External ID", // The name of the custom field that will be displayed to your customers and users; this will appear above the field as a label.
  //             "placeholder": "Ex. #123", // The placeholder for the field; this is the faint text that will appear in the entry box of your custom field to help guide your users before they enter in the value when creating an Invoice.
  //             "required": true, // Determines if this field is required to be filled by the user (not customer) when first creating an Invoice.
  //             "type": "text", // Input type. Only 'text' is supported.
  //             "value": "123456789", // The value that will appear when viewing the Invoice or Invoice Email. For the merchant, this will also appear when viewing the Invoice via the Invoices or Edit Invoice pages.
  //             "visible": true // This determines if the field is visible when viewing the Invoice or Invoice Email. If false, will only appear in merchant-facing pages such as the Invoices or Edit Invoice pages.
  //         }
  //       ]
  //     }
  //   };
  //
  //   document.querySelector("#payButton").onclick = () => {
  //     fattjs.pay(extraDetails).then(response => {
  //         console.log("invoice object:", response);
  //         console.log("transaction object:", response.child_transactions[0]);
  //       })
  //       .catch((err) => {
  //         console.log("unsuccessful payment:", err);
  //       });
  //     };
  //
  //     document.querySelector('#payButton').onclick = () => {
  //       var successElement = document.querySelector('.success');
  //       var errorElement = document.querySelector('.error');
  //       var loaderElement = document.querySelector('.loader');
  //
  //       successElement.classList.remove('visible');
  //       errorElement.classList.remove('visible');
  //       loaderElement.classList.add('visible');
  //
  //       var form = document.querySelector('form');
  //       var extraDetails = {
  //         total: 1, // 1$
  //         firstname: form.querySelector('input[name=cardholder-first-name]').value,
  //         lastname: form.querySelector('input[name=cardholder-last-name]').value,
  //         company: '',
  //         email: '',
  //         month: form.querySelector('input[name=month]').value,
  //         year: form.querySelector('input[name=year]').value,
  //         phone: form.querySelector('input[name=phone]').value,
  //         address_1: '100 S Orange Ave',
  //         address_2: '',
  //         address_city: 'Orlando',
  //         address_state: 'FL',
  //         address_zip: '32811',
  //         address_country: 'USA',
  //         url: "https://omni.fattmerchant.com/#/bill/",
  //         method: 'card',
  //         // validate is optional and can be true or false.
  //         // determines whether or not fattmerchant.js does client-side validation.
  //         // the validation follows the sames rules as the api.
  //         // check the api documentation for more info:
  //         // https://fattmerchant.com/api-documentation/
  //         validate: false,
  //         // meta is optional and each field within the POJO is optional also
  //         meta: {
  //           reference: 'invoice-reference-num',// optional - will show up in emailed receipts
  //           memo: 'notes about this transaction',// optional - will show up in emailed receipts
  //           otherField1: 'other-value-1', // optional - we don't care
  //           otherField2: 'other-value-2', // optional - we don't care
  //           subtotal: 1, // optional - will show up in emailed receipts
  //           tax: 0, // optional - will show up in emailed receipts
  //           lineItems: [ // optional - will show up in emailed receipts
  //             {"id": "optional-fm-catalog-item-id", "item":"Demo Item","details":"this is a regular, demo item","quantity":10,"price":.1}
  //           ]
  //          }
  //         };
  //
  //         console.log(extraDetails);
  //
  //         // call tokenize api
  //         fattjs.tokenize(extraDetails).then(result => {
  //           console.log('tokenize:');
  //           console.log(result);
  //           if (result.id) {
  //               successElement.querySelector('.token').textContent = result.id;
  //               successElement.classList.add('visible');
  //           }
  //           loaderElement.classList.remove('visible');
  //         })
  //         .catch(err => {
  //           errorElement.textContent = err.message;
  //           errorElement.classList.add('visible');
  //           loaderElement.classList.remove('visible');
  //         });
  //       };
  //
  //     document.querySelector('#tokenizeButton').onclick = () => {
  //       var successElement = document.querySelector('.success');
  //       var errorElement = document.querySelector('.error');
  //       var loaderElement = document.querySelector('.loader');
  //
  //       successElement.classList.remove('visible');
  //       errorElement.classList.remove('visible');
  //       loaderElement.classList.add('visible');
  //
  //       var form = document.querySelector('form');
  //       var extraDetails = {
  //         total: 1, // 1$
  //         firstname: form.querySelector('input[name=cardholder-first-name]').value,
  //         lastname: form.querySelector('input[name=cardholder-last-name]').value,
  //         month: form.querySelector('input[name=month]').value,
  //         year: form.querySelector('input[name=year]').value,
  //         phone: form.querySelector('input[name=phone]').value,
  //         address_1: '100 S Orange Ave',
  //         address_2: '',
  //         address_city: 'Orlando',
  //         address_state: 'FL',
  //         address_zip: '32811',
  //         address_country: 'USA',
  //         url: "https://omni.fattmerchant.com/#/bill/",
  //         method: 'card',
  //         // validate is optional and can be true or false.
  //         // determines whether or not fattmerchant.js does client-side validation.
  //         // the validation follows the sames rules as the api.
  //         // check the api documentation for more info:
  //         // https://fattmerchant.com/api-documentation/
  //         validate: false,
  //       };
  //
  //     }
</script>
