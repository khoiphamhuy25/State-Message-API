<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/style.css">
    <title>Document</title>
</head>
<body>
<h1>State Message Parser</h1>

<form id="ndc-form">
    <label for="ndc-message">Paste NDC Message here</label>
    <textarea id="ndc-message" name="ndc_message"></textarea>
    <button type="submit" id="submit-button">Parse</button>
</form>

<div id="responseContainer"></div>

<script src="js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</body>
</html>
