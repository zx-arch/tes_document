<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blank Form</title>
</head>
<body>
    <form action=""{{url('generate-pdf.pdf')}}" method="post">
        <label for="field1">Nama: </label>
        <input type="text" name="nama" id="nama">
        <input type="submit" value="Submit">
    </form>
</body>
</html>