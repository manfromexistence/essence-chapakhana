import { useState } from 'react';
import AdminLayout from '@/Layouts/AdminLayout';
import { useForm, Link, usePage, router } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { AdminTextInput } from '@/components/AdminTextInput';
import { AdminImageInput } from '@/components/AdminImageInput';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { Input } from '@/components/ui/input';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from '@/components/ui/accordion';
import { ArrowLeft, Save, Plus, Trash2, GripVertical, Pencil } from 'lucide-react';
import {
    DndContext,
    closestCenter,
    KeyboardSensor,
    PointerSensor,
    useSensor,
    useSensors,
} from '@dnd-kit/core';
import {
    arrayMove,
    SortableContext,
    sortableKeyboardCoordinates,
    useSortable,
    verticalListSortingStrategy,
} from '@dnd-kit/sortable';
import { CSS } from '@dnd-kit/utilities';

// Sortable Product Item Component
function SortableProductItem({ id, product, index, updateProduct, removeProduct, moveProduct, slug, extractProductSlug, totalProducts }) {
    const {
        attributes,
        listeners,
        setNodeRef,
        transform,
        transition,
        isDragging,
    } = useSortable({ id });

    const style = {
        transform: CSS.Transform.toString(transform),
        transition,
        opacity: isDragging ? 0.5 : 1,
    };

    return (
        <AccordionItem
            ref={setNodeRef}
            style={style}
            value={`product-${index}`}
            className="border rounded-lg px-4"
            data-product-index={index}
        >
            <AccordionTrigger>
                <div className="flex items-center gap-3">
                    <div
                        {...attributes}
                        {...listeners}
                        className="cursor-grab active:cursor-grabbing"
                    >
                        <GripVertical className="h-5 w-5 text-muted-foreground" />
                    </div>
                    <span>Product {index + 1}: {product.title || 'Untitled'}</span>
                    {product.badge && (
                        <span className="bg-red-100 text-red-700 text-xs px-2 py-0.5 rounded">
                            {product.badge}
                        </span>
                    )}
                </div>
            </AccordionTrigger>
            <AccordionContent className="space-y-4 pt-4">
                <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <AdminTextInput
                            label="Title"
                            id={`product-title-${index}`}
                            value={product.title || ''}
                            onChange={(e) => updateProduct(index, 'title', e.target.value)}
                            placeholder="পেপারব্যাক বই"
                        />
                    </div>
                    <div>
                        <AdminTextInput
                            label="URL"
                            id={`product-url-${index}`}
                            value={product.url || ''}
                            onChange={(e) => updateProduct(index, 'url', e.target.value)}
                            placeholder="/books/paperback"
                        />
                    </div>
                    <div>
                        <AdminTextInput
                            label="Price"
                            id={`product-price-${index}`}
                            value={product.price || ''}
                            onChange={(e) => updateProduct(index, 'price', e.target.value)}
                            placeholder="৩০০"
                        />
                    </div>
                    <div>
                        <AdminTextInput
                            label="Badge (Optional)"
                            id={`product-badge-${index}`}
                            value={product.badge || ''}
                            onChange={(e) => updateProduct(index, 'badge', e.target.value)}
                            placeholder="জনপ্রিয়"
                        />
                    </div>
                </div>
                <div>
                    <AdminImageInput
                        label="Product Image"
                        id={`product-img-${index}`}
                        value={product.img || ''}
                        onChange={(value) => updateProduct(index, 'img', typeof value === 'string' ? value : URL.createObjectURL(value))}
                        defaultImage={product.img}
                        aspectRatio="1/1"
                    />
                </div>
                <div className="flex justify-between pt-4 border-t">
                    <div className="flex gap-2">
                        <Button
                            type="button"
                            variant="outline"
                            size="sm"
                            onClick={() => moveProduct(index, 'up')}
                            disabled={index === 0}
                        >
                            ↑ Move Up
                        </Button>
                        <Button
                            type="button"
                            variant="outline"
                            size="sm"
                            onClick={() => moveProduct(index, 'down')}
                            disabled={index === totalProducts - 1}
                        >
                            ↓ Move Down
                        </Button>
                    </div>
                    <Button
                        type="button"
                        variant="destructive"
                        size="sm"
                        onClick={() => removeProduct(index)}
                    >
                        <Trash2 className="h-4 w-4 mr-1" />
                        Remove Product
                    </Button>
                </div>
            </AccordionContent>
        </AccordionItem>
    );
}


import { useTabsWithLocalStorage } from '@/hooks/useTabsWithLocalStorage';

export default function CategoryEditor({ section, slug, categoryName }) {
    const [activeTab, setActiveTab] = useTabsWithLocalStorage('admin-category-tab', 'basic');

    // Add unique IDs to products if they don't have them
    const addIdsToProducts = (products) => {
        return (products || []).map((product, index) => ({
            ...product,
            id: product.id || `product-${Date.now()}-${index}`
        }));
    };

    const initialContent = section?.content || {
        title: '',
        description: '',
        headline: '',
        short_description: '',
        grid_title: '',
        grid_subtitle: '',
        hero_slides: [],
        products: [],
        offer: {
            title: '',
            text: '',
            details: '',
            coupon_code: '',
        },
    };

    // Ensure products have IDs
    initialContent.products = addIdsToProducts(initialContent.products);

    const { data, setData, put, processing } = useForm({
        content: initialContent,
        title: section?.title || categoryName,
    });

    // Setup DnD sensors
    const sensors = useSensors(
        useSensor(PointerSensor),
        useSensor(KeyboardSensor, {
            coordinateGetter: sortableKeyboardCoordinates,
        })
    );

    // Handle drag end
    const handleDragEnd = (event) => {
        const { active, over } = event;

        if (active.id !== over.id) {
            const oldIndex = data.content.products.findIndex(
                (product) => product.id === active.id
            );
            const newIndex = data.content.products.findIndex(
                (product) => product.id === over.id
            );

            const newProducts = arrayMove(data.content.products, oldIndex, newIndex);
            setData('content', { ...data.content, products: newProducts });
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        put(`/admin/pages/category/${slug}`);
    };

    // Hero Slides handlers
    const addSlide = () => {
        const newSlides = [...(data.content.hero_slides || []), {
            title: '',
            description: '',
            image: '',
        }];
        setData('content', { ...data.content, hero_slides: newSlides });
    };

    const updateSlide = (index, field, value) => {
        const slides = [...data.content.hero_slides];
        slides[index] = { ...slides[index], [field]: value };
        setData('content', { ...data.content, hero_slides: slides });
    };

    const removeSlide = (index) => {
        const slides = data.content.hero_slides.filter((_, i) => i !== index);
        setData('content', { ...data.content, hero_slides: slides });
    };

    // Products handlers
    const addProduct = () => {
        const newProducts = [...(data.content.products || []), {
            id: `product-${Date.now()}`,
            title: '',
            url: '',
            img: '',
            price: '',
            badge: '',
        }];
        setData('content', { ...data.content, products: newProducts });
    };

    const updateProduct = (index, field, value) => {
        const products = [...data.content.products];
        products[index] = { ...products[index], [field]: value };
        setData('content', { ...data.content, products: products });
    };

    const removeProduct = (index) => {
        const products = data.content.products.filter((_, i) => i !== index);
        setData('content', { ...data.content, products: products });
    };

    const moveProduct = (index, direction) => {
        const products = [...data.content.products];
        const newIndex = direction === 'up' ? index - 1 : index + 1;
        if (newIndex < 0 || newIndex >= products.length) return;
        [products[index], products[newIndex]] = [products[newIndex], products[index]];
        setData('content', { ...data.content, products: products });
    };

    // Helper function to extract product slug from URL
    const extractProductSlug = (url) => {
        if (!url) return '';
        // Remove leading slash and extract the last part
        const parts = url.split('/').filter(p => p);
        return parts[parts.length - 1] || '';
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
                                <h1 className="text-2xl font-bold tracking-tight">Edit {categoryName}</h1>
                                <p className="text-muted-foreground text-sm">
                                    Manage content for the {categoryName.toLowerCase()} category page.
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
                                <TabsTrigger value="hero">Hero Slider</TabsTrigger>
                                <TabsTrigger value="products">Products Grid</TabsTrigger>
                                <TabsTrigger value="offer">Offer Banner</TabsTrigger>
                            </TabsList>

                            {/* Basic Info Tab */}
                            <TabsContent value="basic">
                                <Card>
                                    <CardHeader>
                                        <CardTitle>Basic Information</CardTitle>
                                        <CardDescription>Category title, description, and headlines</CardDescription>
                                    </CardHeader>
                                    <CardContent className="space-y-4">
                                        <div className="grid gap-4 md:grid-cols-2">
                                            <AdminTextInput
                                                label="Category Title"
                                                id="category_title"
                                                value={data.content.title || ''}
                                                onChange={(e) => setData('content', {
                                                    ...data.content,
                                                    title: e.target.value
                                                })}
                                                defaultValue={initialContent.title}
                                                maxLength={50}
                                                placeholder="বই"
                                            />
                                            <AdminTextInput
                                                label="Headline"
                                                id="headline"
                                                value={data.content.headline || ''}
                                                onChange={(e) => setData('content', {
                                                    ...data.content,
                                                    headline: e.target.value
                                                })}
                                                defaultValue={initialContent.headline}
                                                maxLength={100}
                                                placeholder="পেশাদার বই প্রিন্টিং সেবা"
                                            />
                                        </div>
                                        <div>
                                            <Label>Category Description</Label>
                                            <Textarea
                                                value={data.content.description || ''}
                                                onChange={(e) => setData('content', {
                                                    ...data.content,
                                                    description: e.target.value
                                                })}
                                                placeholder="Category description for SEO..."
                                                rows={3}
                                            />
                                        </div>
                                        <div>
                                            <Label>Short Description</Label>
                                            <Textarea
                                                value={data.content.short_description || ''}
                                                onChange={(e) => setData('content', {
                                                    ...data.content,
                                                    short_description: e.target.value
                                                })}
                                                placeholder="Short description shown below headline..."
                                                rows={3}
                                            />
                                        </div>
                                        <div className="grid gap-4 md:grid-cols-2">
                                            <AdminTextInput
                                                label="Grid Title"
                                                id="grid_title"
                                                value={data.content.grid_title || ''}
                                                onChange={(e) => setData('content', {
                                                    ...data.content,
                                                    grid_title: e.target.value
                                                })}
                                                defaultValue={initialContent.grid_title}
                                                maxLength={100}
                                                placeholder="বইয়ের ধরন নির্বাচন করুন"
                                            />
                                            <AdminTextInput
                                                label="Grid Subtitle"
                                                id="grid_subtitle"
                                                value={data.content.grid_subtitle || ''}
                                                onChange={(e) => setData('content', {
                                                    ...data.content,
                                                    grid_subtitle: e.target.value
                                                })}
                                                defaultValue={initialContent.grid_subtitle}
                                                maxLength={100}
                                                placeholder="আপনার প্রয়োজন অনুযায়ী সেরা অপশন"
                                            />
                                        </div>
                                    </CardContent>
                                </Card>
                            </TabsContent>

                            {/* Hero Slider Tab */}
                            <TabsContent value="hero">
                                <Card>
                                    <CardHeader>
                                        <div className="flex items-center justify-between">
                                            <div>
                                                <CardTitle>Hero Slider</CardTitle>
                                                <CardDescription>Banner slides for the category page</CardDescription>
                                            </div>
                                            <Button type="button" variant="outline" size="sm" onClick={addSlide}>
                                                <Plus className="h-4 w-4 mr-1" />
                                                Add Slide
                                            </Button>
                                        </div>
                                    </CardHeader>
                                    <CardContent>
                                        <Accordion type="single" collapsible className="space-y-2">
                                            {(data.content.hero_slides || []).map((slide, index) => (
                                                <AccordionItem key={index} value={`slide-${index}`} className="border rounded-lg px-4">
                                                    <AccordionTrigger>
                                                        <span>Slide {index + 1}: {slide.title || 'Untitled'}</span>
                                                    </AccordionTrigger>
                                                    <AccordionContent className="space-y-4 pt-4">
                                                        <AdminTextInput
                                                            label="Title"
                                                            id={`slide-title-${index}`}
                                                            value={slide.title}
                                                            onChange={(e) => updateSlide(index, 'title', e.target.value)}
                                                            maxLength={100}
                                                            placeholder="Slide title"
                                                        />
                                                        <div>
                                                            <Label>Description</Label>
                                                            <Textarea
                                                                value={slide.description}
                                                                onChange={(e) => updateSlide(index, 'description', e.target.value)}
                                                                placeholder="Slide description..."
                                                                rows={3}
                                                            />
                                                        </div>
                                                        <AdminImageInput
                                                            label="Slide Image"
                                                            id={`slide-image-${index}`}
                                                            value={slide.image}
                                                            onChange={(value) => updateSlide(index, 'image', typeof value === 'string' ? value : URL.createObjectURL(value))}
                                                            defaultImage={slide.image}
                                                            helperText="Upload image or provide URL"
                                                            aspectRatio="21/9"
                                                        />
                                                        <Button
                                                            type="button"
                                                            variant="destructive"
                                                            size="sm"
                                                            onClick={() => removeSlide(index)}
                                                        >
                                                            <Trash2 className="h-4 w-4 mr-1" />
                                                            Remove Slide
                                                        </Button>
                                                    </AccordionContent>
                                                </AccordionItem>
                                            ))}
                                        </Accordion>
                                        {(!data.content.hero_slides || data.content.hero_slides.length === 0) && (
                                            <p className="text-center text-muted-foreground py-8">
                                                No slides. Click "Add Slide" to add a hero slide.
                                            </p>
                                        )}
                                    </CardContent>
                                </Card>
                            </TabsContent>

                            {/* Products Grid Tab */}
                            <TabsContent value="products">
                                {/* Static Page Products Card */}
                                <Card>
                                    <CardHeader>
                                        <div className="flex items-center justify-between">
                                            <div>
                                                <CardTitle>Page Products</CardTitle>
                                                <CardDescription>Static products displayed on this category page. These are NOT shop products - manage shop products in the Shop Page section.</CardDescription>
                                            </div>
                                            <Button type="button" variant="outline" size="sm" onClick={addProduct}>
                                                <Plus className="h-4 w-4 mr-1" />
                                                Add Product
                                            </Button>
                                        </div>
                                    </CardHeader>
                                    <CardContent>
                                        {(!data.content.products || data.content.products.length === 0) ? (
                                            <p className="text-center text-muted-foreground py-8">
                                                No products. Click "Add Product" to add products to this category page.
                                            </p>
                                        ) : (
                                            <div className="space-y-4">
                                                {data.content.products.map((product, index) => (
                                                    <div key={index} className="border rounded-lg p-4">
                                                        <div className="flex gap-4">
                                                            <img
                                                                src={product.img || 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=150&h=150&fit=crop'}
                                                                alt={product.title || 'Product'}
                                                                className="w-20 h-20 rounded object-cover"
                                                            />
                                                            <div className="flex-1">
                                                                <div className="flex items-start justify-between">
                                                                    <div>
                                                                        <h4 className="font-semibold text-lg">{product.title || 'Untitled Product'}</h4>
                                                                        <p className="text-sm text-muted-foreground">{product.url || 'No URL'}</p>
                                                                        <div className="flex items-center gap-2 mt-1">
                                                                            <span className="font-medium text-primary">{product.price || '০'}</span>
                                                                            {product.badge && (
                                                                                <span className="bg-red-100 text-red-700 text-xs px-2 py-0.5 rounded">
                                                                                    {product.badge}
                                                                                </span>
                                                                            )}
                                                                        </div>
                                                                    </div>
                                                                    <div className="flex gap-2">
                                                                        <Link href={`/admin/pages/category/${slug}/product/${extractProductSlug(product.url)}/edit`}>
                                                                            <Button
                                                                                type="button"
                                                                                variant="default"
                                                                                size="sm"
                                                                            >
                                                                                <Pencil className="h-4 w-4 mr-1" />
                                                                                Edit Detail Page
                                                                            </Button>
                                                                        </Link>
                                                                        <Button
                                                                            type="button"
                                                                            variant="outline"
                                                                            size="sm"
                                                                            onClick={() => moveProduct(index, 'up')}
                                                                            disabled={index === 0}
                                                                        >
                                                                            ↑
                                                                        </Button>
                                                                        <Button
                                                                            type="button"
                                                                            variant="outline"
                                                                            size="sm"
                                                                            onClick={() => moveProduct(index, 'down')}
                                                                            disabled={index === (data.content.products?.length || 0) - 1}
                                                                        >
                                                                            ↓
                                                                        </Button>
                                                                        <Button
                                                                            type="button"
                                                                            variant="destructive"
                                                                            size="sm"
                                                                            onClick={() => removeProduct(index)}
                                                                        >
                                                                            <Trash2 className="h-4 w-4" />
                                                                        </Button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                ))}

                                                <div className="pt-6 border-t">
                                                    <h3 className="text-lg font-semibold mb-4">Edit Products</h3>
                                                    <DndContext
                                                        sensors={sensors}
                                                        collisionDetection={closestCenter}
                                                        onDragEnd={handleDragEnd}
                                                    >
                                                        <SortableContext
                                                            items={data.content.products.map((product) => product.id)}
                                                            strategy={verticalListSortingStrategy}
                                                        >
                                                            <Accordion type="single" collapsible className="space-y-2">
                                                                {(data.content.products || []).map((product, index) => (
                                                                    <SortableProductItem
                                                                        key={product.id}
                                                                        id={product.id}
                                                                        product={product}
                                                                        index={index}
                                                                        updateProduct={updateProduct}
                                                                        removeProduct={removeProduct}
                                                                        moveProduct={moveProduct}
                                                                        slug={slug}
                                                                        extractProductSlug={extractProductSlug}
                                                                        totalProducts={data.content.products?.length || 0}
                                                                    />
                                                                ))}
                                                            </Accordion>
                                                        </SortableContext>
                                                    </DndContext>
                                                </div>
                                            </div>
                                        )}
                                    </CardContent>
                                </Card>
                            </TabsContent>

                            {/* Offer Banner Tab */}
                            <TabsContent value="offer">
                                <Card>
                                    <CardHeader>
                                        <CardTitle>Offer Banner</CardTitle>
                                        <CardDescription>Promotional banner for this category</CardDescription>
                                    </CardHeader>
                                    <CardContent className="space-y-4">
                                        <div className="grid gap-4 md:grid-cols-2">
                                            <AdminTextInput
                                                label="Offer Title"
                                                id="offer_title"
                                                value={data.content.offer?.title || ''}
                                                onChange={(e) => setData('content', {
                                                    ...data.content,
                                                    offer: { ...data.content.offer, title: e.target.value }
                                                })}
                                                defaultValue={initialContent.offer?.title}
                                                maxLength={100}
                                                placeholder="📚 বই প্রিন্টিং এ মেগা অফার 📚"
                                            />
                                            <AdminTextInput
                                                label="Offer Text"
                                                id="offer_text"
                                                value={data.content.offer?.text || ''}
                                                onChange={(e) => setData('content', {
                                                    ...data.content,
                                                    offer: { ...data.content.offer, text: e.target.value }
                                                })}
                                                defaultValue={initialContent.offer?.text}
                                                maxLength={100}
                                                placeholder="৫০+ বই অর্ডারে পাচ্ছেন ২৫% ছাড়!"
                                            />
                                        </div>
                                        <div>
                                            <Label>Offer Details</Label>
                                            <Textarea
                                                value={data.content.offer?.details || ''}
                                                onChange={(e) => setData('content', {
                                                    ...data.content,
                                                    offer: { ...data.content.offer, details: e.target.value }
                                                })}
                                                placeholder="Detailed offer description..."
                                                rows={3}
                                            />
                                        </div>
                                        <AdminTextInput
                                            label="Coupon Code"
                                            id="coupon_code"
                                            value={data.content.offer?.coupon_code || ''}
                                            onChange={(e) => setData('content', {
                                                ...data.content,
                                                offer: { ...data.content.offer, coupon_code: e.target.value }
                                            })}
                                            defaultValue={initialContent.offer?.coupon_code}
                                            maxLength={20}
                                            placeholder="FIRST25"
                                        />
                                    </CardContent>
                                </Card>
                            </TabsContent>
                        </Tabs>
                    </form>
                </div>
            </div>
        </>
    );
}

CategoryEditor.layout = (page) => <AdminLayout>{page}</AdminLayout>;
