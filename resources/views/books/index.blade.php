<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Description</th>
                <th>Published Year</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book['title'] }}</td>
                <td>{{ $book['author']['name'] }}</td>
                <td>{{ $book['genre']['name'] }}</td>
                <td>{{ $book['description'] }}</td>
                <td>{{ $book['publication_year'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>