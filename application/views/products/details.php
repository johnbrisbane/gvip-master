<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Stripe JavaScript library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://js.stripe.com/v3/"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

<style>
    /* Colored Labels */
    .label-brown {
        font-weight: bold;
        color: #D1993B;
    }

    .label-blue {
        font-weight: bold;
        color: #1F548E;
    }

    .label-yellow {
        font-weight: bold;
        color: #8C541B;
    }

    .label-iron {
        font-weight: bold;
        color: #3F4552;
    }

    .label-green {
        font-weight: bold;
        color: #3E8C27;
    }

    .label-darkblue {
        font-weight: bold;
        color: #001F8D;
    }

    .label-steel {
        font-weight: bold;
        color: #39575E;
    }

    .label-purple {
        font-weight: bold;
        color: #882F8E;
    }

    .label-lightblue {
        font-weight: bold;
        color: #3C97F7;
    }

    .label-darkred {
        font-weight: bold;
        color: #6A190C;
    }

    .label-orange {
        font-weight: bold;
        color: #F19837;
    }

    .label-lightred {
        font-weight: bold;
        color: #EB3F25;
    }

    .pricing-container {
        min-height: 86vh;
        height: fit-content;
        padding: 10px 15px;
    }

    .pricing-header h1 {
        font-size: 48px;
        font-weight: 200;
        color: #166894;
        border-bottom: 1px solid #4a4a4a;
        display: inline-block;
        padding: 0 15px;
        margin-bottom: 5px;
    }

    .pricing-header h2 {
        padding: 0 15px;
        margin: 0;
        font-size: 36px;
        font-weight: lighter;
        line-height: 1.4;
    }

    .pricing-header h2 label {
        color: #166894;
    }

    .pricing-content {
        margin: 20px 0;
        display: flex;
        flex-direction: row;
        min-height: 60%;
        height: fit-content;
    }

    .column {
        flex: 1;

    }

    .column:first-of-type {
        border-right: 1px solid black;
    }

    .service-row label {
        margin: 0 5px;
    }

    .service-row {
        margin: 20px 15px;
        padding: 0 15px;
        font-size: 24px;
        line-height: initial;
    }

    .purchase-row {
        display: flex;
        flex-direction: row;
        justify-content: center;
    }

    .purchase-btn {
        margin: 10px 25px;
        font-size: 30px;
        padding: 10px 15px;
        background: white;
        border: 2px solid #1F548E;
        color: #1F548E;

    }

    .purchase-btn:hover {
        background: #1F548E;
        cursor: pointer;
        color: white;
        transition: 300ms;
    }

    @media screen and (max-width:1100px) {
        .pricing-header h1 {
            font-size: 36px;
        }

        .pricing-header h2 {
            margin-top: 20px;
            font-size: 24px;
        }

        .service-row {
            font-size: 18px;
            margin: 20px 0px
        }

        .purchase-btn {
            font-size: 24px;
            padding: 5px 10px;
        }
    }

    @media screen and (max-width:700px) {
        .pricing-content {
            flex-direction: column;
        }

        .pricing-header h1 {
            font-size: 32px;
        }

        .pricing-header h2 {
            font-size: 20px;
        }
    }

    #hider
    {
        position:absolute;
        top: 0%;
        left: 0%;
        width:100%;
        height:150%;
        /*
        z- index must be lower than pop up box
       */
        z-index: 99;
        background-color:black;
        opacity:0.6;
    }

    #popup_box
    {

        position:absolute;
        top: 50%;
        left: 50%;
        padding: 1em;
        margin-top: -10em; /*set to a negative number 1/2 of your height*/
        margin-left: -12em; /*set to a negative number 1/2 of your width*/
        border: 1px solid #ccc;
        border:  2px solid black;
        z-index:100;

    }
</style>


<div class="pricing-container">
    <div class='purchase-row'>
        <button class='purchase-btn' id="showpopup" >Purchase Now</button>
    </div>
</div>

<div id="hider"></div>
<div id="popup_box" style="background-color: white">
    <a id="buttonClose">Close</a>
    <div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Purchase <?php echo '$'.$product['price']; ?> Membership</h3>

        <!-- Product Info -->
        <p><b>Item Name:</b> <?php echo $product['title']; ?></p>
        <p><b>Price:</b> <?php echo '$'.$product['price'].' '.$product['currency']; ?></p>
    </div>
    <div class="panel-body">
        <!-- Display errors returned by createToken -->
        <div class="card-errors"></div>

        <!-- Payment form -->
        <form action="" method="POST" id="paymentFrm">
            <div class="form-group">
                <label>NAME</label>
                <input type="text" name="name" id="name" class="field" placeholder="Enter name" required="" autofocus="">
            </div>
            <div class="form-group">
                <label>EMAIL</label>
                <input type="email" name="email" id="email" class="field" placeholder="Enter email" required="">
            </div>
            <div class="form-group">
                <label>CARD NUMBER</label>
                <div id="card_number" class="field"></div>
            </div>
            <div class="form-group">
                <label>EXPIRY DATE</label>
                <div id="card_expiry" class="field"></div>
            </div>
            <div class="form-group">
                <label>CVC CODE</label>
                <div id="card_cvc" class="field"></div>
            </div>
            <button type="submit" class="btn btn-success" id="payBtn">Submit Payment</button>
        </form>
    </div>
</div>
</div>


<script>
    // Create an instance of the Stripe object
    // Set your publishable API key
    var stripe = Stripe('<?php echo $this->config->item('stripe_publishable_key'); ?>');

    // Create an instance of elements
    var elements = stripe.elements();

    var style = {
        base: {
            fontWeight: 400,
            fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
            fontSize: '16px',
            lineHeight: '1.4',
            color: '#555',
            backgroundColor: '#fff',
            '::placeholder': {
                color: '#888',
            },
        },
        invalid: {
            color: '#eb1c26',
        }
    };

    var cardElement = elements.create('cardNumber', {
        style: style
    });
    cardElement.mount('#card_number');

    var exp = elements.create('cardExpiry', {
        'style': style
    });
    exp.mount('#card_expiry');

    var cvc = elements.create('cardCvc', {
        'style': style
    });
    cvc.mount('#card_cvc');

    // Validate input of the card elements
    var resultContainer = document.getElementById('paymentResponse');
    cardElement.addEventListener('change', function(event) {
        if (event.error) {
            resultContainer.innerHTML = '<p>'+event.error.message+'</p>';
        } else {
            resultContainer.innerHTML = '';
        }
    });

    // Get payment form element
    var form = document.getElementById('paymentFrm');

    // Create a token when the form is submitted.
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        createToken();
    });

    // Create single-use token to charge the user
    function createToken() {
        stripe.createToken(cardElement).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error
                resultContainer.innerHTML = '<p>'+result.error.message+'</p>';
            } else {
                // Send the token to your server
                stripeTokenHandler(result.token);
            }
        });
    }

    // Callback to handle the response from stripe
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }

    $(document).ready(function () {
        //hide hider and popup_box
        $("#hider").hide();
        $("#popup_box").hide();

        //on click show the hider div and the message
        $("#showpopup").click(function () {
            $("#hider").fadeIn("slow");
            $('#popup_box').fadeIn("slow");
            window.scrollTo(0, 100);
        });
        //on click hide the message and the
        $("#buttonClose").click(function () {

            $("#hider").fadeOut("slow");
            $('#popup_box').fadeOut("slow");
        });

    });
</script>
