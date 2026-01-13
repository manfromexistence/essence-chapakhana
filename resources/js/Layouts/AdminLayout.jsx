import { usePage } from '@inertiajs/react';
import { AdminSidebar } from '@/components/admin-sidebar';
import { AdminSiteHeader } from '@/components/admin-site-header';
import { SidebarInset, SidebarProvider } from '@/components/ui/sidebar';
import { useEffect } from 'react';
import { toast } from 'sonner';

export default function AdminLayout({ children, title, breadcrumbs }) {
    const { flash } = usePage().props;

    useEffect(() => {
        if (flash?.success) {
            toast.success(flash.success);
        }
        if (flash?.error) {
            toast.error(flash.error);
        }
    }, [flash]);

    return (
        <SidebarProvider>
            <AdminSidebar variant="inset" />
            <SidebarInset>
                <AdminSiteHeader title={title} breadcrumbs={breadcrumbs} />
                <div className="flex flex-1 flex-col">
                    <main className="flex-1 p-4 lg:p-6">{children}</main>
                </div>
            </SidebarInset>
        </SidebarProvider>
    );
}