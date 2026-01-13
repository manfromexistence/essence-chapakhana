import { useState } from 'react';
import AdminLayout from '@/Layouts/AdminLayout';
import { useForm, Link } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { AdminTextInput } from '@/components/AdminTextInput';
import { AdminImageInput } from '@/components/AdminImageInput';
import { Textarea } from '@/components/ui/textarea';
import { Label } from '@/components/ui/label';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { ArrowLeft, Save, Plus, Trash2 } from 'lucide-react';

import { useTabsWithLocalStorage } from '@/hooks/useTabsWithLocalStorage';

export default function CategoryProductEdit({ section, categorySlug, productSlug, categoryName, productName, defaultImage }) {
    const [activeTab, setActiveTab] = useTabsWithLocalStorage('admin-category-product-edit-tab', 'basic');

    const initialContent = section?.content || {
        title: productName,
        subtitle: '',
        description: '',
        hero_image: defaultImage || '',
        base_price: 0,
        min_quantity: 1,
        min_pages: 1,
        max_pages: 500,
        specifications: [],
        pricing_tiers: [],
        config_options: {
            sizes: [],
            paper_types: [],
            finishes: [],
        },
    };

    const { data, setData, put, processing } = useForm({
        content: initialContent,
        title: section?.title || productName,
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        // Use post method with _method spoofing for file uploads
        put(`/admin/pages/category/${categorySlug}/product/${productSlug}`, {
            forceFormData: true,
            onSuccess: () => {
                // Success notification handled by backend
            },
        });
    };

    // Specifications handlers
    const addSpecification = () => {
        const newSpecs = [...(data.content.specifications || []), { label: '', value: '' }];
        setData('content', { ...data.content, specifications: newSpecs });
    };

    const updateSpecification = (index, field, value) => {
        const specs = [...data.content.specifications];
        specs[index] = { ...specs[index], [field]: value };
        setData('content', { ...data.content, specifications: specs });
    };

    const removeSpecification = (index) => {
        const specs = data.content.specifications.filter((_, i) => i !== index);
        setData('content', { ...data.content, specifications: specs });
    };

    // Pricing tiers handlers
    const addPricingTier = () => {
        const newTiers = [...(data.content.pricing_tiers || []), { min_qty: 0, max_qty: 0, price: 0 }];
        setData('content', { ...data.content, pricing_tiers: newTiers });
    };

    const updatePricingTier = (index, field, value) => {
        const tiers = [...data.content.pricing_tiers];
        tiers[index] = { ...tiers[index], [field]: value };
        setData('content', { ...data.content, pricing_tiers: tiers });
    };

    const removePricingTier = (index) => {
        const tiers = data.content.pricing_tiers.filter((_, i) => i !== index);
        setData('content', { ...data.content, pricing_tiers: tiers });
    };

    // const removePricingTier = (index) => {
    //     const tiers = data.content.pricing_tiers.filter((_, i) => i !== index);
    //     setData('content', { ...data.content, pricing_tiers: tiers });
    // };

    return (
        <div className="@container/main flex flex-1 flex-col gap-2">
            <div className="flex flex-col gap-4 py-4 md:gap-6 md:py-6">
                {/* Header */}
                <div className="flex items-center justify-between px-4 lg:px-6">
                    <div className="flex items-center gap-4">
                        {/* <Button variant="ghost" size="sm" asChild>
                            <Link href={`/admin/pages/category/${categorySlug}`}>
                                <ArrowLeft className="h-4 w-4 mr-1" />
                                Back to {categoryName}
                            </Link>
                        </Button> */}
                        <div>
                            <h1 className="text-2xl font-bold tracking-tight">Edit {productName}</h1>
                            <p className="text-muted-foreground text-sm">
                                Manage the product detail page content for {productName}
                            </p>
                        </div>
                    </div>
                    <Button onClick={handleSubmit} disabled={processing}>
                        <Save className="h-4 w-4 mr-2" />
                        {processing ? 'Saving...' : 'Save Changes'}
                    </Button>
                </div>

                {/* Content */}
                <form onSubmit={handleSubmit} className="px-4 lg:px-6">
                    <Tabs value={activeTab} onValueChange={setActiveTab}>
                        <TabsList className="grid w-full grid-cols-4 mb-6">
                            <TabsTrigger value="basic">Basic Info</TabsTrigger>
                            <TabsTrigger value="pricing">Pricing</TabsTrigger>
                            <TabsTrigger value="specs">Specifications</TabsTrigger>
                            <TabsTrigger value="config">Configuration</TabsTrigger>
                        </TabsList>

                        {/* Basic Info Tab */}
                        <TabsContent value="basic">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Basic Information</CardTitle>
                                    <CardDescription>Product title, description, and hero image</CardDescription>
                                </CardHeader>
                                <CardContent className="space-y-4">
                                    <AdminTextInput
                                        label="Product Title"
                                        id="product_title"
                                        value={data.content.title || ''}
                                        onChange={(e) => setData('content', { ...data.content, title: e.target.value })}
                                        placeholder="মাসিক ম্যাগাজিন"
                                        required
                                    />
                                    <AdminTextInput
                                        label="Subtitle"
                                        id="subtitle"
                                        value={data.content.subtitle || ''}
                                        onChange={(e) => setData('content', { ...data.content, subtitle: e.target.value })}
                                        placeholder="Professional Monthly Magazine Printing"
                                    />
                                    <div>
                                        <Label htmlFor="description">Description</Label>
                                        <Textarea
                                            id="description"
                                            value={data.content.description || ''}
                                            onChange={(e) => setData('content', { ...data.content, description: e.target.value })}
                                            placeholder="Detailed product description..."
                                            rows={5}
                                        />
                                    </div>
                                    <AdminImageInput
                                        label="Hero Image"
                                        id="hero_image"
                                        value={data.content.hero_image}
                                        defaultImage={defaultImage}
                                        onChange={(file) => {
                                            if (typeof file === 'string') {
                                                setData('content', { ...data.content, hero_image: file });
                                            } else if (file instanceof File) {
                                                setData('content', { ...data.content, hero_image: file });
                                            }
                                        }}
                                        aspectRatio="16/9"
                                        helperText="Upload a hero image for the product detail page"
                                    />
                                </CardContent>
                            </Card>
                        </TabsContent>

                        {/* Pricing Tab */}
                        <TabsContent value="pricing">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Pricing Configuration</CardTitle>
                                    <CardDescription>Base price and quantity-based pricing tiers</CardDescription>
                                </CardHeader>
                                <CardContent className="space-y-6">
                                    <div className="grid gap-4 md:grid-cols-2">
                                        <AdminTextInput
                                            label="Base Price (৳)"
                                            id="base_price"
                                            type="number"
                                            value={data.content.base_price || 0}
                                            onChange={(e) => setData('content', { ...data.content, base_price: parseFloat(e.target.value) || 0 })}
                                            placeholder="0"
                                        />
                                        <AdminTextInput
                                            label="Minimum Quantity"
                                            id="min_quantity"
                                            type="number"
                                            value={data.content.min_quantity || 1}
                                            onChange={(e) => setData('content', { ...data.content, min_quantity: parseInt(e.target.value) || 1 })}
                                            placeholder="1"
                                        />
                                        <AdminTextInput
                                            label="Minimum Pages"
                                            id="min_pages"
                                            type="number"
                                            value={data.content.min_pages || 1}
                                            onChange={(e) => setData('content', { ...data.content, min_pages: parseInt(e.target.value) || 1 })}
                                            placeholder="1"
                                        />
                                        <AdminTextInput
                                            label="Maximum Pages"
                                            id="max_pages"
                                            type="number"
                                            value={data.content.max_pages || 500}
                                            onChange={(e) => setData('content', { ...data.content, max_pages: parseInt(e.target.value) || 500 })}
                                            placeholder="500"
                                        />
                                    </div>

                                    <div className="space-y-4">
                                        <div className="flex items-center justify-between">
                                            <Label>Pricing Tiers (Bulk Discounts)</Label>
                                            <Button type="button" variant="outline" size="sm" onClick={addPricingTier}>
                                                <Plus className="h-4 w-4 mr-1" />
                                                Add Tier
                                            </Button>
                                        </div>
                                        {(data.content.pricing_tiers || []).map((tier, index) => (
                                            <div key={index} className="border rounded-lg p-4">
                                                <div className="grid gap-4 md:grid-cols-4">
                                                    <AdminTextInput
                                                        label="Min Quantity"
                                                        id={`tier_min_qty_${index}`}
                                                        type="number"
                                                        value={tier.min_qty || 0}
                                                        onChange={(e) => updatePricingTier(index, 'min_qty', parseInt(e.target.value) || 0)}
                                                    />
                                                    <AdminTextInput
                                                        label="Max Quantity"
                                                        id={`tier_max_qty_${index}`}
                                                        type="number"
                                                        value={tier.max_qty || 0}
                                                        onChange={(e) => updatePricingTier(index, 'max_qty', parseInt(e.target.value) || 0)}
                                                    />
                                                    <AdminTextInput
                                                        label="Price per Unit (৳)"
                                                        id={`tier_price_${index}`}
                                                        type="number"
                                                        value={tier.price || 0}
                                                        onChange={(e) => updatePricingTier(index, 'price', parseFloat(e.target.value) || 0)}
                                                    />
                                                    <div className="flex items-end">
                                                        <Button
                                                            type="button"
                                                            variant="destructive"
                                                            size="sm"
                                                            onClick={() => removePricingTier(index)}
                                                            className="w-full"
                                                        >
                                                            <Trash2 className="h-4 w-4" />
                                                        </Button>
                                                    </div>
                                                </div>
                                            </div>
                                        ))}
                                        {(!data.content.pricing_tiers || data.content.pricing_tiers.length === 0) && (
                                            <p className="text-center text-muted-foreground py-4">
                                                No pricing tiers. Click "Add Tier" to create quantity-based discounts.
                                            </p>
                                        )}
                                    </div>
                                </CardContent>
                            </Card>
                        </TabsContent>

                        {/* Specifications Tab */}
                        <TabsContent value="specs">
                            <Card>
                                <CardHeader>
                                    <div className="flex items-center justify-between">
                                        <div>
                                            <CardTitle>Product Specifications</CardTitle>
                                            <CardDescription>Display product features and technical details</CardDescription>
                                        </div>
                                        <Button type="button" variant="outline" size="sm" onClick={addSpecification}>
                                            <Plus className="h-4 w-4 mr-1" />
                                            Add Specification
                                        </Button>
                                    </div>
                                </CardHeader>
                                <CardContent>
                                    <div className="space-y-4">
                                        {(data.content.specifications || []).map((spec, index) => (
                                            <div key={index} className="border rounded-lg p-4">
                                                <div className="grid gap-4 md:grid-cols-3">
                                                    <AdminTextInput
                                                        label="Label"
                                                        id={`spec_label_${index}`}
                                                        value={spec.label || ''}
                                                        onChange={(e) => updateSpecification(index, 'label', e.target.value)}
                                                        placeholder="Binding"
                                                    />
                                                    <AdminTextInput
                                                        label="Value"
                                                        id={`spec_value_${index}`}
                                                        value={spec.value || ''}
                                                        onChange={(e) => updateSpecification(index, 'value', e.target.value)}
                                                        placeholder="Perfect Bound"
                                                    />
                                                    <div className="flex items-end">
                                                        <Button
                                                            type="button"
                                                            variant="destructive"
                                                            size="sm"
                                                            onClick={() => removeSpecification(index)}
                                                            className="w-full"
                                                        >
                                                            <Trash2 className="h-4 w-4 mr-1" />
                                                            Remove
                                                        </Button>
                                                    </div>
                                                </div>
                                            </div>
                                        ))}
                                        {(!data.content.specifications || data.content.specifications.length === 0) && (
                                            <p className="text-center text-muted-foreground py-8">
                                                No specifications. Click "Add Specification" to add product details.
                                            </p>
                                        )}
                                    </div>
                                </CardContent>
                            </Card>
                        </TabsContent>

                        {/* Configuration Options Tab */}
                        <TabsContent value="config">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Configuration Options</CardTitle>
                                    <CardDescription>Customize the available options and their price impact (extra cost added to base price)</CardDescription>
                                </CardHeader>
                                <CardContent className="space-y-8">
                                    {[
                                        { key: 'sizes', label: 'Sizes' },
                                        { key: 'paper_types', label: 'Paper Types' },
                                        { key: 'finishes', label: 'Finishes' },
                                        { key: 'bindings', label: 'Bindings' },
                                        { key: 'orientations', label: 'Orientations' },
                                        { key: 'cover_papers', label: 'Cover Papers' },
                                        { key: 'coatings', label: 'Coatings' }
                                    ].map((group) => (
                                        <div key={group.key} className="space-y-4">
                                            <div className="flex items-center justify-between border-b pb-2">
                                                <Label className="text-lg font-semibold">{group.label}</Label>
                                                <Button
                                                    type="button"
                                                    variant="outline"
                                                    size="sm"
                                                    onClick={() => {
                                                        const newOptions = { ...data.content.config_options };
                                                        const currentList = Array.isArray(newOptions[group.key]) ? newOptions[group.key] : [];
                                                        // Handle migration from old string formatting if necessary, though we are overwriting
                                                        // If it was a list of strings, convert to objects
                                                        const formattedList = currentList.map(item =>
                                                            typeof item === 'string' ? { label: item, price: 0 } : item
                                                        );

                                                        newOptions[group.key] = [...formattedList, { label: '', price: 0 }];
                                                        setData('content', { ...data.content, config_options: newOptions });
                                                    }}
                                                >
                                                    <Plus className="h-4 w-4 mr-1" />
                                                    Add {group.label}
                                                </Button>
                                            </div>

                                            <div className="space-y-3">
                                                {Array.isArray(data.content.config_options?.[group.key]) && data.content.config_options[group.key].map((option, index) => {
                                                    // Ensure option is an object
                                                    const safeOption = typeof option === 'string' ? { label: option, price: 0 } : option;

                                                    return (
                                                        <div key={index} className="flex gap-4 items-end border p-3 rounded-md bg-slate-50">
                                                            <div className="flex-grow">
                                                                <Label className="text-xs mb-1.5 block">Name</Label>
                                                                <AdminTextInput
                                                                    value={safeOption.label}
                                                                    onChange={(e) => {
                                                                        const newOptions = { ...data.content.config_options };
                                                                        const list = [...newOptions[group.key]];
                                                                        // Normalize current item if needed
                                                                        const currentItem = typeof list[index] === 'string' ? { label: list[index], price: 0 } : { ...list[index] };
                                                                        currentItem.label = e.target.value;
                                                                        list[index] = currentItem;
                                                                        newOptions[group.key] = list;
                                                                        setData('content', { ...data.content, config_options: newOptions });
                                                                    }}
                                                                    placeholder={`e.g. ${group.key === 'sizes' ? 'A4' : group.key === 'paper_types' ? '80gsm' : 'Matte'}`}
                                                                    className="h-9"
                                                                />
                                                            </div>
                                                            <div className="w-32">
                                                                <Label className="text-xs mb-1.5 block">Extra Price (৳)</Label>
                                                                <AdminTextInput
                                                                    type="number"
                                                                    value={safeOption.price}
                                                                    onChange={(e) => {
                                                                        const newOptions = { ...data.content.config_options };
                                                                        const list = [...newOptions[group.key]];
                                                                        // Normalize current item
                                                                        const currentItem = typeof list[index] === 'string' ? { label: list[index], price: 0 } : { ...list[index] };
                                                                        currentItem.price = parseFloat(e.target.value) || 0;
                                                                        list[index] = currentItem;
                                                                        newOptions[group.key] = list;
                                                                        setData('content', { ...data.content, config_options: newOptions });
                                                                    }}
                                                                    placeholder="0"
                                                                    className="h-9"
                                                                />
                                                            </div>
                                                            <Button
                                                                type="button"
                                                                variant="ghost"
                                                                size="icon"
                                                                className="h-9 w-9 text-destructive hover:text-destructive hover:bg-destructive/10"
                                                                onClick={() => {
                                                                    const newOptions = { ...data.content.config_options };
                                                                    newOptions[group.key] = newOptions[group.key].filter((_, i) => i !== index);
                                                                    setData('content', { ...data.content, config_options: newOptions });
                                                                }}
                                                            >
                                                                <Trash2 className="h-4 w-4" />
                                                            </Button>
                                                        </div>
                                                    );
                                                })}
                                                {(!data.content.config_options?.[group.key] || data.content.config_options[group.key].length === 0) && (
                                                    <p className="text-sm text-muted-foreground italic">No options added yet.</p>
                                                )}
                                            </div>
                                        </div>
                                    ))}
                                </CardContent>
                            </Card>
                        </TabsContent>
                    </Tabs>
                </form>
            </div>
        </div>
    );
}

CategoryProductEdit.layout = (page) => <AdminLayout>{page}</AdminLayout>;
