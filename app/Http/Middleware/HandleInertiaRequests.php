<?php

namespace App\Http\Middleware;

use App\Models\PageSection;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        // Get site logo from header section
        $headerSection = PageSection::where('page', 'header')
            ->where('section_key', 'main')
            ->where('is_active', true)
            ->first();

        $siteLogo = $headerSection?->content['logo'] ?? '/logo.png';

        // Get site name and favicon from SiteSetting (if table exists), with fallbacks
        try {
            $siteName = SiteSetting::get('site_name') ?? $headerSection?->content['site_name'] ?? config('site.name', 'Chapakhana');
            $favicon = SiteSetting::get('favicon', '/favicon.ico');
        } catch (\Exception $e) {
            // Fallback if table doesn't exist yet
            $siteName = $headerSection?->content['site_name'] ?? config('site.name', 'Chapakhana');
            $favicon = '/favicon.ico';
        }

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'flash' => [
                'success' => $request->session()->get('success'),
                'error' => $request->session()->get('error'),
            ],
            'site' => [
                'logo' => $siteLogo,
                'name' => $siteName,
                'favicon' => $favicon,
            ],
        ];
    }
}
