import { useState } from 'react';
import AdminLayout from '@/Layouts/AdminLayout';
import { useForm, Link } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { AdminTextInput } from '@/components/AdminTextInput';
import { AdminImageInput } from '@/components/AdminImageInput';
import { AdminVideoInput } from '@/components/AdminVideoInput';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from '@/components/ui/accordion';
import { Input } from '@/components/ui/input';
import { ArrowLeft, Save, Plus, Trash2, Image } from 'lucide-react';

import { useTabsWithLocalStorage } from '@/hooks/useTabsWithLocalStorage';

export default function HomePageEditor({ sections }) {
    const [activeTab, setActiveTab] = useTabsWithLocalStorage('admin-home-tab', 'hero');

    // Convert sections to form data
    const initialData = {
        sections: {
            hero_slider: {
                content: sections?.hero_slider?.content || { slides: [], stats: {} },
                title: sections?.hero_slider?.title || 'Hero Slider'
            },
            headline: {
                content: sections?.headline?.content || { title: '', description: '' },
                title: sections?.headline?.title || 'Headline'
            },
            how_to_order: {
                content: sections?.how_to_order?.content || { title: '', steps: [], video_url: '' },
                title: sections?.how_to_order?.title || 'How To Order'
            },
            best_sellers: {
                content: sections?.best_sellers?.content || { title: '', products: [] },
                title: sections?.best_sellers?.title || 'Best Sellers'
            },
            testimonials: {
                content: sections?.testimonials?.content || { title: '', subtitle: '', items: [] },
                title: sections?.testimonials?.title || 'Testimonials'
            },
            offer_banner: {
                content: sections?.offer_banner?.content || { title: '', subtitle: '', description: '', cta_text: '', cta_url: '' },
                title: sections?.offer_banner?.title || 'Offer Banner'
            },
            trust_section: {
                content: sections?.trust_section?.content || { title: '', subtitle: '', brands: [] },
                title: sections?.trust_section?.title || 'Trust Section'
            },
        }
    };

    const { data, setData, post, processing, errors } = useForm(initialData);

    const updateSection = (sectionKey, content) => {
        setData('sections', {
            ...data.sections,
            [sectionKey]: { content, title: sectionKey.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase()) }
        });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        // Use post with _method for file uploads (Inertia limitation with PUT)
        post('/admin/pages/home', {
            forceFormData: true,
            _method: 'PUT'
        });
    };

    // Hero Slider handlers
    const addSlide = () => {
        const newSlides = [...(data.sections.hero_slider.content.slides || []), {
            title: '',
            subtitle: '',
            image: '',
            cta_text: '',
            cta_url: '',
        }];
        updateSection('hero_slider', { ...data.sections.hero_slider.content, slides: newSlides });
    };

    const updateSlide = (index, field, value) => {
        const slides = [...data.sections.hero_slider.content.slides];
        slides[index] = { ...slides[index], [field]: value };
        updateSection('hero_slider', { ...data.sections.hero_slider.content, slides });
    };

    const removeSlide = (index) => {
        const slides = data.sections.hero_slider.content.slides.filter((_, i) => i !== index);
        updateSection('hero_slider', { ...data.sections.hero_slider.content, slides });
    };

    // Testimonials handlers
    const addTestimonial = () => {
        const newItems = [...(data.sections.testimonials.content.items || []), {
            text: '',
            author: '',
            designation: '',
            avatar_initial: '',
            avatar_color: 'green',
            rating: 5,
        }];
        updateSection('testimonials', { ...data.sections.testimonials.content, items: newItems });
    };

    const updateTestimonial = (index, field, value) => {
        const items = [...data.sections.testimonials.content.items];
        items[index] = { ...items[index], [field]: value };
        updateSection('testimonials', { ...data.sections.testimonials.content, items });
    };

    const removeTestimonial = (index) => {
        const items = data.sections.testimonials.content.items.filter((_, i) => i !== index);
        updateSection('testimonials', { ...data.sections.testimonials.content, items });
    };

    // Best Sellers handlers
    const addProduct = () => {
        const newProducts = [...(data.sections.best_sellers.content.products || []), {
            title: '',
            url: '',
            image: '',
        }];
        updateSection('best_sellers', { ...data.sections.best_sellers.content, products: newProducts });
    };

    const updateProduct = (index, field, value) => {
        const products = [...data.sections.best_sellers.content.products];
        products[index] = { ...products[index], [field]: value };
        updateSection('best_sellers', { ...data.sections.best_sellers.content, products });
    };

    const removeProduct = (index) => {
        const products = data.sections.best_sellers.content.products.filter((_, i) => i !== index);
        updateSection('best_sellers', { ...data.sections.best_sellers.content, products });
    };

    // Trust Section handlers
    const addBrand = () => {
        const currentContent = data.sections.trust_section.content || { title: '', subtitle: '', brands: [] };
        const newBrands = [...(currentContent.brands || []), {
            name: '',
            logo: '',
        }];
        updateSection('trust_section', { ...currentContent, brands: newBrands });
    };

    const updateBrand = (index, field, value) => {
        const currentContent = data.sections.trust_section.content || { title: '', subtitle: '', brands: [] };
        const brands = [...(currentContent.brands || [])];
        brands[index] = { ...brands[index], [field]: value };
        updateSection('trust_section', { ...currentContent, brands });
    };

    const removeBrand = (index) => {
        const currentContent = data.sections.trust_section.content || { title: '', subtitle: '', brands: [] };
        const brands = (currentContent.brands || []).filter((_, i) => i !== index);
        updateSection('trust_section', { ...currentContent, brands });
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
                                <h1 className="text-2xl font-bold tracking-tight">Edit Home Page</h1>
                                <p className="text-muted-foreground text-sm">
                                    Manage all sections of the home page.
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
                            <TabsList className="grid w-full grid-cols-4 lg:grid-cols-7 mb-6">
                                <TabsTrigger value="hero">Hero</TabsTrigger>
                                <TabsTrigger value="headline">Headline</TabsTrigger>
                                <TabsTrigger value="how_to_order">How to Order</TabsTrigger>
                                <TabsTrigger value="best_sellers">Best Sellers</TabsTrigger>
                                <TabsTrigger value="testimonials">Testimonials</TabsTrigger>
                                <TabsTrigger value="offer">Offer Banner</TabsTrigger>
                                <TabsTrigger value="trust">Trust Section</TabsTrigger>
                            </TabsList>

                            {/* Hero Slider Tab */}
                            <TabsContent value="hero">
                                <Card>
                                    <CardHeader>
                                        <CardTitle>Hero Slider</CardTitle>
                                        <CardDescription>Manage the main hero slider on the home page</CardDescription>
                                    </CardHeader>
                                    <CardContent className="space-y-6">
                                        {/* Stats */}
                                        <div className="grid gap-4 md:grid-cols-3">
                                            <AdminTextInput
                                                label="Percentage"
                                                id="stats_percentage"
                                                value={data.sections.hero_slider.content.stats?.percentage || ''}
                                                onChange={(e) => updateSection('hero_slider', {
                                                    ...data.sections.hero_slider.content,
                                                    stats: { ...data.sections.hero_slider.content.stats, percentage: e.target.value }
                                                })}
                                                maxLength={10}
                                                placeholder="93"
                                                showCharCount={false}
                                            />
                                            <AdminTextInput
                                                label="Label"
                                                id="stats_label"
                                                value={data.sections.hero_slider.content.stats?.label || ''}
                                                onChange={(e) => updateSection('hero_slider', {
                                                    ...data.sections.hero_slider.content,
                                                    stats: { ...data.sections.hero_slider.content.stats, label: e.target.value }
                                                })}
                                                maxLength={100}
                                                placeholder="of our customers would buy again"
                                                showCharCount={false}
                                            />
                                            <AdminTextInput
                                                label="Reviews Count"
                                                id="stats_reviews"
                                                value={data.sections.hero_slider.content.stats?.reviews_count || ''}
                                                onChange={(e) => updateSection('hero_slider', {
                                                    ...data.sections.hero_slider.content,
                                                    stats: { ...data.sections.hero_slider.content.stats, reviews_count: e.target.value }
                                                })}
                                                maxLength={20}
                                                placeholder="256,839"
                                                showCharCount={false}
                                            />
                                        </div>

                                        {/* Slides */}
                                        <div>
                                            <div className="flex items-center justify-between mb-4">
                                                <Label className="text-lg">Slides</Label>
                                                <Button type="button" variant="outline" size="sm" onClick={addSlide}>
                                                    <Plus className="h-4 w-4 mr-1" />
                                                    Add Slide
                                                </Button>
                                            </div>
                                            <Accordion type="single" collapsible className="space-y-2">
                                                {(data.sections.hero_slider.content.slides || []).map((slide, index) => (
                                                    <AccordionItem key={index} value={`slide-${index}`} className="border rounded-lg px-4">
                                                        <AccordionTrigger>
                                                            <span>Slide {index + 1}: {slide.title || 'Untitled'}</span>
                                                        </AccordionTrigger>
                                                        <AccordionContent className="space-y-4 pt-4">
                                                            <div className="grid gap-4 md:grid-cols-2">
                                                                <AdminTextInput
                                                                    label="Title"
                                                                    id={`slide-title-${index}`}
                                                                    value={slide.title}
                                                                    onChange={(e) => updateSlide(index, 'title', e.target.value)}
                                                                    maxLength={100}
                                                                    placeholder="Slide title"
                                                                    showCharCount={false}
                                                                />
                                                                <AdminTextInput
                                                                    label="Subtitle"
                                                                    id={`slide-subtitle-${index}`}
                                                                    value={slide.subtitle}
                                                                    onChange={(e) => updateSlide(index, 'subtitle', e.target.value)}
                                                                    maxLength={150}
                                                                    placeholder="Slide subtitle"
                                                                    showCharCount={false}
                                                                />
                                                            </div>
                                                            <AdminImageInput
                                                                label="Slide Image"
                                                                id={`slide-image-${index}`}
                                                                value={slide.image}
                                                                onChange={(value) => updateSlide(index, 'image', value)}
                                                                defaultImage={slide.image}
                                                                aspectRatio="21/9"
                                                                helperText="Upload hero slide image"
                                                            />
                                                            <div className="grid gap-4 md:grid-cols-2">
                                                                <AdminTextInput
                                                                    label="CTA Text"
                                                                    id={`slide-cta-text-${index}`}
                                                                    value={slide.cta_text}
                                                                    onChange={(e) => updateSlide(index, 'cta_text', e.target.value)}
                                                                    maxLength={30}
                                                                    placeholder="Button text"
                                                                    showCharCount={false}
                                                                />
                                                                <AdminTextInput
                                                                    label="CTA URL"
                                                                    id={`slide-cta-url-${index}`}
                                                                    value={slide.cta_url}
                                                                    onChange={(e) => updateSlide(index, 'cta_url', e.target.value)}
                                                                    maxLength={100}
                                                                    placeholder="/contact"
                                                                    showCharCount={false}
                                                                />
                                                            </div>
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
                                        </div>
                                    </CardContent>
                                </Card>
                            </TabsContent>

                            {/* Headline Tab */}
                            <TabsContent value="headline">
                                <Card>
                                    <CardHeader>
                                        <CardTitle>Headline Section</CardTitle>
                                        <CardDescription>Main headline and description below the hero</CardDescription>
                                    </CardHeader>
                                    <CardContent className="space-y-4">
                                        <AdminTextInput
                                            label="Title"
                                            id="headline_title"
                                            value={data.sections.headline.content.title || ''}
                                            onChange={(e) => updateSection('headline', {
                                                ...data.sections.headline.content,
                                                title: e.target.value
                                            })}
                                            maxLength={150}
                                            placeholder="Main headline"
                                        />
                                        <div>
                                            <Label>Description</Label>
                                            <Textarea
                                                value={data.sections.headline.content.description || ''}
                                                onChange={(e) => updateSection('headline', {
                                                    ...data.sections.headline.content,
                                                    description: e.target.value
                                                })}
                                                placeholder="Description text"
                                                rows={4}
                                            />
                                        </div>
                                    </CardContent>
                                </Card>
                            </TabsContent>

                            {/* How to Order Tab */}
                            <TabsContent value="how_to_order">
                                <Card>
                                    <CardHeader>
                                        <CardTitle>How to Order Section</CardTitle>
                                        <CardDescription>Step-by-step ordering process</CardDescription>
                                    </CardHeader>
                                    <CardContent className="space-y-4">
                                        <AdminTextInput
                                            label="Section Title"
                                            id="how_to_order_title"
                                            value={data.sections.how_to_order.content.title || ''}
                                            onChange={(e) => updateSection('how_to_order', {
                                                ...data.sections.how_to_order.content,
                                                title: e.target.value
                                            })}
                                            maxLength={100}
                                            placeholder="০ টাকা বিনিয়োগে শুরু করুন"
                                        />
                                        <AdminVideoInput
                                            label="How to Order Video"
                                            id="video_url"
                                            value={data.sections.how_to_order.content.video_url || ''}
                                            onChange={(url) => updateSection('how_to_order', {
                                                ...data.sections.how_to_order.content,
                                                video_url: typeof url === 'string' ? url : ''
                                            })}
                                            posterImage={data.sections.how_to_order.content.video_poster || ''}
                                            onPosterChange={(posterUrl) => updateSection('how_to_order', {
                                                ...data.sections.how_to_order.content,
                                                video_poster: posterUrl
                                            })}
                                            helperText="Upload a video or enter a URL to show how the ordering process works"
                                            aspectRatio="16/9"
                                        />
                                        <div className="space-y-4">
                                            <Label className="text-lg">Steps</Label>
                                            {(data.sections.how_to_order.content.steps || []).map((step, index) => (
                                                <div key={index} className="grid gap-4 md:grid-cols-3 p-4 border rounded-lg">
                                                    <div>
                                                        <AdminTextInput
                                                            label="Step Number"
                                                            value={step.number}
                                                            onChange={(e) => {
                                                                const steps = [...data.sections.how_to_order.content.steps];
                                                                steps[index] = { ...step, number: e.target.value };
                                                                updateSection('how_to_order', { ...data.sections.how_to_order.content, steps });
                                                            }}
                                                            placeholder="১"
                                                        />
                                                    </div>
                                                    <div>
                                                        <AdminTextInput
                                                            label="Title"
                                                            value={step.title}
                                                            onChange={(e) => {
                                                                const steps = [...data.sections.how_to_order.content.steps];
                                                                steps[index] = { ...step, title: e.target.value };
                                                                updateSection('how_to_order', { ...data.sections.how_to_order.content, steps });
                                                            }}
                                                            placeholder="Step title"
                                                        />
                                                    </div>
                                                    <div>
                                                        <AdminTextInput
                                                            label="Description"
                                                            value={step.description}
                                                            onChange={(e) => {
                                                                const steps = [...data.sections.how_to_order.content.steps];
                                                                steps[index] = { ...step, description: e.target.value };
                                                                updateSection('how_to_order', { ...data.sections.how_to_order.content, steps });
                                                            }}
                                                            placeholder="Step description"
                                                        />
                                                    </div>
                                                </div>
                                            ))}
                                        </div>
                                    </CardContent>
                                </Card>
                            </TabsContent>

                            {/* Best Sellers Tab */}
                            <TabsContent value="best_sellers">
                                <Card>
                                    <CardHeader>
                                        <div className="flex items-center justify-between">
                                            <div>
                                                <CardTitle>Best Sellers Section</CardTitle>
                                                <CardDescription>Popular products showcase</CardDescription>
                                            </div>
                                            <Button type="button" variant="outline" size="sm" onClick={addProduct}>
                                                <Plus className="h-4 w-4 mr-1" />
                                                Add Product
                                            </Button>
                                        </div>
                                    </CardHeader>
                                    <CardContent className="space-y-4">
                                        <AdminTextInput
                                            label="Section Title"
                                            id="best_sellers_title"
                                            value={data.sections.best_sellers.content.title || ''}
                                            onChange={(e) => updateSection('best_sellers', {
                                                ...data.sections.best_sellers.content,
                                                title: e.target.value
                                            })}
                                            maxLength={100}
                                            placeholder="জনপ্রিয় পণ্য"
                                        />
                                        <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                                            {(data.sections.best_sellers.content.products || []).map((product, index) => (
                                                <div key={index} className="p-4 border rounded-lg space-y-3">
                                                    <div className="flex justify-between items-center">
                                                        <span className="font-medium">Product {index + 1}</span>
                                                        <Button
                                                            type="button"
                                                            variant="ghost"
                                                            size="sm"
                                                            onClick={() => removeProduct(index)}
                                                        >
                                                            <Trash2 className="h-4 w-4 text-destructive" />
                                                        </Button>
                                                    </div>
                                                    <AdminTextInput
                                                        label="Title"
                                                        id={`product-title-${index}`}
                                                        value={product.title}
                                                        onChange={(e) => updateProduct(index, 'title', e.target.value)}
                                                        maxLength={50}
                                                        placeholder="Product title"
                                                        showCharCount={false}
                                                    />
                                                    <AdminTextInput
                                                        label="URL"
                                                        id={`product-url-${index}`}
                                                        value={product.url}
                                                        onChange={(e) => updateProduct(index, 'url', e.target.value)}
                                                        maxLength={100}
                                                        placeholder="/magazines"
                                                        showCharCount={false}
                                                    />
                                                    <AdminImageInput
                                                        label="Image"
                                                        id={`product-image-${index}`}
                                                        value={product.image}
                                                        onChange={(value) => updateProduct(index, 'image', value)}
                                                        defaultImage={product.image}
                                                        aspectRatio="1/1"
                                                        maxSizeMB={15}
                                                    />
                                                </div>
                                            ))}
                                        </div>
                                    </CardContent>
                                </Card>
                            </TabsContent>

                            {/* Testimonials Tab */}
                            <TabsContent value="testimonials">
                                <Card>
                                    <CardHeader>
                                        <div className="flex items-center justify-between">
                                            <div>
                                                <CardTitle>Testimonials Section</CardTitle>
                                                <CardDescription>Customer reviews and feedback</CardDescription>
                                            </div>
                                            <Button type="button" variant="outline" size="sm" onClick={addTestimonial}>
                                                <Plus className="h-4 w-4 mr-1" />
                                                Add Testimonial
                                            </Button>
                                        </div>
                                    </CardHeader>
                                    <CardContent className="space-y-4">
                                        <div className="grid gap-4 md:grid-cols-2">
                                            <AdminTextInput
                                                label="Section Title"
                                                id="testimonials_title"
                                                value={data.sections.testimonials.content.title || ''}
                                                onChange={(e) => updateSection('testimonials', {
                                                    ...data.sections.testimonials.content,
                                                    title: e.target.value
                                                })}
                                                maxLength={100}
                                                placeholder="গ্রাহকদের মতামত"
                                            />
                                            <AdminTextInput
                                                label="Subtitle"
                                                id="testimonials_subtitle"
                                                value={data.sections.testimonials.content.subtitle || ''}
                                                onChange={(e) => updateSection('testimonials', {
                                                    ...data.sections.testimonials.content,
                                                    subtitle: e.target.value
                                                })}
                                                maxLength={150}
                                                placeholder="Subtitle text"
                                            />
                                        </div>
                                        <Accordion type="single" collapsible className="space-y-2">
                                            {(data.sections.testimonials.content.items || []).map((item, index) => (
                                                <AccordionItem key={index} value={`testimonial-${index}`} className="border rounded-lg px-4">
                                                    <AccordionTrigger>
                                                        <span>Testimonial {index + 1}: {item.author || 'Anonymous'}</span>
                                                    </AccordionTrigger>
                                                    <AccordionContent className="space-y-4 pt-4">
                                                        <div>
                                                            <Label>Review Text</Label>
                                                            <Textarea
                                                                value={item.text}
                                                                onChange={(e) => updateTestimonial(index, 'text', e.target.value)}
                                                                placeholder="Customer review..."
                                                                rows={3}
                                                            />
                                                        </div>
                                                        <div className="grid gap-4 md:grid-cols-2">
                                                            <AdminTextInput
                                                                label="Author Name"
                                                                id={`testimonial-author-${index}`}
                                                                value={item.author}
                                                                onChange={(e) => updateTestimonial(index, 'author', e.target.value)}
                                                                maxLength={50}
                                                                placeholder="আহমেদ রহমান"
                                                                showCharCount={false}
                                                            />
                                                            <AdminTextInput
                                                                label="Designation"
                                                                id={`testimonial-designation-${index}`}
                                                                value={item.designation}
                                                                onChange={(e) => updateTestimonial(index, 'designation', e.target.value)}
                                                                maxLength={50}
                                                                placeholder="CEO, Company"
                                                                showCharCount={false}
                                                            />
                                                        </div>
                                                        <div className="max-w-[200px]">
                                                            <AdminImageInput
                                                                label="Avatar Image"
                                                                id={`testimonial-avatar-${index}`}
                                                                value={item.avatar_image}
                                                                onChange={(file) => updateTestimonial(index, 'avatar_image', file)}
                                                                accept="image/*"
                                                                helperText="Upload avatar image (recommended: 100x100px)"
                                                                aspectRatio="1/1"
                                                            />
                                                        </div>
                                                        <div className="grid gap-4 md:grid-cols-2">
                                                            <AdminTextInput
                                                                label="Rating (1-5)"
                                                                id={`testimonial-rating-${index}`}
                                                                type="number"
                                                                value={item.rating}
                                                                onChange={(e) => updateTestimonial(index, 'rating', parseInt(e.target.value))}
                                                                showCharCount={false}
                                                                validation={{
                                                                    custom: (value) => {
                                                                        const num = parseInt(value);
                                                                        if (num < 1 || num > 5) return 'Rating must be between 1 and 5';
                                                                        return null;
                                                                    }
                                                                }}
                                                            />
                                                        </div>
                                                        <Button
                                                            type="button"
                                                            variant="destructive"
                                                            size="sm"
                                                            onClick={() => removeTestimonial(index)}
                                                        >
                                                            <Trash2 className="h-4 w-4 mr-1" />
                                                            Remove
                                                        </Button>
                                                    </AccordionContent>
                                                </AccordionItem>
                                            ))}
                                        </Accordion>
                                    </CardContent>
                                </Card>
                            </TabsContent>

                            {/* Offer Banner Tab */}
                            <TabsContent value="offer">
                                <Card>
                                    <CardHeader>
                                        <CardTitle>Offer Banner Section</CardTitle>
                                        <CardDescription>Promotional banner with call-to-action</CardDescription>
                                    </CardHeader>
                                    <CardContent className="space-y-4">
                                        <div className="grid gap-4 md:grid-cols-2">
                                            <AdminTextInput
                                                label="Title"
                                                id="offer_title"
                                                value={data.sections.offer_banner.content.title || ''}
                                                onChange={(e) => updateSection('offer_banner', {
                                                    ...data.sections.offer_banner.content,
                                                    title: e.target.value
                                                })}
                                                maxLength={100}
                                                placeholder="বিশেষ অফার!"
                                            />
                                            <AdminTextInput
                                                label="Subtitle"
                                                id="offer_subtitle"
                                                value={data.sections.offer_banner.content.subtitle || ''}
                                                onChange={(e) => updateSection('offer_banner', {
                                                    ...data.sections.offer_banner.content,
                                                    subtitle: e.target.value
                                                })}
                                                maxLength={150}
                                                placeholder="প্রথম অর্ডারে ২০% ছাড়"
                                            />
                                        </div>
                                        <div>
                                            <Label>Description</Label>
                                            <Textarea
                                                value={data.sections.offer_banner.content.description || ''}
                                                onChange={(e) => updateSection('offer_banner', {
                                                    ...data.sections.offer_banner.content,
                                                    description: e.target.value
                                                })}
                                                placeholder="Offer details..."
                                                rows={3}
                                            />
                                        </div>
                                        <div className="grid gap-4 md:grid-cols-3">
                                            <AdminTextInput
                                                label="CTA Text"
                                                id="offer_cta_text"
                                                value={data.sections.offer_banner.content.cta_text || ''}
                                                onChange={(e) => updateSection('offer_banner', {
                                                    ...data.sections.offer_banner.content,
                                                    cta_text: e.target.value
                                                })}
                                                maxLength={30}
                                                placeholder="এখনই অফার নিন"
                                                showCharCount={false}
                                            />
                                            <AdminTextInput
                                                label="CTA URL"
                                                id="offer_cta_url"
                                                value={data.sections.offer_banner.content.cta_url || ''}
                                                onChange={(e) => updateSection('offer_banner', {
                                                    ...data.sections.offer_banner.content,
                                                    cta_url: e.target.value
                                                })}
                                                maxLength={100}
                                                placeholder="/shop"
                                                showCharCount={false}
                                            />
                                            <AdminTextInput
                                                label="Background Gradient"
                                                id="offer_gradient"
                                                value={data.sections.offer_banner.content.background_gradient || ''}
                                                onChange={(e) => updateSection('offer_banner', {
                                                    ...data.sections.offer_banner.content,
                                                    background_gradient: e.target.value
                                                })}
                                                maxLength={100}
                                                placeholder="from-green-600 to-green-800"
                                                showCharCount={false}
                                            />
                                        </div>
                                        <div>
                                            <AdminImageInput
                                                label="Background Image"
                                                id="offer_bg_image"
                                                value={data.sections.offer_banner.content.background_image}
                                                onChange={(file) => updateSection('offer_banner', {
                                                    ...data.sections.offer_banner.content,
                                                    background_image: file
                                                })}
                                                accept="image/*"
                                                helperText="Upload banner background image (recommended: 1920x400px). If set, this will override the background gradient."
                                                aspectRatio="16/4"
                                            />
                                        </div>
                                    </CardContent>
                                </Card>
                            </TabsContent>

                            {/* Trust Section Tab */}
                            <TabsContent value="trust">
                                <Card>
                                    <CardHeader>
                                        <div className="flex items-center justify-between">
                                            <div>
                                                <CardTitle>Trust Section</CardTitle>
                                                <CardDescription>Brands that trust your service</CardDescription>
                                            </div>
                                            <Button type="button" variant="outline" size="sm" onClick={addBrand}>
                                                <Plus className="h-4 w-4 mr-1" />
                                                Add Brand
                                            </Button>
                                        </div>
                                    </CardHeader>
                                    <CardContent className="space-y-4">
                                        <div className="grid gap-4 md:grid-cols-2">
                                            <AdminTextInput
                                                label="Section Title"
                                                id="trust_title"
                                                value={data.sections.trust_section.content?.title || ''}
                                                onChange={(e) => updateSection('trust_section', {
                                                    ...(data.sections.trust_section.content || {}),
                                                    title: e.target.value
                                                })}
                                                maxLength={100}
                                                placeholder="যারা আমাদের বিশ্বাস করেন"
                                            />
                                            <AdminTextInput
                                                label="Subtitle"
                                                id="trust_subtitle"
                                                value={data.sections.trust_section.content?.subtitle || ''}
                                                onChange={(e) => updateSection('trust_section', {
                                                    ...(data.sections.trust_section.content || {}),
                                                    subtitle: e.target.value
                                                })}
                                                maxLength={150}
                                                placeholder="Subtitle text"
                                            />
                                        </div>

                                        <div>
                                            <Label className="mb-4 block">Brand Logos</Label>
                                            {(data.sections.trust_section.content?.brands || []).length === 0 ? (
                                                <div className="text-center py-12 bg-muted/30 rounded-lg border-2 border-dashed">
                                                    <p className="text-muted-foreground mb-4">No brands added yet</p>
                                                    <Button
                                                        type="button"
                                                        variant="outline"
                                                        size="sm"
                                                        onClick={addBrand}
                                                        className="gap-2"
                                                    >
                                                        <Plus className="h-4 w-4" />
                                                        Add Your First Brand
                                                    </Button>
                                                </div>
                                            ) : (
                                                <div className="grid gap-4 md:grid-cols-3 lg:grid-cols-6">
                                                    {(data.sections.trust_section.content.brands).map((brand, index) => (
                                                        <div key={index} className="p-3 border rounded-lg space-y-2">
                                                            <div className="flex justify-between items-center">
                                                                <span className="text-sm font-medium">Brand {index + 1}</span>
                                                                <Button
                                                                    type="button"
                                                                    variant="ghost"
                                                                    size="sm"
                                                                    onClick={() => removeBrand(index)}
                                                                >
                                                                    <Trash2 className="h-3 w-3 text-destructive" />
                                                                </Button>
                                                            </div>
                                                            <AdminTextInput
                                                                label="Brand Name"
                                                                id={`brand-name-${index}`}
                                                                value={brand.name}
                                                                onChange={(e) => updateBrand(index, 'name', e.target.value)}
                                                                maxLength={50}
                                                                placeholder="Brand name"
                                                                className="text-sm [&>label]:text-xs"
                                                                showCharCount={false}
                                                            />
                                                            <AdminImageInput
                                                                label="Logo"
                                                                id={`brand-logo-${index}`}
                                                                value={brand.logo}
                                                                onChange={(value) => updateBrand(index, 'logo', value)}
                                                                defaultImage={brand.logo}
                                                                aspectRatio="16/9"
                                                                maxSizeMB={15}
                                                                className="[&>label]:text-xs"
                                                            />
                                                        </div>
                                                    ))}
                                                </div>
                                            )}
                                        </div>
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

HomePageEditor.layout = (page) => <AdminLayout>{page}</AdminLayout>;
