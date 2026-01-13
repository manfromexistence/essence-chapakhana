import AdminLayout from '@/Layouts/AdminLayout';
import { useState } from 'react';
import { Link, router, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import { Badge } from '@/components/ui/badge';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { Label } from '@/components/ui/label';
import { Plus, Pencil, Trash2, Eye } from 'lucide-react';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';

export default function Products({ products = [], categories = [] }) {
    const [isDeleteOpen, setIsDeleteOpen] = useState(false);
    const [selectedProduct, setSelectedProduct] = useState(null);
    const [viewProduct, setViewProduct] = useState(null);

    const handleDelete = () => {
        router.delete(`/admin/products/${selectedProduct.slug}`, {
            onSuccess: () => setIsDeleteOpen(false),
        });
    };

    return (
        <>
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold">Products</h1>
                        <p className="text-muted-foreground">Manage your product catalog</p>
                    </div>
                    <Link href="/admin/products/create">
                        <Button>
                            <Plus className="mr-2 h-4 w-4" />
                            Add Product
                        </Button>
                    </Link>
                </div>

                <div>
                    <Card>
                        <CardHeader>
                            <CardTitle>All Products ({products.length})</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <Table>
                                <TableHeader>
                                    <TableRow>
                                        <TableHead>Image</TableHead>
                                        <TableHead>Title</TableHead>
                                        <TableHead>Category</TableHead>
                                        <TableHead>Format</TableHead>
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
                                            <TableCell>{product.format}</TableCell>
                                            <TableCell>Rs. {product.price}</TableCell>
                                            <TableCell>
                                                <Badge variant={product.stock ? 'default' : 'secondary'}>
                                                    {product.stock ? 'In Stock' : 'Out of Stock'}
                                                </Badge>
                                            </TableCell>
                                            <TableCell>
                                                <Badge
                                                    variant={product.is_active ? 'default' : 'secondary'}
                                                >
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
                                                        onClick={() => {
                                                            setSelectedProduct(product);
                                                            setIsDeleteOpen(true);
                                                        }}
                                                    >
                                                        <Trash2 className="h-4 w-4" />
                                                    </Button>
                                                </div>
                                            </TableCell>
                                        </TableRow>
                                    ))}
                                </TableBody>
                            </Table>
                        </CardContent>
                    </Card>
                </div>
            </div>

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
                                            <p className="font-semibold">Rs. {viewProduct.price}</p>
                                        </div>
                                        <div>
                                            <p className="text-sm text-muted-foreground">Rating</p>
                                            <p className="font-semibold">{viewProduct.rating}/5</p>
                                        </div>
                                        <div>
                                            <p className="text-sm text-muted-foreground">Popularity</p>
                                            <p className="font-semibold">{viewProduct.popularity}%</p>
                                        </div>
                                        <div>
                                            <p className="text-sm text-muted-foreground">Stock</p>
                                            <p className="font-semibold">
                                                {viewProduct.stock ? 'Available' : 'Out of Stock'}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    )}
                </DialogContent>
            </Dialog>

            {/* Delete Dialog */}
            <Dialog open={isDeleteOpen} onOpenChange={setIsDeleteOpen}>
                <DialogContent>
                    <DialogHeader>
                        <DialogTitle>Delete Product</DialogTitle>
                        <DialogDescription>
                            Are you sure you want to delete "{selectedProduct?.title}"? This action
                            cannot be undone.
                        </DialogDescription>
                    </DialogHeader>
                    <DialogFooter>
                        <Button variant="outline" onClick={() => setIsDeleteOpen(false)}>
                            Cancel
                        </Button>
                        <Button variant="destructive" onClick={handleDelete}>
                            Delete
                        </Button>
                    </DialogFooter>
                </DialogContent>
            </Dialog>
        </>
    );
}

Products.layout = (page) => <AdminLayout>{page}</AdminLayout>;
