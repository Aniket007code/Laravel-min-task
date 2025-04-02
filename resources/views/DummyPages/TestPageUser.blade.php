<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user page </title>
</head>

<body>
    <div class="container">
        <h1>welcome to user page we are going to show you logged in user data</h1>
    </div>



    <table border="12">
    <thead>
        <tr> <!-- ✅ Added <tr> to wrap <th> elements -->
            <th>SR NO</th>
            <th>ID</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>ROLE</th>
            <th>CREATED_AT</th>
            <th>UPDATED_AT</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($userDetails as $index => $user)
        <tr>
            <td>{{ $index + 1 }}</td> <!-- ✅ SR NO (Adding +1 to start from 1) -->
            <td>{{ $user->id }}</td> <!-- ✅ Displaying ID -->
            <td>{{ $user->name }}</td> <!-- ✅ Displaying Name -->
            <td>{{ $user->email }}</td> <!-- ✅ Displaying Email -->
            <td>{{ $user->role }}</td> <!-- ✅ Displaying Role -->
            <td>{{ $user->created_at }}</td> <!-- ✅ Displaying Created Date -->
            <td>{{ $user->updated_at }}</td> <!-- ✅ Displaying Updated Date -->
        </tr>
        @endforeach
    </tbody>
</table>

</body>

</html>