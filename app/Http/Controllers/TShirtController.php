<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\TShirtDesign;

class TShirtController extends Controller
{
    /**
     * Show the t-shirt customization page.
     *
     * @return \Illuminate\View\View
     */
    public function showCustomizationPage()
    {
        return view('customization');
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

        // Generate code using OpenAI API 
        $generatedCode = $this->generateCodeUsingOpenAI($design);

        // Save the design and image path to the database 
        TShirtDesign::create([
            'design' => $design,
            'image_path' => $imagePath,
            'generated_code' => $generatedCode,
        ]);

        // Fetch previous customizations
        $previousCustomizations = TShirtDesign::latest()->take(5)->get();

        // Redirect or return a response as needed
        return view('customization', [
            'previousCustomizations' => $previousCustomizations,
            'imagePath' => $imagePath,
            'generatedCode' => $generatedCode,
            'success' => 'T-shirt customized successfully!',
        ]);
    }

    /**
     * Show details of a specific customization.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function showCustomizationDetails($id)
    {
        $customization = TShirtDesign::findOrFail($id);

        return view('customization.details', compact('customization'));
    }

    /**
     * Generate code using OpenAI API.
     *
     * @param  string  $design
     * @return string
     */
    private function generateCodeUsingOpenAI($design)
    {
    try {
        $apiKey = env('OPENAI_API_KEY');

        // Make sure the API key is not empty
        if (empty($apiKey)) {
            \Log::error('OpenAI API Error: API key is empty');
            return 'API Error: Unable to generate code';
        }

        // Mock API call to OpenAI
        $response = Http::post('https://api.openai.com/v1/engines/davinci-codex/completions', [
            'prompt' => $design,
            'max_tokens' => 100,
        ])->header('Authorization', 'Bearer ' . $apiKey);

        // Check if the response is a string (indicating an issue with the request)
        if (is_string($response)) {
            \Log::error('OpenAI API Error: ' . $response);
            return 'API Error: Unable to generate code';
        }

        // Check if the request was successful
        if ($response->successful()) {
            return $response->json()['choices'][0]['text'] ?? 'Unable to generate code';
        } else {
            // Log the API error or handle it appropriately
            \Log::error('OpenAI API Error: ' . $response->body());
            return 'API Error: Unable to generate code';
        }
    } catch (\Exception $e) {
            // Log any unexpected exceptions
            \Log::error('OpenAI API Exception: ' . $e->getMessage());
            return 'Exception: Unable to generate code';
        }
    }


}
