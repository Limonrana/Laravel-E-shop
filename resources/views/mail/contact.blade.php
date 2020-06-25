<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Contact Request</title>
    <style>
        .contact {
            width: 600px;
            margin: auto;
            margin-top: 30px;
        }
        #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
    </style>
</head>
<body>
<div class="contact">
    <table id="customers">
        <tr>
            <td>Name    :</td>
            <td>{{ $contact->contact_name }}</td>

        </tr>
        <tr>
            <td>Email   :</td>
            <td>{{ $contact->contact_email }}</td>

        </tr>
        <tr>
            <td>Phone   :</td>
            <td>{{ $contact->contact_phone }}</td>
        </tr>
        <tr>
            <td>Message :</td>
            <td>{{ $contact->contact_message }}</td>
        </tr>
    </table>
</div>
</body>
</html>
