<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title ?? "Mahasiswa Ujang Rambo"}}</title>
</head>

<body>
    <form action="{{ "url()->to()" ?? "" }}">
        <input type="text" value="" name="post" id="post">
        <label for="post">Post</label>
        <button type="submit">Submit</button>
    </form>
</body>

</html>