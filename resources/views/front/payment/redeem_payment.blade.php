Processing to payment, do not close or press back, if it takes longer you can click pay button
<form hidden method="post" action="https://hblpgw.2c2p.com/HBLPGW/Payment/Payment/Payment" name="authForm">
<input type="hidden" id="paymentGatewayID" name="paymentGatewayID" value="{{ $payment['paymentGatewayID'] }}"><br>
<input type="hidden" id="invoiceNo" name="invoiceNo" value="{{ $payment['invoiceNo'] }}"><br>
<input type="hidden" id="productDesc" name="productDesc" value="{{ $payment['productDesc'] }}"><br>
<input type="hidden" id="amount" name="amount" value="{{ $payment['price'] }}"><br>
<input type="hidden" id="currencyCode" name="currencyCode" value="{{ $payment['currencyCode'] }}"><br>
{{-- <input type="hidden" id="userDefined1" name="userDefined1" value="{{ $payment['userDefined1'] }}"> --}}
<input type="hidden" id="nonSecure" name="nonSecure" value="{{ $payment['nonSecure'] }}">
<input type="hidden" id="hashValue" name="hashValue" value="{{ $payment['hashValue'] }}">
<input type="submit" value="pay">
</form>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script>
    document.authForm.submit();
</script>
{{-- <form method="post" action="https://hblpgw.2c2p.com/HBLPGW/Payment/Payment/Payment" name="authForm">
<input type="hidden" id="paymentGatewayID" name="paymentGatewayID" value="9103333910"><br>
<input type="hidden" id="invoiceNo" name="invoiceNo" value="INT-2202111127"><br>
<input type="hidden" id="productDesc" name="productDesc" value="Caryn Rocha"><br>
<input type="hidden" id="amount" name="amount" value="000000009600"><br>
<input type="hidden" id="currencyCode" name="currencyCode" value="840"><br>
<input type="hidden" id="nonSecure" name="nonSecure" value="N">
<input type="hidden" id="hashValue" name="hashValue" value="3752AEE68CE591B7DF09788BA54D8B2A7123E71656606C524117A09C2204486C">
<input type="submit" value="pay">
</form> --}}
