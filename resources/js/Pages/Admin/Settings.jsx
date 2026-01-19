import { useState, useEffect } from 'react';
import AdminLayout from '@/Layouts/AdminLayout';
import { useForm, usePage } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { AdminTextInput } from '@/components/AdminTextInput';
import { AdminImageInput } from '@/components/AdminImageInput';
import { Save, Globe, Image as ImageIcon } from 'lucide-react';

export default function Settings({ settings }) {
    const { flash } = usePage().props;

    const { data, setData, post, processing, errors } = useForm({
        site_name: settings?.site_name || 'Chapakhana',
        favicon: null,
    });

    const [faviconPreview, setFaviconPreview] = useState(settings?.favicon || '/favicon.ico');

    // Update form when settings change (after successful save)
    useEffect(() => {
        if (settings) {
            setData({
                site_name: settings.site_name || 'Chapakhana',
                favicon: null,
            });
            setFaviconPreview(settings.favicon || '/favicon.ico');
        }
    }, [settings?.site_name, settings?.favicon]);

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/admin/settings', {
            forceFormData: true,
            preserveScroll: true,
            onSuccess: () => {
                // Don't reload, just show success message
                // The form will keep the updated values
            },
        });
    };

    const handleFaviconChange = (value) => {
        if (value instanceof File) {
            setData('favicon', value);
            setFaviconPreview(URL.createObjectURL(value));
        } else if (typeof value === 'string') {
            setFaviconPreview(value);
            setData('favicon', null);
        } else {
            setFaviconPreview(settings?.favicon || '/favicon.ico');
            setData('favicon', null);
        }
    };

    return (
        <div className="@container/main flex flex-1 flex-col gap-2">
            <div className="flex flex-col gap-4 py-4 md:gap-6 md:py-6">
                {/* Header */}
                <div className="flex items-center justify-between px-4 lg:px-6">
                    <div>
                        <h1 className="text-2xl font-bold tracking-tight">Site Settings</h1>
                        <p className="text-muted-foreground text-sm">
                            Manage your website name and favicon.
                        </p>
                    </div>
                    <Button onClick={handleSubmit} disabled={processing}>
                        <Save className="h-4 w-4 mr-2" />
                        {processing ? 'Saving...' : 'Save Changes'}
                    </Button>
                </div>

                {/* Success Message */}
                {flash?.success && (
                    <div className="px-4 lg:px-6">
                        <div className="rounded-md bg-green-50 p-4 dark:bg-green-900/20">
                            <p className="text-sm font-medium text-green-800 dark:text-green-400">
                                {flash.success}
                            </p>
                        </div>
                    </div>
                )}

                {/* Content */}
                <form onSubmit={handleSubmit} className="px-4 lg:px-6 space-y-6">
                    {/* Site Name */}
                    <Card>
                        <CardHeader>
                            <div className="flex items-center gap-3">
                                <div className="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10">
                                    <Globe className="h-5 w-5 text-primary" />
                                </div>
                                <div>
                                    <CardTitle>Website Name</CardTitle>
                                    <CardDescription>
                                        The name of your website displayed in browser tabs and throughout the site.
                                    </CardDescription>
                                </div>
                            </div>
                        </CardHeader>
                        <CardContent>
                            <div className="max-w-md">
                                <AdminTextInput
                                    label="Site Name"
                                    id="site_name"
                                    value={data.site_name}
                                    onChange={(e) => setData('site_name', e.target.value)}
                                    placeholder="Enter your website name"
                                    required
                                    minLength={2}
                                    maxLength={255}
                                    error={errors.site_name}
                                    helperText="This name will be shown in browser tabs and as the main site title."
                                />
                            </div>
                        </CardContent>
                    </Card>

                    {/* Favicon */}
                    <Card>
                        <CardHeader>
                            <div className="flex items-center gap-3">
                                <div className="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10">
                                    <ImageIcon className="h-5 w-5 text-primary" />
                                </div>
                                <div>
                                    <CardTitle>Favicon</CardTitle>
                                    <CardDescription>
                                        The small icon displayed in browser tabs and bookmarks.
                                    </CardDescription>
                                </div>
                            </div>
                        </CardHeader>
                        <CardContent>
                            <div className="max-w-md">
                                <AdminImageInput
                                    label="Favicon Image"
                                    id="favicon"
                                    value={faviconPreview}
                                    onChange={handleFaviconChange}
                                    defaultImage={settings?.favicon || '/favicon.ico'}
                                    aspectRatio="1/1"
                                    maxSizeMB={2}
                                    acceptedFormats={['ico', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'webp']}
                                    helperText="Recommended: 32x32px or 64x64px, ICO, PNG or SVG format."
                                    error={errors.favicon}
                                />
                            </div>

                            {/* Current Favicon Preview */}
                            <div className="mt-6 p-4 bg-muted/50 rounded-lg">
                                <p className="text-sm font-medium mb-3">Preview in browser tab:</p>
                                <div className="flex items-center gap-2 bg-background border rounded-lg p-2 max-w-xs">
                                    <img
                                        src={faviconPreview}
                                        alt="Favicon preview"
                                        className="h-4 w-4 object-contain"
                                        onError={(e) => {
                                            e.target.src = '/favicon.ico';
                                        }}
                                    />
                                    <span className="text-sm truncate">{data.site_name || 'Your Site'}</span>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </form>
            </div>
        </div>
    );
}

Settings.layout = (page) => <AdminLayout>{page}</AdminLayout>;
