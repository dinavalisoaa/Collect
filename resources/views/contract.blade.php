<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contract</title>
</head>

<body>
    <button onclick="generatePDF()">Download PDF</button>
    <div id="html">
        {!! $html !!}
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script>
        function generatePDF() {
            const doc = new jsPDF();
            const html = document.querySelector('html').innerHTML;
            doc.fromHTML(html, 15, 15, {
                'width': 170
            });
            doc.save('Script.pdf');
        }
    </script>

</body>

</html>
