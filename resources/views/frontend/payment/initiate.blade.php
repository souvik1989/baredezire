<html>
<head>
<title> Custom Form Kit </title>
</head>
<body>
<center>

<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction">
@csrf
    <input type="hidden" name="encRequest" value="{{ $encryptedData }}">
    <input type="hidden" name="access_code" value="{{ $accessCode }}">
    <!-- Your payment form fields go here -->
</form>
</center>
<script>
    document.redirect.submit();
</script>
</body>
</html>
