<html>
<head>
    <title>Paginate</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="max-w-5xl mx-auto py-8">
        <h1 class="text-5xl">Paginate</h1>

        <ul class="py-4">
            @foreach ($users as $user)
                <li class="py-1 border-b">{{ $user->user->name }}</li>
            @endforeach
        </ul>

        {{ $users->links() }}
    </div>
</body>
</html>
