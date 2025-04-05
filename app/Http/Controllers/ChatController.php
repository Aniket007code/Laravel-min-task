<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OllamaService;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    // Show the form
    public function show()
    {
        return view('chat');
    }

    // Handle the form submission
    public function send(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'prompt' => 'required|string',
        ]);

        // Make request to Ollama API
        $response = Http::post('http://localhost:11434/api/generate', [
            'model' => 'tinyllama',
            'prompt' => $request->prompt,
            'stream' => false,
        ]);

        // Get the text response or fallback
        $output = $response->json()['response'] ?? 'Something went wrong 😔';

        return view('chat', [
            'prompt' => $request->prompt,
            'response' => $output ?? 'Something went wrong 😔',
        ]);
    }
}
