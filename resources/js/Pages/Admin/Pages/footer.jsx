import { useState } from 'react';
import AdminLayout from '@/Layouts/AdminLayout';
import { useForm, Link } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { AdminTextInput } from '@/components/AdminTextInput';
import { AdminImageInput } from '@/components/AdminImageInput';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { ArrowLeft, Save, Plus, Trash2 } from 'lucide-react';

export default function FooterEditor({ section }) {
    const initialContent = section?.content || {
        logo: '/logo.png',
        company_info: { name: '', description: '' },
        contact: { address: '', phone: '', email: '' },
        social_links: [],
        quick_links: [],
        copyright: '',
    };

    const { data, setData, put, processing } = useForm({
        content: initialContent,
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        put('/admin/pages/footer');
    };

    // Social Links handlers
    const addSocialLink = () => {
        const newLinks = [...(data.content.social_links || []), {
            platform: '',
            url: '',
        }];
        setData('content', { ...data.content, social_links: newLinks });
    };

    const updateSocialLink = (index, field, value) => {
        const links = [...data.content.social_links];
        links[index] = { ...links[index], [field]: value };
        setData('content', { ...data.content, social_links: links });
    };

    const removeSocialLink = (index) => {
        const links = data.content.social_links.filter((_, i) => i !== index);
        setData('content', { ...data.content, social_links: links });
    };

    // Quick Links handlers
    const addQuickLink = () => {
        const newLinks = [...(data.content.quick_links || []), {
            title: '',
            url: '',
        }];
        setData('content', { ...data.content, quick_links: newLinks });
    };

    const updateQuickLink = (index, field, value) => {
        const links = [...data.content.quick_links];
        links[index] = { ...links[index], [field]: value };
        setData('content', { ...data.content, quick_links: links });
    };

    const removeQuickLink = (index) => {
        const links = data.content.quick_links.filter((_, i) => i !== index);
        setData('content', { ...data.content, quick_links: links });
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
                                <h1 className="text-2xl font-bold tracking-tight">Edit Footer</h1>
                                <p className="text-muted-foreground text-sm">
                                    Manage footer content, links, and social media.
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
                        {/* Logo */}
                        <Card>
                            <CardHeader>
                                <CardTitle>Footer Logo</CardTitle>
                                <CardDescription>Upload your company logo for the footer</CardDescription>
                            </CardHeader>
                            <CardContent>
                                <AdminImageInput
                                    label="Logo Image"
                                    id="footer_logo"
                                    value={data.content.logo || ''}
                                    onChange={(file) => setData('content', { ...data.content, logo: file })}
                                    defaultImage={initialContent.logo}
                                    aspectRatio="auto"
                                    maxSizeMB={2}
                                    helperText="Recommended: PNG with transparent background, max 2MB"
                                />
                            </CardContent>
                        </Card>

                        {/* Company Info */}
                        <Card>
                            <CardHeader>
                                <CardTitle>Company Information</CardTitle>
                                <CardDescription>Brand name and description</CardDescription>
                            </CardHeader>
                            <CardContent className="space-y-4">
                                <AdminTextInput
                                    label="Company Name"
                                    id="company_name"
                                    value={data.content.company_info?.name || ''}
                                    onChange={(e) => setData('content', {
                                        ...data.content,
                                        company_info: { ...data.content.company_info, name: e.target.value }
                                    })}
                                    defaultValue={initialContent.company_info?.name}
                                    maxLength={50}
                                    placeholder="Chapakhana"
                                />
                                <div>
                                    <Label>Description</Label>
                                    <Textarea
                                        value={data.content.company_info?.description || ''}
                                        onChange={(e) => setData('content', {
                                            ...data.content,
                                            company_info: { ...data.content.company_info, description: e.target.value }
                                        })}
                                        placeholder="Company description..."
                                        rows={3}
                                    />
                                </div>
                            </CardContent>
                        </Card>

                        {/* Contact Info */}
                        <Card>
                            <CardHeader>
                                <CardTitle>Contact Information</CardTitle>
                                <CardDescription>Address, phone, and email</CardDescription>
                            </CardHeader>
                            <CardContent>
                                <div className="grid gap-4 md:grid-cols-3">
                                    <AdminTextInput
                                        label="Address"
                                        id="address"
                                        value={data.content.contact?.address || ''}
                                        onChange={(e) => setData('content', {
                                            ...data.content,
                                            contact: { ...data.content.contact, address: e.target.value }
                                        })}
                                        defaultValue={initialContent.contact?.address}
                                        maxLength={100}
                                        placeholder="ঢাকা, বাংলাদেশ"
                                    />
                                    <AdminTextInput
                                        label="Phone"
                                        id="contact_phone"
                                        value={data.content.contact?.phone || ''}
                                        onChange={(e) => setData('content', {
                                            ...data.content,
                                            contact: { ...data.content.contact, phone: e.target.value }
                                        })}
                                        defaultValue={initialContent.contact?.phone}
                                        maxLength={20}
                                        placeholder="+880 1XXX-XXXXXX"
                                    />
                                    <AdminTextInput
                                        label="Email"
                                        id="contact_email"
                                        type="email"
                                        value={data.content.contact?.email || ''}
                                        onChange={(e) => setData('content', {
                                            ...data.content,
                                            contact: { ...data.content.contact, email: e.target.value }
                                        })}
                                        defaultValue={initialContent.contact?.email}
                                        placeholder="info@chapakhana.com"
                                    />
                                </div>
                            </CardContent>
                        </Card>

                        {/* Social Links */}
                        <Card>
                            <CardHeader>
                                <div className="flex items-center justify-between">
                                    <div>
                                        <CardTitle>Social Media Links</CardTitle>
                                        <CardDescription>Connect with your audience</CardDescription>
                                    </div>
                                    <Button type="button" variant="outline" size="sm" onClick={addSocialLink}>
                                        <Plus className="h-4 w-4 mr-1" />
                                        Add Social
                                    </Button>
                                </div>
                            </CardHeader>
                            <CardContent>
                                <div className="grid gap-3 md:grid-cols-3">
                                    {(data.content.social_links || []).map((link, index) => (
                                        <div key={index} className="flex items-end gap-2 p-3 border rounded-lg">
                                            <div className="flex-1 space-y-2">
                                                <AdminTextInput
                                                    label="Platform"
                                                    id={`social-platform-${index}`}
                                                    value={link.platform}
                                                    onChange={(e) => updateSocialLink(index, 'platform', e.target.value)}
                                                    placeholder="facebook"
                                                    maxLength={20}
                                                    className="[&>label]:text-xs"
                                                    showCharCount={false}
                                                />
                                                <AdminTextInput
                                                    label="URL"
                                                    id={`social-url-${index}`}
                                                    type="url"
                                                    value={link.url}
                                                    onChange={(e) => updateSocialLink(index, 'url', e.target.value)}
                                                    placeholder="https://..."
                                                    maxLength={200}
                                                    className="[&>label]:text-xs"
                                                    showCharCount={false}
                                                />
                                            </div>
                                            <Button
                                                type="button"
                                                variant="ghost"
                                                size="sm"
                                                onClick={() => removeSocialLink(index)}
                                            >
                                                <Trash2 className="h-4 w-4 text-destructive" />
                                            </Button>
                                        </div>
                                    ))}
                                    {(!data.content.social_links || data.content.social_links.length === 0) && (
                                        <p className="col-span-3 text-center text-muted-foreground py-4">
                                            No social links. Click "Add Social" to add one.
                                        </p>
                                    )}
                                </div>
                            </CardContent>
                        </Card>

                        {/* Quick Links */}
                        <Card>
                            <CardHeader>
                                <div className="flex items-center justify-between">
                                    <div>
                                        <CardTitle>Quick Links</CardTitle>
                                        <CardDescription>Footer navigation links</CardDescription>
                                    </div>
                                    <Button type="button" variant="outline" size="sm" onClick={addQuickLink}>
                                        <Plus className="h-4 w-4 mr-1" />
                                        Add Link
                                    </Button>
                                </div>
                            </CardHeader>
                            <CardContent>
                                <div className="grid gap-3 md:grid-cols-2 lg:grid-cols-3">
                                    {(data.content.quick_links || []).map((link, index) => (
                                        <div key={index} className="flex items-end gap-2 p-3 border rounded-lg">
                                            <div className="flex-1 grid grid-cols-2 gap-2">
                                                <AdminTextInput
                                                    label="Title"
                                                    id={`quick-title-${index}`}
                                                    value={link.title}
                                                    onChange={(e) => updateQuickLink(index, 'title', e.target.value)}
                                                    placeholder="About Us"
                                                    maxLength={30}
                                                    className="[&>label]:text-xs"
                                                    showCharCount={false}
                                                />
                                                <AdminTextInput
                                                    label="URL"
                                                    id={`quick-url-${index}`}
                                                    value={link.url}
                                                    onChange={(e) => updateQuickLink(index, 'url', e.target.value)}
                                                    placeholder="/about"
                                                    maxLength={100}
                                                    className="[&>label]:text-xs"
                                                    showCharCount={false}
                                                />
                                            </div>
                                            <Button
                                                type="button"
                                                variant="ghost"
                                                size="sm"
                                                onClick={() => removeQuickLink(index)}
                                            >
                                                <Trash2 className="h-4 w-4 text-destructive" />
                                            </Button>
                                        </div>
                                    ))}
                                    {(!data.content.quick_links || data.content.quick_links.length === 0) && (
                                        <p className="col-span-3 text-center text-muted-foreground py-4">
                                            No quick links. Click "Add Link" to add one.
                                        </p>
                                    )}
                                </div>
                            </CardContent>
                        </Card>

                        {/* Copyright */}
                        <Card>
                            <CardHeader>
                                <CardTitle>Copyright</CardTitle>
                                <CardDescription>Copyright text shown at the bottom</CardDescription>
                            </CardHeader>
                            <CardContent>
                                <AdminTextInput
                                    label="Copyright Text"
                                    id="copyright"
                                    value={data.content.copyright || ''}
                                    onChange={(e) => setData('content', {
                                        ...data.content,
                                        copyright: e.target.value
                                    })}
                                    defaultValue={initialContent.copyright}
                                    maxLength={100}
                                    placeholder="© 2026 Chapakhana. All rights reserved."
                                />
                            </CardContent>
                        </Card>
                    </form>
                </div>
            </div>
        </>
    );
}

FooterEditor.layout = (page) => <AdminLayout>{page}</AdminLayout>;
