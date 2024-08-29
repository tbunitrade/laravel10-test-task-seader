<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class ImageController extends Controller
{
    public function upload(Request $request)
    {

        // В любой части вашего приложения
        Log::info('Environment variables', $_ENV);



        //Log::info('Upload request received');
        Log::info('Upload request received with token:', ['token' => $request->input('_token')]);


        // Валидация загружаемого файла
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            Log::info('File validation passed');

            $image = $request->file('image');
            $imagePath = $image->getRealPath();
            $imageName = time() . '.jpg';
            $destinationPath = public_path('/images');

            // Получаем ключ API из файла .env
            //$apiKey = env('TINIFY_API_KEY');
            $apiKey = config('services.tinify.api_key');

            Log::info('API Key value: ', ['api_key' => $apiKey]);

            if (!$apiKey) {
                Log::error('API key is missing');
                return response()->json(['error' => 'API key is missing'], 500);
            }

            $client = new Client();

            // Отправляем изображение на TinyPNG API с изменением размера
            $response = $client->request('POST', 'https://api.tinify.com/shrink', [
                'auth' => ['api', $apiKey],
                'body' => fopen($imagePath, 'r')
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            $outputUrl = $result['output']['url'];

            // Добавляем изменение размера
            $resizeResponse = $client->request('POST', $outputUrl, [
                'auth' => ['api', $apiKey],
                'json' => [
                    "resize" => [
                        "method" => "cover",
                        "width" => 70,
                        "height" => 70
                    ]
                ]
            ]);

            $optimizedImage = $resizeResponse->getBody();
            file_put_contents($destinationPath . '/' . $imageName, $optimizedImage);

            Log::info('Image uploaded, resized, and optimized successfully.');
            return response()->json(['success' => 'Image uploaded, resized, and optimized successfully.']);
        } catch (\Exception $e) {
            Log::error('Error uploading image: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while uploading the image. Please try again later.'], 500);
        }
    }
}
