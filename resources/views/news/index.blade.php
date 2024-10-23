<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News</title>
</head>
<body>
    <h1>This is News' Page</h1>
    @if (isset($articles)  && count($articles) > 0)
    <ul>
        @foreach ($articles as $article)
            <li class="mb-4">
                <h3 class="text-xl font-semibold">
                    <a href="{{ $article['url'] }}" target="_blank">
                        {{ $article['title'] }}
                    </a>
                </h3>

                <p>{{ $article['description'] }}</p>
            </li>
        @endforeach
    </ul>
        
    @else
        <p>There are No News Available!</p>
    @endif
</body>
</html>