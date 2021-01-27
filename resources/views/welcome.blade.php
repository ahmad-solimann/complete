@extends('users.layouts.app')
@section('content')
    <!-- Set up a container element for the button -->
    <
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container text-center">
            <div id="paypal-button-container"></div>
        </div>
        @php
            foreach($model->files as $file)
                    if(!$file->is_image("models\\ ".$file->file))
                        $zipfile = $file->file;


        @endphp
    </section>
    <!-- Include the PayPal JavaScript SDK -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=Acerq6AwNBN2aKmA-pZXgrmO8YuFVOvo_OQsEijhXAavoRjALlFHb5Cc0pyb-kOERskFCDwisyR4ABOe&currency=USD"></script>

    <script>

        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({
            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{$model->price}}'
                        }
                    }]
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                downloadFile("{{route('download', $model->id)}}",{"x-content": "abc"}, '{{$zipfile}}');
                // Show a success message to the buyer
                return actions.order.capture().then(function(details) {
                    alert('Transaction completed by ' + details.payer.name.given_name + '!');
                });
            }
        }).render('#paypal-button-container');

        function downloadFile(url, headers, filename) {

            function handleFile(data) {
                console.log(this.response || data);
                var file = URL.createObjectURL(this.response || data);
                filename = filename || url.split("/").pop();
                var a = document.createElement("a");
                // if `a` element has `download` property
                if ("download" in a) {
                    a.href = file;
                    a.download = filename;
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                } else {
                    // use `window.open()` if `download` not defined at `a` element
                    window.open(file)
                }
            }

            var request = new XMLHttpRequest();
            request.responseType = "blob";
            request.onload = handleFile;
            request.open("GET", url);
            for (var prop in headers) {
                request.setRequestHeader(prop, headers[prop]);
            }

            request.send();
        }
    </script>
@endsection