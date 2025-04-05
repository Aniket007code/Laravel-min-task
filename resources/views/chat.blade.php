<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LLM Chat</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 700px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            resize: vertical;
            font-size: 16px;
        }

        button {
            display: block;
            width: 100%;
            margin-top: 15px;
            padding: 12px;
            font-size: 16px;
            background-color: #4A90E2;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #357bd8;
        }

        .response {
            margin-top: 30px;
            padding: 20px;
            background: #e9f5ff;
            border-left: 5px solid #4A90E2;
            border-radius: 5px;
            font-size: 16px;
            line-height: 1.5;
            color: #333;
        }

        .prompt-preview {
            font-weight: bold;
            margin-bottom: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>💬 Ask the AI</h1>

        <form method="POST" action="{{ route('chat.send') }}">
            @csrf
            <textarea name="prompt" rows="4" placeholder="Type your question...">{{ old('prompt') }}</textarea>
            <button type="submit">Send</button>
        </form>

        @if(isset($response))
            <div class="response">
                <div class="prompt-preview">You asked:</div>
                <p>{{ $prompt }}</p>
                <div class="prompt-preview">AI says:</div>
                <p>{{ $response }}</p>
            </div>
        @endif
    </div>
</body>
</html>