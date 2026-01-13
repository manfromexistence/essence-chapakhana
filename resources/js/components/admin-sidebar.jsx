import * as React from "react"
import { Link, usePage } from "@inertiajs/react"
import {
    LayoutDashboardIcon,
    PackageIcon,
    ShoppingCartIcon,
    SettingsIcon,
    LayersIcon,
    TagIcon,
    FileTextIcon,
    ImageIcon,
    FolderIcon,
    FileEditIcon,
    HomeIcon,
    PanelTopIcon,
    PanelBottomIcon,
    FileIcon,
    WrenchIcon,
    List,
} from "lucide-react"

import { AdminNavMain } from "@/components/admin-nav-main"
import { AdminNavSecondary } from "@/components/admin-nav-secondary"
import { AdminNavUser } from "@/components/admin-nav-user"
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from "@/components/ui/sidebar"

// Navigation menu items
const navMain = [
    {
        title: "Dashboard",
        url: "/admin/dashboard",
        icon: LayoutDashboardIcon,
    },
    {
        title: "Home Page",
        url: "/admin/pages/home",
        icon: HomeIcon,
    },
    {
        title: "Order Management",
        url: "/admin/orders",
        icon: FileTextIcon,
    },
    {
        title: "Product Management",
        url: "/admin/products",
        icon: List,
    },
    {
        title: "Shop Management",
        url: "/admin/shop",
        icon: ShoppingCartIcon,
    },
    {
        title: "Header",
        url: "/admin/pages/header",
        icon: PanelTopIcon,
    },
    {
        title: "Footer",
        url: "/admin/pages/footer",
        icon: PanelBottomIcon,
    },
    {
        title: "Category Pages",
        url: "/admin/pages",
        icon: FileIcon,
    },
]

const navSecondary = [
    // {
    //     title: "Shop Hero",
    //     url: "/admin/shop-hero",
    //     icon: ImageIcon,
    // },
    // {
    //     title: "Service Categories",
    //     url: "/admin/service-categories",
    //     icon: FolderIcon,
    // },
    // {
    //     title: "Service Products",
    //     url: "/admin/service-products",
    //     icon: PackageIcon,
    // },
    {
        title: "Settings",
        url: "/admin/settings",
        icon: SettingsIcon,
    },
]

export function AdminSidebar({ ...props }) {
    const { auth, site } = usePage().props

    const user = {
        name: auth?.user?.name || "Admin",
        email: auth?.user?.email || "admin@example.com",
        avatar: "",
    }

    // Initialize state from local storage or props
    const [logoSrc, setLogoSrc] = React.useState(() => {
        if (typeof window !== 'undefined') {
            const cachedLogo = localStorage.getItem('app_logo');
            // If cached logo exists, use it. Otherwise use the prop or default
            return cachedLogo || site?.logo || '/logo.png';
        }
        return site?.logo || '/logo.png';
    });

    // Update local storage and state when site.logo changes
    React.useEffect(() => {
        if (site?.logo) {
            setLogoSrc(site.logo);
            localStorage.setItem('app_logo', site.logo);
        }
    }, [site?.logo]);

    return (
        <Sidebar collapsible="icon" {...props}>
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton
                            asChild
                            className="data-[slot=sidebar-menu-button]:p-4! h-auto!"
                        >
                            <Link href="/admin/dashboard" className="flex items-center justify-center">
                                <div className="flex w-full items-center justify-center">
                                    <img
                                        src={logoSrc}
                                        alt={site?.name || 'Chapakhana'}
                                        className="w-full min-h-8 min-w-8 h-auto max-h-20 object-contain"
                                    />
                                </div>
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>
            <SidebarContent>
                <AdminNavMain items={navMain} />
                <AdminNavSecondary items={navSecondary} className="mt-auto" />
            </SidebarContent>
            <SidebarFooter>
                <AdminNavUser user={user} />
            </SidebarFooter>
        </Sidebar>
    )
}
