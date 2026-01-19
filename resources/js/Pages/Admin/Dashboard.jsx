import AdminLayout from '@/Layouts/AdminLayout';
import { Link } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { AdminSectionCards } from '@/components/admin-section-cards';
import { RevenueChart } from '@/components/revenue-chart';
import {
    Package,
    ShoppingCart,
    Layers,
    ArrowRightIcon,
} from 'lucide-react';
import { Button } from '@/components/ui/button';

export default function Dashboard({ stats, chartData }) {
    return (

        <div className="@container/main flex flex-1 flex-col gap-2">
            <div className="flex flex-col gap-4 py-4 md:gap-6 md:py-6">
                {/* Header */}
                <div className="px-4 lg:px-6">
                    <h1 className="text-2xl font-bold tracking-tight">Dashboard</h1>
                    <p className="text-muted-foreground">
                        Welcome back! Here's what's happening with your store.
                    </p>
                </div>

                {/* Stats Cards */}
                <AdminSectionCards stats={stats} />

                {/* Charts Section */}
                <div className="px-4 lg:px-6">
                    <RevenueChart data={chartData} />
                </div>

                {/* Recent Orders & Quick Actions */}
                <div className="grid gap-4 px-4 md:grid-cols-2 lg:px-6">
                    {/* Recent Orders */}
                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between">
                            <div>
                                <CardTitle>Recent Orders</CardTitle>
                                <CardDescription>Latest customer orders</CardDescription>
                            </div>
                            <Button variant="ghost" size="sm" asChild>
                                <Link href="/admin/orders">
                                    View all
                                    <ArrowRightIcon className="ml-1 h-4 w-4" />
                                </Link>
                            </Button>
                        </CardHeader>
                        <CardContent>
                            <div className="space-y-4">
                                {stats?.recentOrders && stats.recentOrders.length > 0 ? (
                                    stats.recentOrders.map((order) => (
                                        <div
                                            key={order.id}
                                            className="flex items-center justify-between border-b pb-4 last:border-0 last:pb-0"
                                        >
                                            <div>
                                                <p className="font-medium">Order #{order.id}</p>
                                                <p className="text-sm text-muted-foreground">
                                                    {order.customer_name}
                                                </p>
                                            </div>
                                            <div className="text-right">
                                                <p className="font-medium">
                                                    ৳ {order.total_amount?.toLocaleString()}
                                                </p>
                                                <Badge
                                                    variant={
                                                        order.status === 'completed'
                                                            ? 'default'
                                                            : 'secondary'
                                                    }
                                                >
                                                    {order.status}
                                                </Badge>
                                            </div>
                                        </div>
                                    ))
                                ) : (
                                    <p className="text-center text-muted-foreground py-8">
                                        No recent orders
                                    </p>
                                )}
                            </div>
                        </CardContent>
                    </Card>

                    {/* Quick Actions */}
                    <Card>
                        <CardHeader>
                            <CardTitle>Quick Actions</CardTitle>
                            <CardDescription>Common tasks and shortcuts</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div className="grid gap-3">
                                <Link
                                    href="/admin/products"
                                    className="flex items-center gap-3 rounded-lg border p-4 transition-colors hover:bg-accent"
                                >
                                    <div className="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10">
                                        <Package className="h-5 w-5 text-primary" />
                                    </div>
                                    <div>
                                        <p className="font-medium">Manage Products</p>
                                        <p className="text-sm text-muted-foreground">
                                            Add or edit products
                                        </p>
                                    </div>
                                </Link>
                                <Link
                                    href="/admin/orders"
                                    className="flex items-center gap-3 rounded-lg border p-4 transition-colors hover:bg-accent"
                                >
                                    <div className="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10">
                                        <ShoppingCart className="h-5 w-5 text-primary" />
                                    </div>
                                    <div>
                                        <p className="font-medium">View Orders</p>
                                        <p className="text-sm text-muted-foreground">
                                            Process customer orders
                                        </p>
                                    </div>
                                </Link>
                                <Link
                                    href="/admin/categories"
                                    className="flex items-center gap-3 rounded-lg border p-4 transition-colors hover:bg-accent"
                                >
                                    <div className="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10">
                                        <Layers className="h-5 w-5 text-primary" />
                                    </div>
                                    <div>
                                        <p className="font-medium">Manage Categories</p>
                                        <p className="text-sm text-muted-foreground">
                                            Organize products
                                        </p>
                                    </div>
                                </Link>
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </div>

    );
}

Dashboard.layout = (page) => <AdminLayout>{page}</AdminLayout>;
