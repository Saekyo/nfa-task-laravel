<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authors</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Author</th>
            </tr>
        </thead>
        <tbody>
            @foreach($authors as $author)
            <tr>
                <td>{{ $author['name'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>