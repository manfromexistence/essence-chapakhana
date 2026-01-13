import React, { useState } from 'react';
import AdminLayout from '@/Layouts/AdminLayout';
import { AdminTextInput } from '@/components/AdminTextInput';
import { AdminImageInput } from '@/components/AdminImageInput';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { Button } from '@/components/ui/button';
import { CheckCircle2, Code } from 'lucide-react';

import { useTabsWithLocalStorage } from '@/hooks/useTabsWithLocalStorage';

/**
 * Component Showcase Page
 * Demonstrates all features of AdminTextInput and AdminImageInput components
 */
export default function ComponentShowcase() {
    const [activeTab, setActiveTab] = useTabsWithLocalStorage('admin-component-showcase-tab', 'text-inputs');

    // Text Input States
    const [basicText, setBasicText] = useState('');
    const [emailText, setEmailText] = useState('');
    const [urlText, setUrlText] = useState('');
    const [limitedText, setLimitedText] = useState('');
    const [customValidText, setCustomValidText] = useState('');
    const [seededText, setSeededText] = useState('Default seeded value');

    // Image States
    const [basicImage, setBasicImage] = useState(null);
    const [squareImage, setSquareImage] = useState(null);
    const [seededImage, setSeededImage] = useState(null);

    const seededImageUrl = 'https://via.placeholder.com/800x450/4F46E5/ffffff?text=Seeded+Image';

    const [showSuccess, setShowSuccess] = useState(false);

    const handleDemoSubmit = (e) => {
        e.preventDefault();
        setShowSuccess(true);
        setTimeout(() => setShowSuccess(false), 3000);
    };

    return (
        <>
            <div className="space-y-6 pb-8">
                {/* Header */}
                <div>
                    <h1 className="text-3xl font-bold">Admin Component Showcase</h1>
                    <p className="text-muted-foreground">
                        Interactive demonstration of AdminTextInput and AdminImageInput components
                    </p>
                </div>

                {showSuccess && (
                    <div className="bg-green-50 border border-green-200 rounded-lg p-4 flex items-center gap-3">
                        <CheckCircle2 className="h-5 w-5 text-green-600" />
                        <p className="text-sm text-green-800 font-medium">
                            Form validation successful! All inputs are valid.
                        </p>
                    </div>
                )}

                <Tabs value={activeTab} onValueChange={setActiveTab} className="space-y-6">
                    <TabsList className="grid w-full grid-cols-3">
                        <TabsTrigger value="text-inputs">Text Inputs</TabsTrigger>
                        <TabsTrigger value="image-inputs">Image Inputs</TabsTrigger>
                        <TabsTrigger value="complete-form">Complete Form</TabsTrigger>
                    </TabsList>

                    {/* TEXT INPUTS TAB */}
                    <TabsContent value="text-inputs" className="space-y-6">
                        {/* Basic Text Input */}
                        <Card>
                            <CardHeader>
                                <CardTitle>Basic Text Input</CardTitle>
                                <CardDescription>
                                    Simple text input with required validation
                                </CardDescription>
                            </CardHeader>
                            <CardContent className="space-y-4">
                                <AdminTextInput
                                    label="Product Name"
                                    id="basic-text"
                                    value={basicText}
                                    onChange={(e) => setBasicText(e.target.value)}
                                    placeholder="Enter product name"
                                    required
                                    helperText="This field is required"
                                />
                                <div className="bg-gray-50 p-3 rounded-md text-sm font-mono">
                                    Current value: "{basicText}"
                                </div>
                            </CardContent>
                        </Card>

                        {/* Character Limits */}
                        <Card>
                            <CardHeader>
                                <CardTitle>With Character Limits</CardTitle>
                                <CardDescription>
                                    Text input with min/max character validation and counter
                                </CardDescription>
                            </CardHeader>
                            <CardContent className="space-y-4">
                                <AdminTextInput
                                    label="Product Description"
                                    id="limited-text"
                                    value={limitedText}
                                    onChange={(e) => setLimitedText(e.target.value)}
                                    placeholder="Enter description (10-100 characters)"
                                    minLength={10}
                                    maxLength={100}
                                    required
                                    helperText="Must be between 10 and 100 characters"
                                />
                                <div className="bg-gray-50 p-3 rounded-md text-sm">
                                    <strong>Length:</strong> {limitedText.length} characters
                                </div>
                            </CardContent>
                        </Card>

                        {/* Email Validation */}
                        <Card>
                            <CardHeader>
                                <CardTitle>Email Validation</CardTitle>
                                <CardDescription>
                                    Built-in email format validation
                                </CardDescription>
                            </CardHeader>
                            <CardContent className="space-y-4">
                                <AdminTextInput
                                    label="Email Address"
                                    id="email-text"
                                    type="email"
                                    value={emailText}
                                    onChange={(e) => setEmailText(e.target.value)}
                                    placeholder="user@example.com"
                                    required
                                    helperText="Enter a valid email address"
                                />
                            </CardContent>
                        </Card>

                        {/* URL Validation */}
                        <Card>
                            <CardHeader>
                                <CardTitle>URL Validation</CardTitle>
                                <CardDescription>
                                    Built-in URL format validation
                                </CardDescription>
                            </CardHeader>
                            <CardContent className="space-y-4">
                                <AdminTextInput
                                    label="Website URL"
                                    id="url-text"
                                    type="url"
                                    value={urlText}
                                    onChange={(e) => setUrlText(e.target.value)}
                                    placeholder="https://example.com"
                                    helperText="Enter a valid URL starting with http:// or https://"
                                />
                            </CardContent>
                        </Card>

                        {/* Custom Validation */}
                        <Card>
                            <CardHeader>
                                <CardTitle>Custom Validation</CardTitle>
                                <CardDescription>
                                    Text input with custom validation rules (Phone number example)
                                </CardDescription>
                            </CardHeader>
                            <CardContent className="space-y-4">
                                <AdminTextInput
                                    label="Phone Number (Nepal)"
                                    id="custom-valid-text"
                                    value={customValidText}
                                    onChange={(e) => setCustomValidText(e.target.value)}
                                    placeholder="9801234567"
                                    maxLength={10}
                                    validation={{
                                        pattern: '^[0-9]{10}$',
                                        patternMessage: 'Phone number must be exactly 10 digits',
                                        custom: (value) => {
                                            if (value && !value.startsWith('9')) {
                                                return 'Phone number must start with 9';
                                            }
                                            return null;
                                        },
                                    }}
                                    helperText="Enter 10-digit phone number starting with 9"
                                />
                            </CardContent>
                        </Card>

                        {/* Seeded/Default Value */}
                        <Card>
                            <CardHeader>
                                <CardTitle>Seeded/Default Value</CardTitle>
                                <CardDescription>
                                    Text input with pre-filled default value (for editing existing data)
                                </CardDescription>
                            </CardHeader>
                            <CardContent className="space-y-4">
                                <AdminTextInput
                                    label="Product Title"
                                    id="seeded-text"
                                    value={seededText}
                                    onChange={(e) => setSeededText(e.target.value)}
                                    defaultValue="Default seeded value"
                                    maxLength={50}
                                    required
                                    helperText="This field contains pre-filled data from the database"
                                />
                                {/* <div className="bg-blue-50 border border-blue-200 p-3 rounded-md text-sm">
                                    <strong className="text-blue-900">Note:</strong>
                                    <span className="text-blue-700 ml-1">
                                        The "(seeded)" badge indicates this value came from the database
                                    </span>
                                </div> */}
                            </CardContent>
                        </Card>
                    </TabsContent>

                    {/* IMAGE INPUTS TAB */}
                    <TabsContent value="image-inputs" className="space-y-6">
                        {/* Basic Image Upload */}
                        <Card>
                            <CardHeader>
                                <CardTitle>Basic Image Upload</CardTitle>
                                <CardDescription>
                                    Upload image via file browser or drag-and-drop, or use URL
                                </CardDescription>
                            </CardHeader>
                            <CardContent>
                                <AdminImageInput
                                    label="Product Banner"
                                    id="basic-image"
                                    value={basicImage}
                                    onChange={(file) => setBasicImage(file)}
                                    helperText="Upload image up to 5MB (JPG, PNG, WebP, GIF)"
                                    required
                                />
                            </CardContent>
                        </Card>

                        {/* Square/Profile Image */}
                        <Card>
                            <CardHeader>
                                <CardTitle>Square Profile Image</CardTitle>
                                <CardDescription>
                                    Image upload with 1:1 aspect ratio (perfect for profile pictures)
                                </CardDescription>
                            </CardHeader>
                            <CardContent>
                                <AdminImageInput
                                    label="Profile Picture"
                                    id="square-image"
                                    value={squareImage}
                                    onChange={(file) => setSquareImage(file)}
                                    aspectRatio="1/1"
                                    maxSizeMB={2}
                                    acceptedFormats={['jpg', 'jpeg', 'png']}
                                    helperText="Upload square image (max 2MB, JPG/PNG only)"
                                />
                            </CardContent>
                        </Card>

                        {/* Seeded/Default Image */}
                        <Card>
                            <CardHeader>
                                <CardTitle>Seeded/Default Image</CardTitle>
                                <CardDescription>
                                    Image input with existing image (for editing)
                                </CardDescription>
                            </CardHeader>
                            <CardContent className="space-y-4">
                                <AdminImageInput
                                    label="Product Image"
                                    id="seeded-image"
                                    value={seededImage}
                                    onChange={(file) => setSeededImage(file)}
                                    defaultImage={seededImageUrl}
                                    helperText="This shows an existing image from the database. You can change it."
                                />
                                <div className="bg-blue-50 border border-blue-200 p-3 rounded-md text-sm">
                                    <strong className="text-blue-900">Note:</strong>
                                    <span className="text-blue-700 ml-1">
                                        The "Default" badge indicates this is the current image. You can upload a new one to replace it.
                                    </span>
                                </div>
                            </CardContent>
                        </Card>

                        {/* Image Features Info */}
                        <Card className="bg-gradient-to-br from-indigo-50 to-blue-50">
                            <CardHeader>
                                <CardTitle className="flex items-center gap-2">
                                    <Code className="h-5 w-5" />
                                    Image Component Features
                                </CardTitle>
                            </CardHeader>
                            <CardContent>
                                <ul className="space-y-2 text-sm">
                                    <li className="flex items-start gap-2">
                                        <CheckCircle2 className="h-4 w-4 text-green-600 mt-0.5" />
                                        <span>Drag and drop file upload</span>
                                    </li>
                                    <li className="flex items-start gap-2">
                                        <CheckCircle2 className="h-4 w-4 text-green-600 mt-0.5" />
                                        <span>Browse files via file picker</span>
                                    </li>
                                    <li className="flex items-start gap-2">
                                        <CheckCircle2 className="h-4 w-4 text-green-600 mt-0.5" />
                                        <span>Load image from URL</span>
                                    </li>
                                    <li className="flex items-start gap-2">
                                        <CheckCircle2 className="h-4 w-4 text-green-600 mt-0.5" />
                                        <span>Real-time image preview</span>
                                    </li>
                                    <li className="flex items-start gap-2">
                                        <CheckCircle2 className="h-4 w-4 text-green-600 mt-0.5" />
                                        <span>File type validation (JPG, PNG, WebP, GIF)</span>
                                    </li>
                                    <li className="flex items-start gap-2">
                                        <CheckCircle2 className="h-4 w-4 text-green-600 mt-0.5" />
                                        <span>File size validation (configurable max size)</span>
                                    </li>
                                    <li className="flex items-start gap-2">
                                        <CheckCircle2 className="h-4 w-4 text-green-600 mt-0.5" />
                                        <span>Custom aspect ratio support</span>
                                    </li>
                                    <li className="flex items-start gap-2">
                                        <CheckCircle2 className="h-4 w-4 text-green-600 mt-0.5" />
                                        <span>Remove/change image functionality</span>
                                    </li>
                                    <li className="flex items-start gap-2">
                                        <CheckCircle2 className="h-4 w-4 text-green-600 mt-0.5" />
                                        <span>Seeded/default image support</span>
                                    </li>
                                </ul>
                            </CardContent>
                        </Card>
                    </TabsContent>

                    {/* COMPLETE FORM TAB */}
                    <TabsContent value="complete-form" className="space-y-6">
                        <Card>
                            <CardHeader>
                                <CardTitle>Complete Product Form Example</CardTitle>
                                <CardDescription>
                                    Real-world example combining both components
                                </CardDescription>
                            </CardHeader>
                            <CardContent>
                                <form onSubmit={handleDemoSubmit} className="space-y-6">
                                    <div className="grid grid-cols-2 gap-6">
                                        <AdminTextInput
                                            label="Product Title"
                                            id="form-title"
                                            value={basicText}
                                            onChange={(e) => setBasicText(e.target.value)}
                                            minLength={3}
                                            maxLength={100}
                                            required
                                            placeholder="Enter product title"
                                        />

                                        <AdminTextInput
                                            label="Price (Rs.)"
                                            id="form-price"
                                            type="number"
                                            value=""
                                            onChange={() => { }}
                                            required
                                            placeholder="0.00"
                                        />
                                    </div>

                                    <AdminTextInput
                                        label="Description"
                                        id="form-description"
                                        value={limitedText}
                                        onChange={(e) => setLimitedText(e.target.value)}
                                        minLength={10}
                                        maxLength={200}
                                        required
                                        placeholder="Enter product description"
                                    />

                                    <AdminTextInput
                                        label="Contact Email"
                                        id="form-email"
                                        type="email"
                                        value={emailText}
                                        onChange={(e) => setEmailText(e.target.value)}
                                        required
                                        placeholder="contact@example.com"
                                    />

                                    <AdminImageInput
                                        label="Product Image"
                                        id="form-image"
                                        value={basicImage}
                                        onChange={(file) => setBasicImage(file)}
                                        required
                                        helperText="Upload product image (16:9 ratio recommended)"
                                    />

                                    <div className="flex justify-end gap-4 pt-4">
                                        <Button type="button" variant="outline">
                                            Cancel
                                        </Button>
                                        <Button type="submit">
                                            Submit Form
                                        </Button>
                                    </div>
                                </form>
                            </CardContent>
                        </Card>

                        {/* Documentation Links */}
                        <Card className="bg-gradient-to-br from-purple-50 to-pink-50">
                            <CardHeader>
                                <CardTitle>📚 Documentation</CardTitle>
                            </CardHeader>
                            <CardContent className="space-y-3">
                                <div>
                                    <strong className="text-sm">Full Documentation:</strong>
                                    <p className="text-sm text-muted-foreground">
                                        docs/ADMIN_FORM_COMPONENTS.md
                                    </p>
                                </div>
                                <div>
                                    <strong className="text-sm">Quick Reference:</strong>
                                    <p className="text-sm text-muted-foreground">
                                        docs/ADMIN_COMPONENTS_QUICK_REF.md
                                    </p>
                                </div>
                                <div>
                                    <strong className="text-sm">Example Code:</strong>
                                    <p className="text-sm text-muted-foreground">
                                        resources/js/Pages/Admin/ExampleForm.jsx
                                    </p>
                                </div>
                            </CardContent>
                        </Card>
                    </TabsContent>
                </Tabs>
            </div>
        </>
    );
}

ComponentShowcase.layout = (page) => <AdminLayout>{page}</AdminLayout>;
