import { useState } from 'react';
import AdminLayout from '@/Layouts/AdminLayout';
import { useForm, Link } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { AdminTextInput } from '@/components/AdminTextInput';
import { AdminImageInput } from '@/components/AdminImageInput';
import { Label } from '@/components/ui/label';
import { ArrowLeft, Save, Plus, Trash2, GripVertical } from 'lucide-react';

export default function HeaderEditor({ section }) {
    const initialContent = section?.content || {
        site_name: 'Chapakhana',
        logo: '/chapakhana logo.png',
        phone: '+880 1XXX-XXXXXX',
        navigation: [],
    };

    const { data, setData, post, processing } = useForm({
        content: initialContent,
        logo: null,
        _originalLogo: initialContent.logo, // Store original logo
    });

    const handleSubmit = (e) => {
        e.preventDefault();

        // Prepare data for submission
        const submitData = { ...data };
        const cleanContent = { ...data.content };

        // If logo is a blob URL (file being uploaded), remove it from content
        // The server will add the actual file path
        if (typeof cleanContent.logo === 'string' && cleanContent.logo.startsWith('blob:')) {
            // Use original logo or empty if this is first upload
            cleanContent.logo = data._originalLogo || '';
        }

        submitData.content = cleanContent;

        // Submit with the cleaned data
        post('/admin/pages/header', {
            data: submitData,
            forceFormData: true,
            preserveScroll: true,
            onSuccess: (page) => {
                // Update with the new logo from server response
                const updatedSection = page.props.section;
                if (updatedSection?.content?.logo) {
                    setData(prev => ({
                        ...prev,
                        logo: null,
                        _originalLogo: updatedSection.content.logo,
                        content: {
                            ...prev.content,
                            logo: updatedSection.content.logo
                        }
                    }));
                } else {
                    setData(prev => ({ ...prev, logo: null }));
                }
            },
        });
    };

    const addNavItem = () => {
        const newNav = [...(data.content.navigation || []), {
            title: '',
            url: '',
            pattern: '',
        }];
        setData('content', { ...data.content, navigation: newNav });
    };

    const updateNavItem = (index, field, value) => {
        const nav = [...data.content.navigation];
        nav[index] = { ...nav[index], [field]: value };
        setData('content', { ...data.content, navigation: nav });
    };

    const removeNavItem = (index) => {
        const nav = data.content.navigation.filter((_, i) => i !== index);
        setData('content', { ...data.content, navigation: nav });
    };

    const moveNavItem = (index, direction) => {
        const nav = [...data.content.navigation];
        const newIndex = direction === 'up' ? index - 1 : index + 1;
        if (newIndex < 0 || newIndex >= nav.length) return;
        [nav[index], nav[newIndex]] = [nav[newIndex], nav[index]];
        setData('content', { ...data.content, navigation: nav });
    };

    return (
        <>
            <div className="@container/main flex flex-1 flex-col gap-2">
                <div className="flex flex-col gap-4 py-4 md:gap-6 md:py-6">
                    {/* Header */}
                    <div className="flex items-center justify-between px-4 lg:px-6">
                        <div className="flex items-center gap-4">
                            {/* <Button variant="ghost" size="sm" asChild>
                                <Link href="/admin/pages">
                                    <ArrowLeft className="h-4 w-4 mr-1" />
                                    Back
                                </Link>
                            </Button> */}
                            <div>
                                <h1 className="text-2xl font-bold tracking-tight">Edit Header</h1>
                                <p className="text-muted-foreground text-sm">
                                    Manage site header content and navigation.
                                </p>
                            </div>
                        </div>
                        <Button onClick={handleSubmit} disabled={processing}>
                            <Save className="h-4 w-4 mr-2" />
                            {processing ? 'Saving...' : 'Save Changes'}
                        </Button>
                    </div>

                    {/* Content */}
                    <form onSubmit={handleSubmit} className="px-4 lg:px-6 space-y-6">
                        {/* Basic Info */}
                        <Card>
                            <CardHeader>
                                <CardTitle>Basic Information</CardTitle>
                                <CardDescription>Site name and contact details</CardDescription>
                            </CardHeader>
                            <CardContent className="space-y-4">
                                <div className="max-w-md">
                                    <AdminImageInput
                                        label="Website Logo"
                                        id="logo"
                                        value={data.content.logo || ''}
                                        onChange={(value) => {
                                            if (value instanceof File) {
                                                // Store the file for upload
                                                setData(prev => ({
                                                    ...prev,
                                                    logo: value,
                                                    content: {
                                                        ...prev.content,
                                                        logo: URL.createObjectURL(value)
                                                    }
                                                }));
                                            } else if (typeof value === 'string') {
                                                // URL input
                                                setData(prev => ({
                                                    ...prev,
                                                    logo: null,
                                                    content: {
                                                        ...prev.content,
                                                        logo: value
                                                    }
                                                }));
                                            } else {
                                                // Remove image
                                                setData(prev => ({
                                                    ...prev,
                                                    logo: null,
                                                    content: {
                                                        ...prev.content,
                                                        logo: ''
                                                    }
                                                }));
                                            }
                                        }}
                                        defaultImage={data.content.logo}
                                        aspectRatio="3/1"
                                        maxSizeMB={15}
                                        helperText="Recommended: 300x100px, PNG or SVG format"
                                    />
                                </div>
                                <div className="grid gap-4 md:grid-cols-2">
                                    <AdminTextInput
                                        label="Site Name"
                                        id="site_name"
                                        value={data.content.site_name || ''}
                                        onChange={(e) => setData('content', {
                                            ...data.content,
                                            site_name: e.target.value
                                        })}
                                        defaultValue={initialContent.site_name}
                                        minLength={2}
                                        maxLength={50}
                                        placeholder="Chapakhana"
                                    />
                                    <AdminTextInput
                                        label="Phone Number"
                                        id="phone"
                                        value={data.content.phone || ''}
                                        onChange={(e) => setData('content', {
                                            ...data.content,
                                            phone: e.target.value
                                        })}
                                        defaultValue={initialContent.phone}
                                        maxLength={20}
                                        placeholder="+880 1XXX-XXXXXX"
                                    />
                                </div>
                            </CardContent>
                        </Card>

                        {/* Navigation */}
                        <Card>
                            <CardHeader>
                                <div className="flex items-center justify-between">
                                    <div>
                                        <CardTitle>Navigation Menu</CardTitle>
                                        <CardDescription>Main navigation links</CardDescription>
                                    </div>
                                    <Button type="button" variant="outline" size="sm" onClick={addNavItem}>
                                        <Plus className="h-4 w-4 mr-1" />
                                        Add Link
                                    </Button>
                                </div>
                            </CardHeader>
                            <CardContent>
                                <div className="space-y-3">
                                    {(data.content.navigation || []).map((item, index) => (
                                        <div key={index} className="flex items-center gap-3 p-3 border rounded-lg bg-muted/50">
                                            <div className="flex flex-col gap-1">
                                                <Button
                                                    type="button"
                                                    variant="ghost"
                                                    size="sm"
                                                    className="h-6 w-6 p-0"
                                                    onClick={() => moveNavItem(index, 'up')}
                                                    disabled={index === 0}
                                                >
                                                    ↑
                                                </Button>
                                                <Button
                                                    type="button"
                                                    variant="ghost"
                                                    size="sm"
                                                    className="h-6 w-6 p-0"
                                                    onClick={() => moveNavItem(index, 'down')}
                                                    disabled={index === data.content.navigation.length - 1}
                                                >
                                                    ↓
                                                </Button>
                                            </div>
                                            <div className="grid flex-1 gap-3 md:grid-cols-3">
                                                <AdminTextInput
                                                    label="Title"
                                                    id={`nav-title-${index}`}
                                                    value={item.title}
                                                    onChange={(e) => updateNavItem(index, 'title', e.target.value)}
                                                    placeholder="Home"
                                                    maxLength={30}
                                                    className="[&>label]:text-xs"
                                                    showCharCount={false}
                                                />
                                                <AdminTextInput
                                                    label="URL"
                                                    id={`nav-url-${index}`}
                                                    type="url"
                                                    value={item.url}
                                                    onChange={(e) => updateNavItem(index, 'url', e.target.value)}
                                                    placeholder="/"
                                                    maxLength={100}
                                                    className="[&>label]:text-xs"
                                                    showCharCount={false}
                                                />
                                                <AdminTextInput
                                                    label="Active Pattern"
                                                    id={`nav-pattern-${index}`}
                                                    value={item.pattern}
                                                    onChange={(e) => updateNavItem(index, 'pattern', e.target.value)}
                                                    placeholder="/"
                                                    maxLength={100}
                                                    className="[&>label]:text-xs"
                                                    showCharCount={false}
                                                />
                                            </div>
                                            <Button
                                                type="button"
                                                variant="ghost"
                                                size="sm"
                                                onClick={() => removeNavItem(index)}
                                            >
                                                <Trash2 className="h-4 w-4 text-destructive" />
                                            </Button>
                                        </div>
                                    ))}
                                    {(!data.content.navigation || data.content.navigation.length === 0) && (
                                        <p className="text-center text-muted-foreground py-8">
                                            No navigation items. Click "Add Link" to add one.
                                        </p>
                                    )}
                                </div>
                            </CardContent>
                        </Card>
                    </form>
                </div>
            </div>
        </>
    );
}

HeaderEditor.layout = (page) => <AdminLayout>{page}</AdminLayout>;
