import AdminLayout from '@/Layouts/AdminLayout';
import { Link } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';
import {
    Home,
    Layout,
    FileText,
    BookOpen,
    CreditCard,
    Newspaper,
    Flag,
    Folder,
    Gift,
    ArrowRight,
    Megaphone,
    Mail,
    Sticker,
    Book,
    PenTool,
} from 'lucide-react';

const pageIcons = {
    home: Home,
    layout: Layout,
    footer: FileText,
};

const categoryIcons = {
    'book-open': BookOpen,
    'credit-card': CreditCard,
    'newspaper': Newspaper,
    'flag': Flag,
    'folder': Folder,
    'gift': Gift,
    'megaphone': Megaphone,
    'mail': Mail,
    'sticker': Sticker,
    'book': Book,
    'pen-tool': PenTool,
};

export default function PagesIndex({ pages, categories }) {
    return (
        <div className="@container/main flex flex-1 flex-col gap-2">
            <div className="flex flex-col gap-4 py-4 md:gap-6 md:py-6">
                {/* Header */}
                {/* <div className="px-4 lg:px-6">
                        <h1 className="text-2xl font-bold tracking-tight">Page Management</h1>
                        <p className="text-muted-foreground">
                            Manage content for all frontend pages from here.
                        </p>
                    </div> */}

                {/* Main Pages */}
                {/* <div className="px-4 lg:px-6">
                        <h2 className="text-lg font-semibold mb-4">Main Pages</h2>
                        <div className="grid gap-4 md:grid-cols-3">
                            {pages.map((page) => {
                                const IconComponent = pageIcons[page.icon] || FileText;
                                return (
                                    <Card key={page.slug} className="hover:shadow-lg transition-shadow">
                                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                                            <div className="flex items-center gap-3">
                                                <div className="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10">
                                                    <IconComponent className="h-5 w-5 text-primary" />
                                                </div>
                                                <div>
                                                    <CardTitle className="text-base">{page.name}</CardTitle>
                                                    <CardDescription className="text-xs">
                                                        {page.description}
                                                    </CardDescription>
                                                </div>
                                            </div>
                                        </CardHeader>
                                        <CardContent>
                                            <div className="flex items-center justify-between">
                                                <Badge variant="secondary">
                                                    {page.sections_count} section{page.sections_count !== 1 ? 's' : ''}
                                                </Badge>
                                                <Button variant="outline" size="sm" asChild>
                                                    <Link href={`/admin/pages/${page.slug}`}>
                                                        Edit
                                                        <ArrowRight className="ml-1 h-4 w-4" />
                                                    </Link>
                                                </Button>
                                            </div>
                                        </CardContent>
                                    </Card>
                                );
                            })}
                        </div>
                    </div> */}

                {/* Category Pages */}
                <div className="px-4 lg:px-6">
                    <h2 className="text-lg font-semibold mb-4">Category Pages</h2>
                    <p className="text-muted-foreground text-sm mb-4">
                        Manage content for all frontend category pages including hero banners, products, and offers.
                    </p>
                    <div className="grid gap-4 md:grid-cols-3 lg:grid-cols-4">
                        {categories.map((category) => {
                            const IconComponent = categoryIcons[category.icon] || Folder;
                            return (
                                <Card key={category.slug} className="hover:shadow-lg transition-shadow">
                                    <Link href={`/admin/pages/category/${category.slug}`}>
                                        <CardContent className="pt-6">
                                            <div className="flex items-center justify-between">
                                                <div className="flex items-center gap-3">
                                                    <div className="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10">
                                                        <IconComponent className="h-5 w-5 text-primary" />
                                                    </div>
                                                    <span className="font-medium text-sm">{category.name}</span>
                                                </div>
                                                <Button variant="ghost" size="sm" asChild>
                                                    <ArrowRight className="h-4 w-4" />
                                                </Button>
                                            </div>
                                        </CardContent>
                                    </Link>
                                </Card>
                            );
                        })}
                    </div>
                </div>
            </div>
        </div>
    );
}

PagesIndex.layout = (page) => <AdminLayout>{page}</AdminLayout>;
