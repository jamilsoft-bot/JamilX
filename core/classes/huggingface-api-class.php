<?php

class HugginfaceApi
{
    private string $baseUrl = 'https://router.huggingface.co/v1/chat/completions';
    private string $apiKey;
    private string $model;
    private string $systemPrompt;

    public function __construct(?string $apiKey = null, ?string $model = null, string $systemPrompt = 'You are a helpful assistant.')
    {
        $env = self::loadEnv();
        $this->apiKey = $apiKey ?? self::envKey($env, 'huggingface') ?? '';
        $this->model = $model ?? 'deepseek-ai/DeepSeek-R1';
        $this->systemPrompt = $systemPrompt;
    }

    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function setSystemPrompt(string $systemPrompt): void
    {
        $this->systemPrompt = $systemPrompt;
    }

    public function sendChat(string $prompt, ?string $model = null, ?string $systemPrompt = null): string
    {
        $payload = [
            'model' => $model ?? $this->model,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $systemPrompt ?? $this->systemPrompt,
                ],
                [
                    'role' => 'user',
                    'content' => $prompt,
                ],
            ],
            'stream' => false,
        ];

        return $this->request($payload);
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

    private function request(array $payload): string
    {
        if ($this->apiKey === '') {
            throw new RuntimeException('Hugging Face API key is missing.');
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->baseUrl,
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
                'Authorization: Bearer ' . $this->apiKey,
            ],
        ]);

        $response = curl_exec($curl);
        if ($response === false) {
            $error = curl_error($curl);
            curl_close($curl);
            throw new RuntimeException('Hugging Face request failed: ' . $error);
        }

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($status >= 400) {
            throw new RuntimeException('Hugging Face request failed with status ' . $status . ': ' . $response);
        }

        return $response;
    }
}
