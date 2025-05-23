<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? "Judul Halaman" }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha256-PI8n5gCcz9cQqQXm3PEtDuPG8qx9oFsFctPg0S5zb8g=" crossorigin="anonymous">
</head>

<body>
    <h1>{{ $header1 ?? "Judul paragraf" }}</h1>
    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aspernatur, eligendi culpa. Illum neque nostrum, quasi
        in tempora nam dolores deleniti voluptatum repudiandae minus modi cupiditate perferendis ex, officiis quibusdam
        fuga?</p>

    <table border="1">
        <tr>
            <th>Nama</th>
            <th>NPM</th>
            <th>Jurusan</th>
        </tr>

        @foreach ($data as $mahasiswa)
            <tr>
                <td>{{ $mahasiswa->nama   }}</td>
                <td>{{ $mahasiswa->npm }}</td>
                <td>{{ $mahasiswa->jurusan }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>