

    $('.delete').click(function(e){
        
        if(!confirm('Are you sure?')){
            e.preventDefault();
            return false;
        }else{
            return true;
        };
    })

    $('#search_cat').keyup(function(){
      var txt = $(this).val();
      
        $.ajax({
          method:"POST",
          url:'http://localhost/projects/market/categories/search',
          data:{search:txt},
          dataType:"text",
          success:function(data){
            $(".searched").html(data);
          }
        })
      
    });


    $('#search_pro').keyup(function(){
      var txt = $(this).val();
      
        $.ajax({
          method:"POST",
          url:'http://localhost/projects/market/products/search',
          data:{search:txt},
          dataType:"text",
          success:function(data){
            $(".searched").html(data);
          }
        })
    });

    $('#search_man').keyup(function(){
      var txt = $(this).val();
      
        $.ajax({
          method:"POST",
          url:'http://localhost/projects/market/manufactures/search',
          data:{search:txt},
          dataType:"text",
          success:function(data){
            $(".searched").html(data);
          }
        })
    });
    

    $('.buying').click(function(e){
        
      if(!confirm('Are you sure to buy?')){
          e.preventDefault();
          return false;
      }else{
          return true;
      };
  })

// $(document).ready(function(){
//     $('.messages').hide(7000);


      
// })
    
$('.buy').click(function(){
  $('.checkout').css({
    'display':'block'
  })
})


function paymentCheck() {
  let cash = document.getElementById('cash');
    if (cash.checked) {
      document.querySelector('.fa-money').style.cssText="color:red !important";
      document.querySelector('.fa-cc-stripe').style.cssText="";
      document.querySelector('.form-row').style.display = 'none';
      if(document.body.contains(document.getElementById('scrip'))){
        var elem =document.getElementById('scrip');
      elem.parentNode.removeChild(elem);
      }
    } else {
      document.querySelector('.fa-cc-stripe').style.cssText="color:red !important ";
      document.querySelector('.fa-money').style.cssText="";
      var head = document.querySelector('body');
    
      var script = document.createElement('script');
      script.id = 'scrip';
      script.type = 'text/javascript';
      script.src = "https://js.stripe.com/v3/";
      head.appendChild(script);
      document.querySelector('.form-row').style.display = 'block';
      

      // Create a Stripe client.
var stripe = Stripe('pk_test_wpsaZLzicJCvZLC0yZMd6QHf00yOyDoak5');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}


    }
    }
