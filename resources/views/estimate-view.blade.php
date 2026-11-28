<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <title>Estimate {{ $estimate['number'] ?? '' }}</title>
</head>
<body>
  <noscript>Please enable JavaScript to view this estimate.</noscript>
  {{-- The document is built by the same code as the Leads page preview, so both always match --}}
  <script src="{{ asset('js/estimate-doc.js') }}?v={{ filemtime(public_path('js/estimate-doc.js')) }}"></script>
  <script>
    (function () {
      var customer = @json($customer);
      var estimate = @json($estimate);
      var company = @json($company);
      document.open();
      document.write(window.EstimateDoc.html(customer, estimate, company, { downloadBar: true }));
      document.close();
    })();
  </script>
</body>
</html>
