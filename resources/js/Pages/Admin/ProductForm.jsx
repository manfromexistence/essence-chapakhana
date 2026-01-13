import AdminLayout from '@/Layouts/AdminLayout';
import { useState } from 'react';
import { Link, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { AdminTextInput } from '@/components/AdminTextInput';
import { AdminImageInput } from '@/components/AdminImageInput';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { Checkbox } from '@/components/ui/checkbox';
import { Badge } from '@/components/ui/badge';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import { Save, Plus, Trash2 } from 'lucide-react';
import { useTabsWithLocalStorage } from '@/hooks/useTabsWithLocalStorage';

export default function ProductForm({ product, categories, isEdit = false, configOptions = {} }) {
    const [activeTab, setActiveTab] = useTabsWithLocalStorage('admin-product-form-tab', 'basic');

    const { data, setData, post, processing, errors } = useForm({
        _method: isEdit ? 'PUT' : undefined,
        category_id: product?.category_id || '',
        title: product?.title || '',
        description: product?.description || '',
        format: product?.format || '',
        price: product?.price || '',
        base_price: product?.base_price || '',
        min_quantity: product?.min_quantity || 1,
        min_pages: product?.min_pages || '',
        max_pages: product?.max_pages || '',
        rating: product?.rating || 0,
        popularity: product?.popularity || 0,
        stock: product?.stock ?? true,
        badge: product?.badge || '',
        image: null,
        is_active: product?.is_active ?? true,
        config_options: product?.config_options || {
            bindings: [],
            sizes: [],
            orientations: [],
            paperTypes: [],
            coverPaperTypes: [],
            coatings: [],
            finishes: [],
        },
    });

    const handleSubmit = (e) => {
        e.preventDefault();

        if (isEdit) {
            post(`/admin/products/${product.slug}`, {
                forceFormData: true,
            });
        } else {
            post('/admin/products', {
                forceFormData: true,
            });
        }
    };

    // Helper to toggle config option
    const toggleConfigOption = (category, option) => {
        const currentOptions = data.config_options[category] || [];
        const exists = currentOptions.find(o => o.value === option.value);

        let newOptions;
        if (exists) {
            newOptions = currentOptions.filter(o => o.value !== option.value);
        } else {
            newOptions = [...currentOptions, { ...option }];
        }

        setData('config_options', {
            ...data.config_options,
            [category]: newOptions
        });
    };

    // Check if option is selected
    const isOptionSelected = (category, optionValue) => {
        return (data.config_options[category] || []).some(o => o.value === optionValue);
    };

    // Update option price
    const updateOptionPrice = (category, optionValue, newPrice) => {
        const currentOptions = data.config_options[category] || [];
        const updatedOptions = currentOptions.map(o =>
            o.value === optionValue ? { ...o, price: parseFloat(newPrice) || 0 } : o
        );
        setData('config_options', {
            ...data.config_options,
            [category]: updatedOptions
        });
    };

    // Get selected option price
    const getSelectedPrice = (category, optionValue) => {
        const option = (data.config_options[category] || []).find(o => o.value === optionValue);
        return option?.price ?? '';
    };

    // Add custom option
    const addCustomOption = (category, label, price) => {
        if (!label) return;
        const value = label.toLowerCase().replace(/[^a-z0-9]+/g, '-');
        const newOption = { value, label, price: parseFloat(price) || 0 };

        const currentOptions = data.config_options[category] || [];
        // Prevent duplicates by value
        if (currentOptions.some(o => o.value === value)) return;

        setData('config_options', {
            ...data.config_options,
            [category]: [...currentOptions, newOption]
        });
    };

    // Render config options section
    const renderConfigSection = (title, description, categoryKey, availableOptions) => {
        // Merge available defaults with any custom saved options to ensure all are visible
        const savedOptions = data.config_options[categoryKey] || [];
        const savedValues = new Set(savedOptions.map(o => o.value));

        // Start with defaults
        const allOptionsMap = new Map();
        (availableOptions || []).forEach(opt => allOptionsMap.set(opt.value, { ...opt, isCustom: false }));

        // Add saved options (overriding defaults if they exist, or adding as new)
        savedOptions.forEach(opt => {
            if (allOptionsMap.has(opt.value)) {
                // Keep the default metadata but use saved price/selection state logic via isOptionSelected relative to data
            } else {
                allOptionsMap.set(opt.value, { ...opt, isCustom: true });
            }
        });

        const displayOptions = Array.from(allOptionsMap.values());
        const [newLabel, setNewLabel] = useState('');
        const [newPrice, setNewPrice] = useState('');

        return (
            <Card className="mb-4">
                <CardHeader className="pb-3">
                    <CardTitle className="text-lg">{title}</CardTitle>
                    <CardDescription>{description}</CardDescription>
                </CardHeader>
                <CardContent>
                    <div className="rounded-md border">
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead className="w-12">Enable</TableHead>
                                    <TableHead>Option</TableHead>
                                    <TableHead className="w-32">Default Price</TableHead>
                                    <TableHead className="w-32">Your Price (৳)</TableHead>
                                    <TableHead className="w-12"></TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {displayOptions.map((option) => (
                                    <TableRow key={option.value}>
                                        <TableCell>
                                            <Checkbox
                                                checked={isOptionSelected(categoryKey, option.value)}
                                                onCheckedChange={() => toggleConfigOption(categoryKey, option)}
                                            />
                                        </TableCell>
                                        <TableCell className="font-medium">
                                            {option.label}
                                            {option.isCustom && <Badge variant="outline" className="ml-2 text-xs">Custom</Badge>}
                                        </TableCell>
                                        <TableCell className="text-muted-foreground">
                                            ৳{option.price.toFixed(2)}
                                        </TableCell>
                                        <TableCell>
                                            {isOptionSelected(categoryKey, option.value) && (
                                                <input
                                                    type="number"
                                                    step="0.01"
                                                    min="0"
                                                    value={getSelectedPrice(categoryKey, option.value)}
                                                    onChange={(e) => updateOptionPrice(categoryKey, option.value, e.target.value)}
                                                    className="w-full px-2 py-1 border rounded text-sm"
                                                    placeholder="0.00"
                                                />
                                            )}
                                        </TableCell>
                                        <TableCell>
                                            {option.isCustom && (
                                                <Button
                                                    variant="ghost"
                                                    size="icon"
                                                    onClick={() => toggleConfigOption(categoryKey, option)}
                                                    className="text-red-500 hover:text-red-700 h-8 w-8"
                                                >
                                                    <Trash2 className="h-4 w-4" />
                                                </Button>
                                            )}
                                        </TableCell>
                                    </TableRow>
                                ))}
                                {/* Add New Option Row */}
                                <TableRow className="bg-muted/30">
                                    <TableCell colSpan={2}>
                                        <input
                                            type="text"
                                            value={newLabel}
                                            onChange={(e) => setNewLabel(e.target.value)}
                                            placeholder="New Option Label"
                                            className="w-full px-2 py-1 border rounded text-sm bg-background"
                                        />
                                    </TableCell>
                                    <TableCell>
                                        <input
                                            type="number"
                                            value={newPrice}
                                            onChange={(e) => setNewPrice(e.target.value)}
                                            placeholder="Price"
                                            className="w-full px-2 py-1 border rounded text-sm bg-background"
                                        />
                                    </TableCell>
                                    <TableCell colSpan={2}>
                                        <Button
                                            size="sm"
                                            variant="secondary"
                                            disabled={!newLabel}
                                            onClick={() => {
                                                addCustomOption(categoryKey, newLabel, newPrice);
                                                setNewLabel('');
                                                setNewPrice('');
                                            }}
                                            className="w-full"
                                        >
                                            <Plus className="h-3 w-3 mr-1" /> Add
                                        </Button>
                                    </TableCell>
                                </TableRow>
                            </TableBody>
                        </Table>
                    </div>
                    {(data.config_options[categoryKey] || []).length > 0 && (
                        <div className="mt-2 flex flex-wrap gap-1">
                            {(data.config_options[categoryKey] || []).map((opt) => (
                                <Badge key={opt.value} variant="secondary">
                                    {opt.label}: ৳{opt.price.toFixed(2)}
                                </Badge>
                            ))}
                        </div>
                    )}
                </CardContent>
            </Card>
        );
    };

    return (
        <div className="space-y-6">
            <div className="flex items-center justify-between">
                <div>
                    <h1 className="text-3xl font-bold">
                        {isEdit ? 'Edit Product' : 'Create Product'}
                    </h1>
                    <p className="text-muted-foreground">
                        {isEdit ? 'Update product details and configuration' : 'Add a new product with pricing configuration'}
                    </p>
                </div>
                <Button onClick={handleSubmit} disabled={processing}>
                    <Save className="h-4 w-4 mr-2" />
                    {processing ? 'Saving...' : (isEdit ? 'Update Product' : 'Create Product')}
                </Button>
            </div>

            <form onSubmit={handleSubmit}>
                <Tabs value={activeTab} onValueChange={setActiveTab}>
                    <TabsList className="grid w-full grid-cols-4 mb-6">
                        <TabsTrigger value="basic">Basic Info</TabsTrigger>
                        <TabsTrigger value="pricing">Pricing & Pages</TabsTrigger>
                        <TabsTrigger value="binding">Binding & Size</TabsTrigger>
                        <TabsTrigger value="paper">Paper & Finish</TabsTrigger>
                    </TabsList>

                    {/* Basic Info Tab */}
                    <TabsContent value="basic">
                        <Card>
                            <CardHeader>
                                <CardTitle>Product Information</CardTitle>
                                <CardDescription>Basic product details and appearance</CardDescription>
                            </CardHeader>
                            <CardContent className="space-y-6">
                                <div className="grid grid-cols-2 gap-6">
                                    <AdminTextInput
                                        label="Product Title"
                                        id="title"
                                        value={data.title}
                                        onChange={(e) => setData('title', e.target.value)}
                                        defaultValue={product?.title}
                                        minLength={3}
                                        maxLength={100}
                                        required
                                        error={errors.title}
                                        placeholder="Enter product title"
                                    />

                                    <div className="space-y-2">
                                        <Label htmlFor="category_id">Category *</Label>
                                        <Select
                                            value={data.category_id.toString()}
                                            onValueChange={(value) =>
                                                setData('category_id', parseInt(value))
                                            }
                                        >
                                            <SelectTrigger>
                                                <SelectValue placeholder="Select category" />
                                            </SelectTrigger>
                                            <SelectContent>
                                                {categories.map((category) => (
                                                    <SelectItem
                                                        key={category.id}
                                                        value={category.id.toString()}
                                                    >
                                                        {category.name}
                                                    </SelectItem>
                                                ))}
                                            </SelectContent>
                                        </Select>
                                        {errors.category_id && (
                                            <p className="text-sm text-red-600">
                                                {errors.category_id}
                                            </p>
                                        )}
                                    </div>
                                </div>

                                <div className="space-y-2">
                                    <Label htmlFor="description">Description *</Label>
                                    <Textarea
                                        id="description"
                                        value={data.description}
                                        onChange={(e) => setData('description', e.target.value)}
                                        placeholder="Enter detailed product description"
                                        rows={4}
                                    />
                                    {errors.description && (
                                        <p className="text-sm text-red-600">{errors.description}</p>
                                    )}
                                </div>

                                <div className="grid grid-cols-2 gap-6">
                                    <AdminTextInput
                                        label="Format"
                                        id="format"
                                        value={data.format}
                                        onChange={(e) => setData('format', e.target.value)}
                                        defaultValue={product?.format}
                                        maxLength={50}
                                        required
                                        error={errors.format}
                                        placeholder="e.g., Paperback, Hardcover"
                                    />

                                    <AdminTextInput
                                        label="Badge (Optional)"
                                        id="badge"
                                        value={data.badge}
                                        onChange={(e) => setData('badge', e.target.value)}
                                        defaultValue={product?.badge}
                                        maxLength={20}
                                        error={errors.badge}
                                        placeholder="e.g., NEW, HOT, SALE"
                                    />
                                </div>

                                <div className="grid grid-cols-2 gap-6">
                                    <AdminImageInput
                                        label="Product Image"
                                        id="image"
                                        value={data.image}
                                        onChange={(file) => setData('image', file)}
                                        defaultImage={product?.image}
                                        required={!isEdit}
                                        error={errors.image}
                                        helperText="Upload product image (max 5MB)"
                                        aspectRatio="16/9"
                                    />

                                    <div className="space-y-4">
                                        <div className="flex items-center space-x-2">
                                            <Checkbox
                                                id="stock"
                                                checked={data.stock}
                                                onCheckedChange={(checked) => setData('stock', checked)}
                                            />
                                            <Label htmlFor="stock">In Stock</Label>
                                        </div>

                                        <div className="flex items-center space-x-2">
                                            <Checkbox
                                                id="is_active"
                                                checked={data.is_active}
                                                onCheckedChange={(checked) => setData('is_active', checked)}
                                            />
                                            <Label htmlFor="is_active">Active (Visible on website)</Label>
                                        </div>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    </TabsContent>

                    {/* Pricing & Pages Tab */}
                    <TabsContent value="pricing">
                        <Card>
                            <CardHeader>
                                <CardTitle>Pricing & Page Configuration</CardTitle>
                                <CardDescription>Set base price and page limits for this product</CardDescription>
                            </CardHeader>
                            <CardContent className="space-y-6">
                                <div className="grid grid-cols-3 gap-6">
                                    <AdminTextInput
                                        label="Base Price (৳)"
                                        id="price"
                                        type="number"
                                        value={data.price}
                                        onChange={(e) => setData('price', e.target.value)}
                                        defaultValue={product?.price}
                                        required
                                        error={errors.price}
                                        placeholder="0.00"
                                        helperText="Starting price for the product"
                                    />

                                    <AdminTextInput
                                        label="Per Page Price (৳)"
                                        id="base_price"
                                        type="number"
                                        value={data.base_price}
                                        onChange={(e) => setData('base_price', e.target.value)}
                                        defaultValue={product?.base_price}
                                        error={errors.base_price}
                                        placeholder="0.00"
                                        helperText="Additional price per page"
                                    />

                                    <AdminTextInput
                                        label="Minimum Quantity"
                                        id="min_quantity"
                                        type="number"
                                        value={data.min_quantity}
                                        onChange={(e) => setData('min_quantity', e.target.value)}
                                        defaultValue={product?.min_quantity || 1}
                                        error={errors.min_quantity}
                                        placeholder="1"
                                        helperText="Minimum order quantity"
                                    />
                                </div>

                                <div className="grid grid-cols-2 gap-6">
                                    <AdminTextInput
                                        label="Minimum Pages"
                                        id="min_pages"
                                        type="number"
                                        value={data.min_pages}
                                        onChange={(e) => setData('min_pages', e.target.value)}
                                        defaultValue={product?.min_pages}
                                        error={errors.min_pages}
                                        placeholder="8"
                                        helperText="Minimum number of pages allowed"
                                    />

                                    <AdminTextInput
                                        label="Maximum Pages"
                                        id="max_pages"
                                        type="number"
                                        value={data.max_pages}
                                        onChange={(e) => setData('max_pages', e.target.value)}
                                        defaultValue={product?.max_pages}
                                        error={errors.max_pages}
                                        placeholder="500"
                                        helperText="Maximum number of pages allowed"
                                    />
                                </div>

                                <div className="grid grid-cols-2 gap-6">
                                    <AdminTextInput
                                        label="Rating (0-5)"
                                        id="rating"
                                        type="number"
                                        step="0.1"
                                        value={data.rating}
                                        onChange={(e) => setData('rating', e.target.value)}
                                        defaultValue={product?.rating}
                                        error={errors.rating}
                                        placeholder="0.0"
                                    />

                                    <AdminTextInput
                                        label="Popularity (0-100)"
                                        id="popularity"
                                        type="number"
                                        value={data.popularity}
                                        onChange={(e) => setData('popularity', e.target.value)}
                                        defaultValue={product?.popularity}
                                        error={errors.popularity}
                                        placeholder="0"
                                    />
                                </div>
                            </CardContent>
                        </Card>
                    </TabsContent>

                    {/* Binding & Size Tab */}
                    <TabsContent value="binding">
                        <div className="space-y-4">
                            {renderConfigSection(
                                'Binding Options',
                                'Select available binding types and set custom prices',
                                'bindings',
                                configOptions.bindings
                            )}

                            {renderConfigSection(
                                'Size Options',
                                'Select available sizes and set custom prices',
                                'sizes',
                                configOptions.sizes
                            )}

                            {renderConfigSection(
                                'Orientation',
                                'Select available orientations',
                                'orientations',
                                configOptions.orientations
                            )}
                        </div>
                    </TabsContent>

                    {/* Paper & Finish Tab */}
                    <TabsContent value="paper">
                        <div className="space-y-4">
                            {renderConfigSection(
                                'Paper Types (Interior)',
                                'Select available paper types for interior pages',
                                'paperTypes',
                                configOptions.paperTypes
                            )}

                            {renderConfigSection(
                                'Cover Paper Types',
                                'Select available paper types for covers',
                                'coverPaperTypes',
                                configOptions.coverPaperTypes
                            )}

                            {renderConfigSection(
                                'Coating Options',
                                'Select available coating options',
                                'coatings',
                                configOptions.coatings
                            )}

                            {renderConfigSection(
                                'Finish Options',
                                'Select available finish options (spot UV, foil, etc.)',
                                'finishes',
                                configOptions.finishes
                            )}
                        </div>
                    </TabsContent>
                </Tabs>

                <div className="flex justify-end gap-4 mt-6">
                    <Link href="/admin/products">
                        <Button type="button" variant="outline">
                            Cancel
                        </Button>
                    </Link>
                    <Button type="submit" disabled={processing}>
                        <Save className="h-4 w-4 mr-2" />
                        {processing
                            ? isEdit
                                ? 'Updating...'
                                : 'Creating...'
                            : isEdit
                                ? 'Update Product'
                                : 'Create Product'}
                    </Button>
                </div>
            </form>
        </div>
    );
}

ProductForm.layout = (page) => <AdminLayout>{page}</AdminLayout>
