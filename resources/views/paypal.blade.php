<script>
    paypal.Button.render({
        // Set your environment
        env: 'sandbox', // sandbox | production
        // Specify the style of the button
        style: {
            label: 'checkout',  // checkout | credit | pay | buynow | generic
            size:  'responsive', // small | medium | large | responsive
            shape: 'pill',   // pill | rect
            color: 'gold'   // gold | blue | silver | black
        },
        // PayPal Client IDs - replace with your own
        // Create a PayPal app: https://developer.paypal.com/developer/applications/create
        client: {
            // sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
            sandbox: 'AaQypFGfWG4GJgN315Hu-4xCsfJNGmC5UatwL4dYTULaNr70YJr-aFKOEBTLuCW-NnlrPm3P46kCA6Qb',
            // production: '<insert production client id>'
        },
        // Wait for the PayPal button to be clicked
        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: {
                                total: '{!! $plan->value !!}',
                                currency: 'BRL'
                            }
                        }
                    ]
                }
            });
        },
        // Wait for the payment to be authorized by the customer
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                $.post('{!! route('plan_store') !!}', data)
                .done(function(data){
                window.location.href = '{!! route('home', ['purchase' => true]) !!}';
                });
            });
        }

    }, '#paypal-button-container-{!! $plan->id !!}');
</script>