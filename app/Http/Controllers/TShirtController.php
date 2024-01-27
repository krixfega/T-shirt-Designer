<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class TShirtController extends Controller
{
    /**
     * Show the t-shirt customization page.
     *
     * @return \Illuminate\View\View
     */
    public function showCustomizationPage()
    {
        return view('customization'); // Replace 'customization' with your actual Blade view
    }

    /**
     * Handle t-shirt customization logic.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function customizeTShirt(Request $request)
    {
        // Validate the request
        $request->validate([
            'design' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get user input for t-shirt design
        $design = $request->input('design');

        // Handle image upload
        $imagePath = $request->file('image')->store('tshirt_images', 'public');

        // Example: Generate code using OpenAI API (replace with your actual OpenAI API logic)
        $generatedCode = $this->generateCodeUsingOpenAI($design);

        // Save the design and image path to the database (replace with your actual database model)
        TShirtDesign::create([
            'design' => $design,
            'image_path' => $imagePath,
            'generated_code' => $generatedCode,
        ]);

        // Redirect or return a response as needed
        return redirect('/customization')->with('success', 'T-shirt customized successfully!');
    }

    /**
     * Generate code using OpenAI API (example method).
     *
     * @param  string  $design
     * @return string
     */
    private function generateCodeUsingOpenAI($design)
    {
        // Your OpenAI API integration logic goes here
        // Use $design to create a prompt and make a request to the OpenAI API
        // Return the generated code

        // Example: Mock API call to OpenAI (replace with your actual OpenAI API logic)
        $response = Http::post('https://api.openai.com/v1/engines/davinci-codex/completions', [
            'prompt' => $design,
            'max_tokens' => 100,
        ])->header('Authorization', 'Bearer YOUR_OPENAI_API_KEY');

        return $response->json()['choices'][0]['text'] ?? 'Unable to generate code';
    }
}
