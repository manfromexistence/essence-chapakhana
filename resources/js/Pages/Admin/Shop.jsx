import { useState } from 'react';
import AdminLayout from '@/Layouts/AdminLayout';
import { Link, router, useForm } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { AdminTextInput } from '@/components/AdminTextInput';
import { AdminImageInput } from '@/components/AdminImageInput';
import { Label } from '@/components/ui/label';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { Checkbox } from '@/components/ui/checkbox';
import { Badge } from '@/components/ui/badge';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { Save, Plus, Trash2, ShoppingBag, BarChart3, Tag, Package, Pencil, Eye, ShoppingCart, Layers } from 'lucide-react';

import { useTabsWithLocalStorage } from '@/hooks/useTabsWithLocalStorage';

export default function Shop({ hero = {}, categories = [], products = [], orders = [] }) {
    const [activeTab, setActiveTab] = useTabsWithLocalStorage('admin-shop-tab', 'hero');
    const [viewProduct, setViewProduct] = useState(null);
    const [deleteProduct, setDeleteProduct] = useState(null);
    const [deleteCategory, setDeleteCategory] = useState(null);

    const { data, setData, put, processing } = useForm({
        subtitle: hero.subtitle || '',
        title: hero.title || '',
        description: hero.description || '',
        cover_image: null,
        badges: hero.badges || [''],
        stat1_label: hero.stat1_label || '',
        stat1_value: hero.stat1_value || '',
        stat1_sublabel: hero.stat1_sublabel || '',
        stat2_label: hero.stat2_label || '',
        stat2_value: hero.stat2_value || '',
        stat2_sublabel: hero.stat2_sublabel || '',
        stat3_label: hero.stat3_label || '',
        stat3_value: hero.stat3_value || '',
        stat3_sublabel: hero.stat3_sublabel || '',
        stat4_label: hero.stat4_label || '',
        stat4_value: hero.stat4_value || '',
        stat4_sublabel: hero.stat4_sublabel || '',
        featured_products: hero.featured_products || [],
        featured_categories: hero.featured_categories || [],
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        put('/admin/shop', {
            forceFormData: true,
        });
    };

    const addBadge = () => {
        setData('badges', [...data.badges, '']);
    };

    const removeBadge = (index) => {
        const newBadges = data.badges.filter((_, i) => i !== index);
        setData('badges', newBadges.length > 0 ? newBadges : ['']);
    };

    const updateBadge = (index, value) => {
        const newBadges = [...data.badges];
        newBadges[index] = value;
        setData('badges', newBadges);
    };

    const toggleFeaturedProduct = (productId) => {
        const current = data.featured_products || [];
        if (current.includes(productId)) {
            setData('featured_products', current.filter(id => id !== productId));
        } else {
            setData('featured_products', [...current, productId]);
        }
    };

    const toggleFeaturedCategory = (categoryId) => {
        const current = data.featured_categories || [];
        if (current.includes(categoryId)) {
            setData('featured_categories', current.filter(id => id !== categoryId));
        } else {
            setData('featured_categories', [...current, categoryId]);
        }
    };

    return (
        <>
            <form onSubmit={handleSubmit}>
                <div className="space-y-6">
                    <div className="flex items-center justify-between">
                        <div>
                            <h1 className="text-3xl font-bold">Shop Page Settings</h1>
                            <p className="text-muted-foreground">
                                Manage your shop page content and layout
                            </p>
                        </div>
                        <Button type="submit" disabled={processing}>
                            <Save className="mr-2 h-4 w-4" />
                            {processing ? 'Saving...' : 'Save Changes'}
                        </Button>
                    </div>

                    <Tabs value={activeTab} onValueChange={setActiveTab}>
                        <TabsList className="grid w-full grid-cols-3">
                            <TabsTrigger value="hero" className="flex items-center gap-2">
                                <ShoppingBag className="h-4 w-4" />
                                Hero
                            </TabsTrigger>
                            <TabsTrigger value="products" className="flex items-center gap-2">
                                <Package className="h-4 w-4" />
                                Products
                            </TabsTrigger>
                            <TabsTrigger value="categories" className="flex items-center gap-2">
                                <Layers className="h-4 w-4" />
                                Categories
                            </TabsTrigger>
                            {/* <TabsTrigger value="orders" className="flex items-center gap-2">
                                <ShoppingCart className="h-4 w-4" />
                                Orders
                            </TabsTrigger> */}
                        </TabsList>

                        {/* Hero Section Tab */}
                        <TabsContent value="hero" className="space-y-6">
                            <Card>
                                <CardHeader>
                                    <CardTitle>Hero Section Content</CardTitle>
                                    <CardDescription>
                                        Configure the main banner section of your shop page
                                    </CardDescription>
                                </CardHeader>
                                <CardContent className="space-y-4">
                                    <AdminTextInput
                                        label="Subtitle"
                                        id="subtitle"
                                        value={data.subtitle}
                                        onChange={(e) => setData('subtitle', e.target.value)}
                                        placeholder="Curated print catalogue"
                                        maxLength={100}
                                    />
                                    <AdminTextInput
                                        label="Title"
                                        id="title"
                                        value={data.title}
                                        onChange={(e) => setData('title', e.target.value)}
                                        placeholder="Shop every format in one place."
                                        maxLength={150}
                                        required
                                    />
                                    <AdminTextInput
                                        label="Description"
                                        id="description"
                                        value={data.description}
                                        onChange={(e) => setData('description', e.target.value)}
                                        placeholder="Browse books, marketing kits, signage..."
                                        maxLength={300}
                                    />

                                    <AdminImageInput
                                        label="Cover Background Image"
                                        id="cover_image"
                                        value={data.cover_image}
                                        currentImage={hero.cover_image}
                                        onChange={(file) => setData('cover_image', file)}
                                        helperText="Upload a background image for the hero section (recommended: 1920x1080px or larger)"
                                        accept="image/*"
                                    />

                                    {/* Badges */}
                                    <div className="space-y-3">
                                        <Label>Badges</Label>
                                        {data.badges.map((badge, index) => (
                                            <div key={index} className="flex gap-2">
                                                <AdminTextInput
                                                    id={`badge-${index}`}
                                                    value={badge}
                                                    onChange={(e) => updateBadge(index, e.target.value)}
                                                    placeholder="e.g., Lead times 48h"
                                                    maxLength={50}
                                                    className="flex-1"
                                                    showCharCount={false}
                                                />
                                                <Button
                                                    type="button"
                                                    variant="destructive"
                                                    size="icon"
                                                    onClick={() => removeBadge(index)}
                                                    disabled={data.badges.length === 1}
                                                >
                                                    <Trash2 className="h-4 w-4" />
                                                </Button>
                                            </div>
                                        ))}
                                        <Button
                                            type="button"
                                            variant="outline"
                                            size="sm"
                                            onClick={addBadge}
                                        >
                                            <Plus className="mr-2 h-4 w-4" />
                                            Add Badge
                                        </Button>
                                    </div>
                                </CardContent>
                            </Card>
                        </TabsContent>

                        {/* Products Management Tab */}
                        <TabsContent value="products" className="space-y-6">
                            <Card>
                                <CardHeader className="flex flex-row items-center justify-between">
                                    <div>
                                        <CardTitle>Shop Products (E-commerce)</CardTitle>
                                        <CardDescription>Manage products that appear in the /shop page and can be purchased by customers. These are separate from category page content products.</CardDescription>
                                    </div>
                                    <Link href="/admin/products/create">
                                        <Button>
                                            <Plus className="mr-2 h-4 w-4" />
                                            Add Product
                                        </Button>
                                    </Link>
                                </CardHeader>
                                <CardContent>
                                    <Table>
                                        <TableHeader>
                                            <TableRow>
                                                <TableHead>Image</TableHead>
                                                <TableHead>Title</TableHead>
                                                <TableHead>Category</TableHead>
                                                <TableHead>Price</TableHead>
                                                <TableHead>Stock</TableHead>
                                                <TableHead>Status</TableHead>
                                                <TableHead className="text-right">Actions</TableHead>
                                            </TableRow>
                                        </TableHeader>
                                        <TableBody>
                                            {products.map((product) => (
                                                <TableRow key={product.id}>
                                                    <TableCell>
                                                        <img
                                                            src={product.image}
                                                            alt={product.title}
                                                            className="h-12 w-12 rounded object-cover"
                                                        />
                                                    </TableCell>
                                                    <TableCell className="font-medium max-w-xs truncate">
                                                        {product.title}
                                                        {product.badge && (
                                                            <Badge className="ml-2" variant="outline">
                                                                {product.badge}
                                                            </Badge>
                                                        )}
                                                    </TableCell>
                                                    <TableCell>{product.category?.name || 'N/A'}</TableCell>
                                                    <TableCell>৳{product.price}</TableCell>
                                                    <TableCell>
                                                        <Badge variant={product.stock ? 'default' : 'secondary'}>
                                                            {product.stock ? 'In Stock' : 'Out'}
                                                        </Badge>
                                                    </TableCell>
                                                    <TableCell>
                                                        <Badge variant={product.is_active ? 'default' : 'secondary'}>
                                                            {product.is_active ? 'Active' : 'Inactive'}
                                                        </Badge>
                                                    </TableCell>
                                                    <TableCell className="text-right">
                                                        <div className="flex justify-end gap-2">
                                                            <Button
                                                                variant="outline"
                                                                size="sm"
                                                                onClick={() => setViewProduct(product)}
                                                            >
                                                                <Eye className="h-4 w-4" />
                                                            </Button>
                                                            <Link href={`/admin/products/${product.slug}/edit`}>
                                                                <Button variant="outline" size="sm">
                                                                    <Pencil className="h-4 w-4" />
                                                                </Button>
                                                            </Link>
                                                            <Button
                                                                variant="destructive"
                                                                size="sm"
                                                                onClick={() => setDeleteProduct(product)}
                                                            >
                                                                <Trash2 className="h-4 w-4" />
                                                            </Button>
                                                        </div>
                                                    </TableCell>
                                                </TableRow>
                                            ))}
                                        </TableBody>
                                    </Table>
                                    {products.length === 0 && (
                                        <p className="text-center text-muted-foreground py-8">
                                            No products yet. Create your first product!
                                        </p>
                                    )}
                                </CardContent>
                            </Card>
                        </TabsContent>

                        {/* Categories Management Tab */}
                        <TabsContent value="categories" className="space-y-6">
                            <Card>
                                <CardHeader className="flex flex-row items-center justify-between">
                                    <div>
                                        <CardTitle>Categories Management</CardTitle>
                                        <CardDescription>Manage product categories</CardDescription>
                                    </div>
                                    <Link href="/admin/categories">
                                        <Button>
                                            <Plus className="mr-2 h-4 w-4" />
                                            Manage Categories
                                        </Button>
                                    </Link>
                                </CardHeader>
                                <CardContent>
                                    <Table>
                                        <TableHeader>
                                            <TableRow>
                                                <TableHead>Name</TableHead>
                                                <TableHead>Description</TableHead>
                                                <TableHead>Products</TableHead>
                                                <TableHead>Status</TableHead>
                                                <TableHead className="text-right">Actions</TableHead>
                                            </TableRow>
                                        </TableHeader>
                                        <TableBody>
                                            {categories.map((category) => (
                                                <TableRow key={category.id}>
                                                    <TableCell className="font-medium">
                                                        {category.name}
                                                    </TableCell>
                                                    <TableCell className="max-w-md truncate">
                                                        {category.description || 'N/A'}
                                                    </TableCell>
                                                    <TableCell>
                                                        <Badge variant="secondary">
                                                            {category.products_count || 0}
                                                        </Badge>
                                                    </TableCell>
                                                    <TableCell>
                                                        <Badge variant={category.is_active ? 'default' : 'secondary'}>
                                                            {category.is_active ? 'Active' : 'Inactive'}
                                                        </Badge>
                                                    </TableCell>
                                                    <TableCell className="text-right">
                                                        <Button
                                                            variant="outline"
                                                            size="sm"
                                                            onClick={() => router.visit(`/admin/categories`)}
                                                        >
                                                            <Pencil className="h-4 w-4" />
                                                        </Button>
                                                    </TableCell>
                                                </TableRow>
                                            ))}
                                        </TableBody>
                                    </Table>
                                    {categories.length === 0 && (
                                        <p className="text-center text-muted-foreground py-8">
                                            No categories yet. Create your first category!
                                        </p>
                                    )}
                                </CardContent>
                            </Card>
                        </TabsContent>

                        {/* Orders Management Tab */}
                        {/* <TabsContent value="orders" className="space-y-6">
                            <Card>
                                <CardHeader className="flex flex-row items-center justify-between">
                                    <div>
                                        <CardTitle>Recent Orders</CardTitle>
                                        <CardDescription>View and manage customer orders</CardDescription>
                                    </div>
                                    <Link href="/admin/orders">
                                        <Button>
                                            View All Orders
                                        </Button>
                                    </Link>
                                </CardHeader>
                                <CardContent>
                                    <Table>
                                        <TableHeader>
                                            <TableRow>
                                                <TableHead>Order #</TableHead>
                                                <TableHead>Customer</TableHead>
                                                <TableHead>Items</TableHead>
                                                <TableHead>Total</TableHead>
                                                <TableHead>Status</TableHead>
                                                <TableHead>Date</TableHead>
                                                <TableHead className="text-right">Actions</TableHead>
                                            </TableRow>
                                        </TableHeader>
                                        <TableBody>
                                            {orders && orders.slice(0, 10).map((order) => (
                                                <TableRow key={order.id}>
                                                    <TableCell className="font-medium">
                                                        {order.order_number}
                                                    </TableCell>
                                                    <TableCell>{order.shipping_name}</TableCell>
                                                    <TableCell>
                                                        <Badge variant="secondary">
                                                            {order.items?.length || 0} items
                                                        </Badge>
                                                    </TableCell>
                                                    <TableCell>৳{order.total}</TableCell>
                                                    <TableCell>
                                                        <Badge
                                                            variant={
                                                                order.status === 'delivered' ? 'default' :
                                                                    order.status === 'cancelled' ? 'destructive' :
                                                                        'secondary'
                                                            }
                                                        >
                                                            {order.status}
                                                        </Badge>
                                                    </TableCell>
                                                    <TableCell>
                                                        {new Date(order.created_at).toLocaleDateString()}
                                                    </TableCell>
                                                    <TableCell className="text-right">
                                                        <Link href={`/admin/orders`}>
                                                            <Button variant="outline" size="sm">
                                                                <Eye className="h-4 w-4" />
                                                            </Button>
                                                        </Link>
                                                    </TableCell>
                                                </TableRow>
                                            ))}
                                        </TableBody>
                                    </Table>
                                    {(!orders || orders.length === 0) && (
                                        <p className="text-center text-muted-foreground py-8">
                                            No orders yet.
                                        </p>
                                    )}
                                </CardContent>
                            </Card>
                        </TabsContent> */}
                    </Tabs>
                </div>
            </form>

            {/* View Product Dialog */}
            <Dialog open={viewProduct !== null} onOpenChange={() => setViewProduct(null)}>
                <DialogContent className="max-w-2xl">
                    <DialogHeader>
                        <DialogTitle>Product Details</DialogTitle>
                    </DialogHeader>
                    {viewProduct && (
                        <div className="space-y-4">
                            <div className="flex gap-4">
                                <img
                                    src={viewProduct.image}
                                    alt={viewProduct.title}
                                    className="h-48 w-48 rounded-lg object-cover"
                                />
                                <div className="flex-1 space-y-2">
                                    <h3 className="text-xl font-bold">{viewProduct.title}</h3>
                                    <p className="text-sm text-muted-foreground">
                                        {viewProduct.description}
                                    </p>
                                    <div className="flex flex-wrap gap-2">
                                        <Badge>{viewProduct.category?.name}</Badge>
                                        <Badge variant="outline">{viewProduct.format}</Badge>
                                        {viewProduct.badge && (
                                            <Badge variant="secondary">{viewProduct.badge}</Badge>
                                        )}
                                    </div>
                                    <div className="grid grid-cols-2 gap-2 pt-2">
                                        <div>
                                            <p className="text-sm text-muted-foreground">Price</p>
                                            <p className="font-semibold">৳{viewProduct.price}</p>
                                        </div>
                                        <div>
                                            <p className="text-sm text-muted-foreground">Rating</p>
                                            <p className="font-semibold">{viewProduct.rating}/5</p>
                                        </div>
                                        <div>
                                            <p className="text-sm text-muted-foreground">Stock</p>
                                            <p className="font-semibold">
                                                {viewProduct.stock ? 'Available' : 'Out of Stock'}
                                            </p>
                                        </div>
                                        <div>
                                            <p className="text-sm text-muted-foreground">Status</p>
                                            <p className="font-semibold">
                                                {viewProduct.is_active ? 'Active' : 'Inactive'}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    )}
                </DialogContent>
            </Dialog>

            {/* Delete Product Confirmation */}
            <Dialog open={deleteProduct !== null} onOpenChange={() => setDeleteProduct(null)}>
                <DialogContent>
                    <DialogHeader>
                        <DialogTitle>Delete Product</DialogTitle>
                        <DialogDescription>
                            Are you sure you want to delete "{deleteProduct?.title}"? This action cannot be undone.
                        </DialogDescription>
                    </DialogHeader>
                    <DialogFooter>
                        <Button variant="outline" onClick={() => setDeleteProduct(null)}>
                            Cancel
                        </Button>
                        <Button
                            variant="destructive"
                            onClick={() => {
                                router.delete(`/admin/products/${deleteProduct.slug}`, {
                                    onSuccess: () => setDeleteProduct(null)
                                });
                            }}
                        >
                            Delete
                        </Button>
                    </DialogFooter>
                </DialogContent>
            </Dialog>
        </>
    );
}

Shop.layout = (page) => <AdminLayout>{page}</AdminLayout>;
