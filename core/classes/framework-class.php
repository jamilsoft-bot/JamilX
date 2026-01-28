<?php

declare(strict_types=1);


final  class JamilX
{
    public function __construct(
        public string $platformName,
        public string $codeName,
        public string $description,
        public string $version,
        public string $license,
        public string $homepage,
        public string $repository,
        public string $documentationUrl,
        public string $issuesUrl,
        public string $supportEmail,
        public string $vendor,
        public string $country,
        public string $timezone,
        public array $tags
    ) {}

    public static function fromDefaults(): self
    {
        return new self(
            platformName: 'JamilX Platform',
            codeName: 'JamilX',
            description: 'A modular web application platform/framework by Jamilsoft Technologies.',
            version: '0.1.0',
            license: 'Proprietary', // change if OSS (e.g., MIT, Apache-2.0)
            homepage: 'https://jamilsoft-bot.github.io',
            repository: 'https://github.com/jamilsoft-bot',
            documentationUrl: 'https://jamilsoft-bot.github.io',
            issuesUrl: 'https://github.com/jamilsoft-bot', // point to repo issues if available
            supportEmail: 'myakububauchi@gmail.com',
            vendor: 'Jamilsoft Technologies',
            country: 'Nigeria',
            timezone: 'Africa/Lagos',
            tags: [
                'php',
                'framework',
                'platform',
                'modular',
                'backend',
                'web',
            ]
        );
    }

    public function toArray(): array
    {
        return [
            'platformName' => $this->platformName,
            'codeName' => $this->codeName,
            'description' => $this->description,
            'version' => $this->version,
            'license' => $this->license,
            'homepage' => $this->homepage,
            'repository' => $this->repository,
            'documentationUrl' => $this->documentationUrl,
            'issuesUrl' => $this->issuesUrl,
            'supportEmail' => $this->supportEmail,
            'vendor' => $this->vendor,
            'country' => $this->country,
            'timezone' => $this->timezone,
            'tags' => $this->tags,
        ];
    }
}
