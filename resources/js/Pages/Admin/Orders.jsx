import AdminLayout from '@/Layouts/AdminLayout';
import { useState } from 'react';
import { router } from '@inertiajs/react';
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
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import { Eye, Trash2, Package } from 'lucide-react';

export default function Orders({ orders = { data: [], links: [], from: 0, to: 0, total: 0 } }) {
    const [isDeleteOpen, setIsDeleteOpen] = useState(false);
    const [isViewOpen, setIsViewOpen] = useState(false);
    const [selectedOrder, setSelectedOrder] = useState(null);
    const [statusFilter, setStatusFilter] = useState('all');

    const handleDelete = () => {
        router.delete(`/admin/orders/${selectedOrder.id}`, {
            onSuccess: () => setIsDeleteOpen(false),
        });
    };

    const handleStatusChange = (orderId, newStatus) => {
        router.patch(`/admin/orders/${orderId}/status`, {
            status: newStatus,
        });
    };

    const getStatusColor = (status) => {
        const colors = {
            pending: 'secondary',
            processing: 'default',
            shipped: 'default',
            delivered: 'default',
            cancelled: 'destructive',
        };
        return colors[status] || 'secondary';
    };

    const filteredOrders =
        statusFilter === 'all'
            ? orders.data
            : orders.data.filter((order) => order.status === statusFilter);

    return (
        <>
            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold">Orders</h1>
                        <p className="text-muted-foreground">Manage customer orders</p>
                    </div>
                    <Select value={statusFilter} onValueChange={setStatusFilter}>
                        <SelectTrigger className="w-[180px]">
                            <SelectValue placeholder="Filter by status" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem value="all">All Orders</SelectItem>
                            <SelectItem value="pending">Pending</SelectItem>
                            <SelectItem value="processing">Processing</SelectItem>
                            <SelectItem value="shipped">Shipped</SelectItem>
                            <SelectItem value="delivered">Delivered</SelectItem>
                            <SelectItem value="cancelled">Cancelled</SelectItem>
                        </SelectContent>
                    </Select>
                </div>

                <div>
                    <Card>
                        <CardHeader>
                            <CardTitle>All Orders ({filteredOrders.length})</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <Table>
                                <TableHeader>
                                    <TableRow>
                                        <TableHead>Order ID</TableHead>
                                        <TableHead>Customer</TableHead>
                                        <TableHead>Email</TableHead>
                                        <TableHead>Phone</TableHead>
                                        <TableHead>Total</TableHead>
                                        <TableHead>Status</TableHead>
                                        <TableHead>Date</TableHead>
                                        <TableHead className="text-right">Actions</TableHead>
                                    </TableRow>
                                </TableHeader>
                                <TableBody>
                                    {filteredOrders.map((order) => (
                                        <TableRow key={order.id}>
                                            <TableCell className="font-medium">#{order.id}</TableCell>
                                            <TableCell>{order.shipping_name}</TableCell>
                                            <TableCell>{order.shipping_email}</TableCell>
                                            <TableCell>{order.shipping_phone}</TableCell>
                                            <TableCell className="font-semibold">
                                                Rs. {order.total?.toLocaleString()}
                                            </TableCell>
                                            <TableCell>
                                                <Select
                                                    value={order.status || 'pending'}
                                                    onValueChange={(value) =>
                                                        handleStatusChange(order.id, value)
                                                    }
                                                >
                                                    <SelectTrigger className="w-[130px]">
                                                        <SelectValue />
                                                    </SelectTrigger>
                                                    <SelectContent>
                                                        <SelectItem value="pending">Pending</SelectItem>
                                                        <SelectItem value="processing">
                                                            Processing
                                                        </SelectItem>
                                                        <SelectItem value="shipped">Shipped</SelectItem>
                                                        <SelectItem value="delivered">
                                                            Delivered
                                                        </SelectItem>
                                                        <SelectItem value="cancelled">
                                                            Cancelled
                                                        </SelectItem>
                                                    </SelectContent>
                                                </Select>
                                            </TableCell>
                                            <TableCell>
                                                {new Date(order.created_at).toLocaleDateString()}
                                            </TableCell>
                                            <TableCell className="text-right">
                                                <div className="flex justify-end gap-2">
                                                    <Button
                                                        variant="outline"
                                                        size="sm"
                                                        onClick={() => {
                                                            setSelectedOrder(order);
                                                            setIsViewOpen(true);
                                                        }}
                                                    >
                                                        <Eye className="h-4 w-4" />
                                                    </Button>
                                                    <Button
                                                        variant="destructive"
                                                        size="sm"
                                                        onClick={() => {
                                                            setSelectedOrder(order);
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

                            {/* Pagination */}
                            {orders.links && (
                                <div className="mt-4 flex items-center justify-between">
                                    <div className="text-sm text-muted-foreground">
                                        Showing {orders.from} to {orders.to} of {orders.total} orders
                                    </div>
                                    <div className="flex gap-2">
                                        {orders.links.map((link, index) => (
                                            <Button
                                                key={index}
                                                variant={link.active ? 'default' : 'outline'}
                                                size="sm"
                                                disabled={!link.url}
                                                onClick={() => link.url && router.visit(link.url)}
                                                dangerouslySetInnerHTML={{ __html: link.label }}
                                            />
                                        ))}
                                    </div>
                                </div>
                            )}
                        </CardContent>
                    </Card>
                </div>
            </div>

            {/* View Order Dialog */}
            <Dialog open={isViewOpen} onOpenChange={setIsViewOpen}>
                <DialogContent className="max-w-3xl">
                    <DialogHeader>
                        <DialogTitle>Order Details #{selectedOrder?.id}</DialogTitle>
                    </DialogHeader>
                    {selectedOrder && (
                        <div className="space-y-6">
                            <div className="grid grid-cols-2 gap-4">
                                <div>
                                    <h3 className="font-semibold text-sm text-muted-foreground mb-2">
                                        Customer Information
                                    </h3>
                                    <div className="space-y-1">
                                        <p>
                                            <span className="font-medium">Name:</span>{' '}
                                            {selectedOrder.shipping_name}
                                        </p>
                                        <p>
                                            <span className="font-medium">Email:</span>{' '}
                                            {selectedOrder.shipping_email}
                                        </p>
                                        <p>
                                            <span className="font-medium">Phone:</span>{' '}
                                            {selectedOrder.shipping_phone}
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <h3 className="font-semibold text-sm text-muted-foreground mb-2">
                                        Shipping Address
                                    </h3>
                                    <p className="text-sm">{selectedOrder.shipping_address}</p>
                                </div>
                            </div>

                            <div>
                                <h3 className="font-semibold text-sm text-muted-foreground mb-2">
                                    Order Items
                                </h3>
                                <div className="border rounded-lg divide-y">
                                    {selectedOrder.items?.map((item, index) => (
                                        <div key={index} className="flex items-center gap-4 p-4">
                                            <Package className="h-8 w-8 text-muted-foreground" />
                                            <div className="flex-1">
                                                <p className="font-medium">{item.product_title}</p>
                                                <p className="text-sm text-muted-foreground">
                                                    Qty: {item.quantity} × Rs. {item.price}
                                                </p>
                                            </div>
                                            <p className="font-semibold">
                                                Rs. {(item.quantity * item.price).toLocaleString()}
                                            </p>
                                        </div>
                                    )) || (
                                            <p className="p-4 text-center text-muted-foreground">
                                                No items found
                                            </p>
                                        )}
                                </div>
                            </div>

                            <div className="flex justify-between items-center border-t pt-4">
                                <span className="text-lg font-semibold">Total Amount:</span>
                                <span className="text-2xl font-bold">
                                    Rs. {selectedOrder.total?.toLocaleString()}
                                </span>
                            </div>
                        </div>
                    )}
                </DialogContent>
            </Dialog>

            {/* Delete Dialog */}
            <Dialog open={isDeleteOpen} onOpenChange={setIsDeleteOpen}>
                <DialogContent>
                    <DialogHeader>
                        <DialogTitle>Delete Order</DialogTitle>
                        <DialogDescription>
                            Are you sure you want to delete order #{selectedOrder?.id}? This action
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

Orders.layout = (page) => <AdminLayout>{page}</AdminLayout>;
