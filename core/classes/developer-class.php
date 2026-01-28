<?php
declare(strict_types=1);

/**
 * File: Developer-class.php
 *
 * Developer metadata container (PHP 8.2+ readonly class).
 */
final  class Developer
{
    public function __construct(
        // Identity
        public string $fullName,
        public string $displayName,
        public string $roleTitle,
        public string $organization,

        // Location / Locale
        public string $location,
        public string $country,
        public string $stateOrRegion,
        public string $city,
        public string $timezone,

        // Contacts
        public string $email,
        public string $supportEmail,
        public string $website,
        public string $portfolioUrl,

        // Social / Profiles
        public string $githubUrl,
        public string $linkedinUrl,
        public string $twitterUrl,

        // Developer/Company Meta
        public string $vendorSlug,
        public string $brandName,
        public string $tagline,

        // Technical Meta
        public string $primaryStack,
        public array $skills,
        public array $tags,

        // Optional References
        public string $repositoryHubUrl,
        public string $docsHubUrl
    ) {}

    /**
     * Defaults based on your provided details.
     * Edit the Unknown/TBD fields as needed.
     */
    public static function fromDefaults(): self
    {
        return new self(
            // Identity
            fullName: 'Muhammad Jamil',
            displayName: 'Jamilsoft-bot',
            roleTitle: 'Software Developer',
            organization: 'Jamilsoft Technologies',

            // Location / Locale
            location: 'Bauchi, Nigeria',
            country: 'Nigeria',
            stateOrRegion: 'Bauchi State',
            city: 'Bauchi',
            timezone: 'Africa/Lagos',

            // Contacts
            email: 'myakububauchi@gmail.com',
            supportEmail: 'myakububauchi@gmail.com',
            website: 'https://jamilsoft-bot.github.io',
            portfolioUrl: 'https://jamilsoft-bot.github.io',

            // Social / Profiles
            githubUrl: 'https://github.com/jamilsoft-bot',
            linkedinUrl: 'Unknown', // set if available
            twitterUrl: 'Unknown',  // set if available

            // Developer/Company Meta
            vendorSlug: 'jamilsoft-bot',
            brandName: 'Jamilsoft',
            tagline: 'Building practical software for African teams.',

            // Technical Meta
            primaryStack: 'PHP, JavaScript, Web Platforms',
            skills: [
                'Full-stack web development',
                'Product development',
                'SEO management',
                'Research & market analysis',
                'Consulting & training',
            ],
            tags: [
                'developer',
                'nigeria',
                'bauchi',
                'php',
                'web',
                'software',
                'jamilsoft',
            ],

            // Optional References
            repositoryHubUrl: 'https://github.com/jamilsoft-bot',
            docsHubUrl: 'https://jamilsoft-bot.github.io'
        );
    }

    public function toArray(): array
    {
        return [
            'fullName' => $this->fullName,
            'displayName' => $this->displayName,
            'roleTitle' => $this->roleTitle,
            'organization' => $this->organization,

            'location' => $this->location,
            'country' => $this->country,
            'stateOrRegion' => $this->stateOrRegion,
            'city' => $this->city,
            'timezone' => $this->timezone,

            'email' => $this->email,
            'supportEmail' => $this->supportEmail,
            'website' => $this->website,
            'portfolioUrl' => $this->portfolioUrl,

            'githubUrl' => $this->githubUrl,
            'linkedinUrl' => $this->linkedinUrl,
            'twitterUrl' => $this->twitterUrl,

            'vendorSlug' => $this->vendorSlug,
            'brandName' => $this->brandName,
            'tagline' => $this->tagline,

            'primaryStack' => $this->primaryStack,
            'skills' => $this->skills,
            'tags' => $this->tags,

            'repositoryHubUrl' => $this->repositoryHubUrl,
            'docsHubUrl' => $this->docsHubUrl,
        ];
    }

    /**
     * Convenience: stable identity key for logs/config.
     */
    public function id(): string
    {
        // e.g. "jamilsoft-bot:muhammad-jamil"
        $name = strtolower(trim(preg_replace('/\s+/', '-', $this->fullName)));
        return "{$this->vendorSlug}:{$name}";
    }
}
