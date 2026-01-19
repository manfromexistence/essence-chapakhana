<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SiteSettingsController extends Controller
{
    /**
     * Display the site settings page.
     */
    public function index()
    {
        $settings = [
            'site_name' => SiteSetting::get('site_name', 'Chapakhana'),
            'favicon' => SiteSetting::get('favicon', '/favicon.ico'),
        ];

        return Inertia::render('Admin/Settings', [
            'settings' => $settings,
        ]);
    }

    /**
     * Update the site settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'favicon' => 'nullable|image|mimes:ico,png,jpg,jpeg,gif,svg,webp|max:2048',
        ]);

        // Update site name
        SiteSetting::set('site_name', $validated['site_name']);

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            $faviconFile = $request->file('favicon');

            // Create uploads directory if it doesn't exist
            $uploadsPath = public_path('uploads/site');
            if (! file_exists($uploadsPath)) {
                mkdir($uploadsPath, 0755, true);
            }

            // Delete old favicon if it exists and is not the default
            $oldFavicon = SiteSetting::get('favicon');
            if ($oldFavicon && $oldFavicon !== '/favicon.ico' && file_exists(public_path($oldFavicon))) {
                unlink(public_path($oldFavicon));
            }

            // Generate unique filename
            $filename = 'favicon_'.time().'.'.$faviconFile->getClientOriginalExtension();
            $faviconFile->move($uploadsPath, $filename);

            // Save new favicon path
            SiteSetting::set('favicon', '/uploads/site/'.$filename);
        }

        // Clear cache to reflect changes immediately
        SiteSetting::clearCache();

        // Return fresh settings
        $settings = [
            'site_name' => SiteSetting::get('site_name', 'Chapakhana'),
            'favicon' => SiteSetting::get('favicon', '/favicon.ico'),
        ];

        return back()->with([
            'success' => 'Site settings updated successfully!',
            'settings' => $settings,
        ]);
    }
}
