<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genres</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Genre</th>
            </tr>
        </thead>
        <tbody>
            @foreach($genres as $genre)
            <tr>
                <td>{{ $genre["name"] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>