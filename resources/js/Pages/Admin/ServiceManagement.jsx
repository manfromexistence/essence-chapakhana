import { useState } from 'react';
import AdminLayout from '@/Layouts/AdminLayout';
import { Link } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import {
    ArrowRight,
    Settings,
    Package,
    TrendingUp,
} from 'lucide-react';

const colorClasses = {
    blue: 'bg-blue-50 border-blue-200 hover:border-blue-400',
    green: 'bg-green-50 border-green-200 hover:border-green-400',
    purple: 'bg-purple-50 border-purple-200 hover:border-purple-400',
    orange: 'bg-orange-50 border-orange-200 hover:border-orange-400',
    indigo: 'bg-indigo-50 border-indigo-200 hover:border-indigo-400',
    pink: 'bg-pink-50 border-pink-200 hover:border-pink-400',
    red: 'bg-red-50 border-red-200 hover:border-red-400',
    yellow: 'bg-yellow-50 border-yellow-200 hover:border-yellow-400',
};

const iconClasses = {
    blue: 'bg-blue-100 text-blue-600',
    green: 'bg-green-100 text-green-600',
    purple: 'bg-purple-100 text-purple-600',
    orange: 'bg-orange-100 text-orange-600',
    indigo: 'bg-indigo-100 text-indigo-600',
    pink: 'bg-pink-100 text-pink-600',
    red: 'bg-red-100 text-red-600',
    yellow: 'bg-yellow-100 text-yellow-600',
};

export default function ServiceManagement({ services = [] }) {
    return (
        <div className="space-y-6">
            {/* Header */}
            <div>
                <h1 className="text-3xl font-bold text-gray-900">Service Management</h1>
                <p className="text-muted-foreground mt-2">
                    Manage service packages and configurations for different product categories
                </p>
            </div>

            {/* Stats Overview */}
            <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                <Card>
                    <CardHeader className="flex flex-row items-center justify-between pb-2">
                        <CardTitle className="text-sm font-medium">Total Services</CardTitle>
                        <Package className="h-4 w-4 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div className="text-2xl font-bold">{services.length}</div>
                        <p className="text-xs text-muted-foreground">Active service categories</p>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader className="flex flex-row items-center justify-between pb-2">
                        <CardTitle className="text-sm font-medium">Configurations</CardTitle>
                        <Settings className="h-4 w-4 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div className="text-2xl font-bold">24</div>
                        <p className="text-xs text-muted-foreground">Total configurations available</p>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader className="flex flex-row items-center justify-between pb-2">
                        <CardTitle className="text-sm font-medium">Popular</CardTitle>
                        <TrendingUp className="h-4 w-4 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div className="text-2xl font-bold">Books</div>
                        <p className="text-xs text-muted-foreground">Most configured service</p>
                    </CardContent>
                </Card>
            </div>

            {/* Service Cards Grid */}
            <div>
                <h2 className="text-xl font-semibold text-gray-900 mb-4">Service Categories</h2>
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    {services.map((service) => (
                        <Card
                            key={service.id}
                            className={`group cursor-pointer transition-all duration-300 hover:shadow-lg ${colorClasses[service.color] || colorClasses.blue
                                }`}
                        >
                            <CardHeader>
                                <div className="flex items-start justify-between">
                                    <div
                                        className={`w-12 h-12 rounded-xl flex items-center justify-center text-2xl ${iconClasses[service.color] || iconClasses.blue
                                            }`}
                                    >
                                        {service.icon}
                                    </div>
                                    <Badge variant="secondary" className="text-xs">
                                        Active
                                    </Badge>
                                </div>
                                <CardTitle className="mt-4">{service.name}</CardTitle>
                                <CardDescription className="line-clamp-2">
                                    {service.description}
                                </CardDescription>
                            </CardHeader>
                            <CardContent>
                                <Link href={service.route}>
                                    <Button
                                        variant="ghost"
                                        className="w-full justify-between group-hover:bg-white/80"
                                    >
                                        Manage Service
                                        <ArrowRight className="h-4 w-4 transition-transform group-hover:translate-x-1" />
                                    </Button>
                                </Link>
                            </CardContent>
                        </Card>
                    ))}
                </div>
            </div>

            {/* Quick Actions */}
            <Card>
                <CardHeader>
                    <CardTitle>Quick Actions</CardTitle>
                    <CardDescription>Common tasks and shortcuts</CardDescription>
                </CardHeader>
                <CardContent>
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <Link href="/admin/service-categories">
                            <Button variant="outline" className="w-full justify-start">
                                <Package className="mr-2 h-4 w-4" />
                                View All Categories
                            </Button>
                        </Link>
                        <Link href="/admin/service-products">
                            <Button variant="outline" className="w-full justify-start">
                                <Settings className="mr-2 h-4 w-4" />
                                Service Products
                            </Button>
                        </Link>
                        <Button variant="outline" className="w-full justify-start">
                            <TrendingUp className="mr-2 h-4 w-4" />
                            View Analytics
                        </Button>
                        <Button variant="outline" className="w-full justify-start">
                            <Settings className="mr-2 h-4 w-4" />
                            Global Settings
                        </Button>
                    </div>
                </CardContent>
            </Card>
        </div>
    );
}

ServiceManagement.layout = (page) => <AdminLayout>{page}</AdminLayout>;
