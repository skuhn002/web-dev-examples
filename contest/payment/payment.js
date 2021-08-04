// https://stackoverflow.com/questions/34319709/how-to-send-an-http-request-with-a-header-parameter // very helpful example

// var xhttp = new XMLHttpRequest();
// xhttp.open("GET", "https://apiprod.fattlabs.com/", true);
//
// var myHeaders = new Headers();
// xhttp.setRequestHeader('Authorization',
//   'BEARER eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJnb2RVc2VyIjpmYWxzZSwibWVyY2hhbnQiOiJmNjZkNzljYi1mYzNlLTQ1NmUtODhiOS1kNGE2ZTEyZmQ0ZDAiLCJzdWIiOiJlOTA4YTcxMC01MGMxLTQyMGEtYjI2MC0zMmRhZDY4ZWQ2OTYiLCJicmFuZCI6ImZhdHRtZXJjaGFudC1zYW5kYm94IiwiaXNzIjoiaHR0cDovL2FwaXByb2QuZmF0dGxhYnMuY29tL3NhbmRib3giLCJpYXQiOjE2MTU3NzY4ODUsImV4cCI6NDc2OTM3Njg4NSwibmJmIjoxNjE1Nzc2ODg1LCJqdGkiOiJBY1Y5VGlJRklrTDBnWm1mIiwiYXNzdW1pbmciOmZhbHNlfQ.B7RX5BpKNQrNd190dIhbDDPIIC1UChz-5Q-FTN2kIWE');
//
// xhttp.setRequestHeader('token', 'Red-Millenial-0a0f5ac58c85');
//
//
// xhttp.send();


var payButton = document.querySelector('#paybutton');
var tokenizeButton = document.querySelector('#tokenizebutton');

// Init FattMerchant API
var fattJs = new FattJs('Red-Millenial-b73e4fcdcf21', {
  number: {
    id: 'fattjs-number',
    placeholder: '0000 0000 0000 0000',
    style: 'width: 90%; height:90%; border-radius: 3px; border: 1px solid #ccc; padding: .5em .5em; font-size: 91%;'
  },
  cvv: {
    id: 'fattjs-cvv',
    placeholder: '000',
    style: 'width: 30px; height:90%; border-radius: 3px; border: 1px solid #ccc; padding: .5em .5em; font-size: 91%;'
  }
});

fattJs.showCardForm().then(handler => {
  console.log('check after');
  console.log(handler);
});

// tell fattJs to load in the card fields
fattJs.showCardForm().then(handler => {
  console.log('form loaded');

  // for testing!
  handler.setTestPan('4111111111111111');
  handler.setTestCvv('123');
  var form = document.querySelector('form');
  form.querySelector('input[name=month]').value = 11;
  form.querySelector('input[name=year]').value = 2025;
  form.querySelector('input[name=cardholder-first-name]').value = 'Jon';
  form.querySelector('input[name=cardholder-last-name]').value = 'Doe';
  form.querySelector('input[name=phone]').value = '+1111111111111111';
})
.catch(err => {
  console.log('error init form ' + err);
  // reinit form
});


console.log("paybutton below");
console.log(payButton);

fattJs.on('card_form_complete', (message) => {
  // activate pay button
  payButton.disabled = false;
  tokenizeButton.disabled = false;
  console.log(message);
});

fattJs.on('card_form_incomplete', (message) => {
  // deactivate pay button
  payButton.disabled = true;
  tokenizeButton.disabled = true;
  console.log(message);
});

document.querySelector('#payButton').onclick = () => {
  var successElement = document.querySelector('.success');
  var errorElement = document.querySelector('.error');
  var loaderElement = document.querySelector('.loader');

  successElement.classList.remove('visible');
  errorElement.classList.remove('visible');
  loaderElement.classList.add('visible');

  var form = document.querySelector('form');
  var extraDetails = {
    total: 1, // 1$
    firstname: form.querySelector('input[name=cardholder-first-name]').value,
    lastname: form.querySelector('input[name=cardholder-last-name]').value,
    company: '',
    email: '',
    month: form.querySelector('input[name=month]').value,
    year: form.querySelector('input[name=year]').value,
    phone: form.querySelector('input[name=phone]').value,
    address_1: '100 S Orange Ave',
    address_2: '',
    address_city: 'Orlando',
    address_state: 'FL',
    address_zip: '32811',
    address_country: 'USA',
    url: "https://omni.fattmerchant.com/#/bill/",
    method: 'card',
    // validate is optional and can be true or false.
    // determines whether or not fattmerchant.js does client-side validation.
    // the validation follows the sames rules as the api.
    // check the api documentation for more info:
    // https://fattmerchant.com/api-documentation/
    validate: false,
    // meta is optional and each field within the POJO is optional also
    meta: {
      reference: 'invoice-reference-num',// optional - will show up in emailed receipts
      memo: 'notes about this transaction',// optional - will show up in emailed receipts
      otherField1: 'other-value-1', // optional - we don't care
      otherField2: 'other-value-2', // optional - we don't care
      subtotal: 1, // optional - will show up in emailed receipts
      tax: 0, // optional - will show up in emailed receipts
      lineItems: [ // optional - will show up in emailed receipts
        {"id": "optional-fm-catalog-item-id", "item":"Demo Item","details":"this is a regular, demo item","quantity":10,"price":.1}
      ]
    }
  };

  console.log(extraDetails);

  // call pay api
  fattJs.pay(extraDetails).then((result) => {
    console.log('pay:');
    console.log(result);
    if (result.id) {
      successElement.querySelector('.token').textContent = result.payment_method_id;
      successElement.classList.add('visible');
      loaderElement.classList.remove('visible');
    }
  })
  .catch(err => {
    errorElement.textContent = err.child_transactions[0].message;
    errorElement.classList.add('visible');
    loaderElement.classList.remove('visible');
  });
}

document.querySelector('#tokenizebutton').onclick = () => {
  var successElement = document.querySelector('.success');
  var errorElement = document.querySelector('.error');
  var loaderElement = document.querySelector('.loader');

  successElement.classList.remove('visible');
  errorElement.classList.remove('visible');
  loaderElement.classList.add('visible');

  var form = document.querySelector('form');
  var extraDetails = {
    total: 1, // 1$
    firstname: form.querySelector('input[name=cardholder-first-name]').value,
    lastname: form.querySelector('input[name=cardholder-last-name]').value,
    month: form.querySelector('input[name=month]').value,
    year: form.querySelector('input[name=year]').value,
    phone: form.querySelector('input[name=phone]').value,
    address_1: '100 S Orange Ave',
    address_2: '',
    address_city: 'Orlando',
    address_state: 'FL',
    address_zip: '32811',
    address_country: 'USA',
    url: "https://omni.fattmerchant.com/#/bill/",
    method: 'card',
    // validate is optional and can be true or false.
    // determines whether or not fattmerchant.js does client-side validation.
    // the validation follows the sames rules as the api.
    // check the api documentation for more info:
    // https://fattmerchant.com/api-documentation/
    validate: false,
  };

  // call tokenize api
  fattJs.tokenize(extraDetails).then((result) => {
    console.log('tokenize:');
    console.log(result);
    if (result) {
        successElement.querySelector('.token').textContent = result.id;
        successElement.classList.add('visible');
    }
    loaderElement.classList.remove('visible');
  })
  .catch(err => {
    errorElement.textContent = err.message;
    errorElement.classList.add('visible');
    loaderElement.classList.remove('visible');
  });
}
