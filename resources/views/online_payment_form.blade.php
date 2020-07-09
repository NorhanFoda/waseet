<html>
  <body>
    @php
      $responseData = payRequest($cost);
      $response = json_decode($responseData, TRUE);
      $id = $response['id'];
    @endphp

      <script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId=<?php echo $id;?>"></script>
      <form method="GET" action="{{route('payUrlApi', $order_id)}}" class="paymentWidgets" data-brands="VISA MASTER MADA"></form>
      <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.js"></script>
  </body>
</html>