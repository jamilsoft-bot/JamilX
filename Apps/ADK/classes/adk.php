<?php
class ADKShowcase
{
    public static function overview()
    {
        return [
            'title' => 'App Development Kit',
            'subtitle' => 'Design, scaffold, and ship SaaS-ready experiences with the JamilX PHP Framework.',
            'description' => 'ADK bundles opinionated layouts, starter modules, and production-minded checklists so teams can build and deploy confidently on shared hosting.',
        ];
    }

    public static function highlights()
    {
        return [
            [
                'title' => 'JamilX-first structure',
                'text' => 'Services, actions, and containers are laid out to match JamilX routing and rendering expectations.',
            ],
            [
                'title' => 'Rapid scaffolding',
                'text' => 'Starter templates for dashboards, billing flows, and admin experiences cut setup time.',
            ],
            [
                'title' => 'Production ready',
                'text' => 'Built-in compliance checklist and release playbook keep deployments smooth.',
            ],
        ];
    }

    public static function toolkit()
    {
        return [
            [
                'name' => 'Service blueprints',
                'detail' => 'Pre-wired service classes with routing patterns and shared helper hooks.',
            ],
            [
                'name' => 'Container layouts',
                'detail' => 'Responsive templates for marketing, onboarding, and app dashboards.',
            ],
            [
                'name' => 'Action flows',
                'detail' => 'Sample actions for CRUD workflows, profile updates, and activity feeds.',
            ],
            [
                'name' => 'Release checklist',
                'detail' => 'Go-live steps covering environment checks, backups, and rollback.',
            ],
        ];
    }

    public static function modules()
    {
        return [
            [
                'label' => 'Onboarding',
                'text' => 'Guided setup screens, team invites, and role assignment.',
            ],
            [
                'label' => 'Billing & plans',
                'text' => 'Plan cards, invoice preview, and upgrade/downgrade flow.',
            ],
            [
                'label' => 'Analytics',
                'text' => 'Executive dashboards, KPI cards, and trend snapshots.',
            ],
            [
                'label' => 'Support hub',
                'text' => 'Knowledge base, ticket intake, and status updates.',
            ],
        ];
    }

    public static function workflow()
    {
        return [
            'Run the JamilX CLI to scaffold your service, actions, and containers.',
            'Customize the ADK templates with your domain data and visuals.',
            'Connect services, publish assets, and ship with the release checklist.',
        ];
    }

    public static function faqs()
    {
        return [
            [
                'question' => 'Does ADK work on shared hosting?',
                'answer' => 'Yes. It keeps JamilX deployments lightweight and compatible with cPanel environments.',
            ],
            [
                'question' => 'Can I add my own modules?',
                'answer' => 'Absolutely. Extend the service and container templates to match your product domain.',
            ],
            [
                'question' => 'Is Tailwind required?',
                'answer' => 'No. The templates are styled with Tailwind for speed, but you can swap any CSS stack.',
            ],
        ];
    }
}
