import React from 'react';
import AdminLayout from '@/Layouts/AdminLayout';
import { useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { AdminTextInput } from '@/components/AdminTextInput';
import { AdminImageInput } from '@/components/AdminImageInput';

/**
 * Example usage of AdminTextInput and AdminImageInput components
 * 
 * This example shows how to use the reusable admin components with Inertia.js forms
 */
export default function ExampleForm({ seededData }) {
    const { data, setData, post, processing, errors } = useForm({
        title: seededData?.title || '',
        description: seededData?.description || '',
        email: seededData?.email || '',
        url: seededData?.url || '',
        image: null,
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/admin/example', {
            forceFormData: true,
        });
    };

    return (
        <>
            <div className="space-y-6">
                <div>
                    <h1 className="text-3xl font-bold">Example Form</h1>
                    <p className="text-muted-foreground">
                        Demonstrating AdminTextInput and AdminImageInput components
                    </p>
                </div>

                <Card>
                    <CardHeader>
                        <CardTitle>Form Example</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <form onSubmit={handleSubmit} className="space-y-6">
                            {/* Basic Text Input with min/max length */}
                            <AdminTextInput
                                label="Title"
                                id="title"
                                value={data.title}
                                onChange={(e) => setData('title', e.target.value)}
                                defaultValue={seededData?.title}
                                minLength={3}
                                maxLength={100}
                                required
                                error={errors.title}
                                placeholder="Enter a title"
                                helperText="This will be displayed as the main heading"
                            />

                            {/* Text Input with custom validation */}
                            <AdminTextInput
                                label="Description"
                                id="description"
                                value={data.description}
                                onChange={(e) => setData('description', e.target.value)}
                                defaultValue={seededData?.description}
                                minLength={10}
                                maxLength={500}
                                required
                                error={errors.description}
                                placeholder="Enter a detailed description"
                                helperText="Provide a comprehensive description (10-500 characters)"
                            />

                            {/* Email Input with built-in validation */}
                            <AdminTextInput
                                label="Email Address"
                                id="email"
                                type="email"
                                value={data.email}
                                onChange={(e) => setData('email', e.target.value)}
                                defaultValue={seededData?.email}
                                required
                                error={errors.email}
                                placeholder="user@example.com"
                                helperText="Enter a valid email address"
                            />

                            {/* URL Input with validation */}
                            <AdminTextInput
                                label="Website URL"
                                id="url"
                                type="url"
                                value={data.url}
                                onChange={(e) => setData('url', e.target.value)}
                                defaultValue={seededData?.url}
                                error={errors.url}
                                placeholder="https://example.com"
                                helperText="Enter a valid URL"
                            />

                            {/* Text Input with custom validation pattern */}
                            <AdminTextInput
                                label="Phone Number"
                                id="phone"
                                value={data.phone}
                                onChange={(e) => setData('phone', e.target.value)}
                                defaultValue={seededData?.phone}
                                validation={{
                                    pattern: '^[0-9]{10}$',
                                    patternMessage: 'Phone number must be 10 digits',
                                    custom: (value) => {
                                        if (value && !value.startsWith('9')) {
                                            return 'Phone number must start with 9';
                                        }
                                        return null;
                                    },
                                }}
                                error={errors.phone}
                                placeholder="9801234567"
                                helperText="Enter 10-digit phone number"
                                maxLength={10}
                            />

                            {/* Image Input with file upload and URL support */}
                            <AdminImageInput
                                label="Featured Image"
                                id="image"
                                value={data.image}
                                onChange={(file) => setData('image', file)}
                                defaultImage={seededData?.image}
                                required
                                error={errors.image}
                                helperText="Upload an image or provide a URL. Max 5MB."
                                maxSizeMB={5}
                                acceptedFormats={['jpg', 'jpeg', 'png', 'webp']}
                                aspectRatio="16/9"
                            />

                            {/* Image Input with square aspect ratio */}
                            <AdminImageInput
                                label="Profile Picture"
                                id="profile_image"
                                value={data.profile_image}
                                onChange={(file) => setData('profile_image', file)}
                                defaultImage={seededData?.profile_image}
                                error={errors.profile_image}
                                helperText="Upload a square profile picture"
                                maxSizeMB={2}
                                aspectRatio="1/1"
                            />

                            {/* Submit Button */}
                            <div className="flex justify-end gap-4">
                                <Button type="button" variant="outline">
                                    Cancel
                                </Button>
                                <Button type="submit" disabled={processing}>
                                    {processing ? 'Submitting...' : 'Submit'}
                                </Button>
                            </div>
                        </form>
                    </CardContent>
                </Card>
            </div>
        </>
    );
}

ExampleForm.layout = (page) => <AdminLayout>{page}</AdminLayout>;
