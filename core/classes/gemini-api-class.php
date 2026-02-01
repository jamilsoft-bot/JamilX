<?php

class GeminiApi
{
    private string $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models';
    private string $apiKey;
    private string $model;

    public function __construct(?string $apiKey = null, ?string $model = null)
    {
        $env = self::loadEnv();
        $this->apiKey = $apiKey ?? self::envKey($env, 'gemini') ?? '';
        $this->model = $model ?? 'gemini-3-flash-preview';
    }

    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function generateContent(string $prompt, ?string $model = null): string
    {
        $payload = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $prompt,
                        ],
                    ],
                ],
            ],
        ];

        return $this->request($payload, $model ?? $this->model);
    }

    private static function loadEnv(): array
    {
        if (!is_readable('.env')) {
            return [];
        }

        return parse_ini_file('.env');
    }

    private static function envKey(array $env, string $key): ?string
    {
        if (isset($env['AIKEYS']) && is_array($env['AIKEYS']) && isset($env['AIKEYS'][$key]) && $env['AIKEYS'][$key] !== '') {
            return $env['AIKEYS'][$key];
        }

        return null;
    }

    private function request(array $payload, string $model): string
    {
        if ($this->apiKey === '') {
            throw new RuntimeException('Gemini API key is missing.');
        }

        $url = $this->baseUrl . '/' . $model . ':generateContent';

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($payload, JSON_UNESCAPED_UNICODE),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'x-goog-api-key: ' . $this->apiKey,
            ],
        ]);

        $response = curl_exec($curl);
        if ($response === false) {
            $error = curl_error($curl);
            curl_close($curl);
            throw new RuntimeException('Gemini request failed: ' . $error);
        }

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($status >= 400) {
            throw new RuntimeException('Gemini request failed with status ' . $status . ': ' . $response);
        }

        return $response;
    }
}
