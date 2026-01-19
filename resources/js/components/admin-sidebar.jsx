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
        items: [
            { title: "Magazines", url: "/admin/pages/category/magazines" },
            { title: "Books", url: "/admin/pages/category/books" },
            { title: "Catalogs", url: "/admin/pages/category/catalogs" },
            { title: "Marketing Material", url: "/admin/pages/category/brochures" },
            { title: "Business Cards", url: "/admin/pages/category/business-cards" },
            { title: "Invitation & Stationery", url: "/admin/pages/category/postcards-invitations" },
            { title: "Banners", url: "/admin/pages/category/banners" },
            { title: "Promotional Items", url: "/admin/pages/category/promotional-items" },
            { title: "Stickers", url: "/admin/pages/category/stickers" },
            { title: "Booklets", url: "/admin/pages/category/booklets" },
            { title: "Stationery", url: "/admin/pages/category/stationery" },
        ],
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
    const sidebarContentRef = React.useRef(null)

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

    // Restore scroll position on mount
    React.useEffect(() => {
        if (sidebarContentRef.current && typeof window !== 'undefined') {
            const savedScrollPos = localStorage.getItem('admin_sidebar_scroll')
            if (savedScrollPos) {
                sidebarContentRef.current.scrollTop = parseInt(savedScrollPos, 10)
            }
        }
    }, [])

    // Save scroll position on scroll
    React.useEffect(() => {
        const handleScroll = () => {
            if (sidebarContentRef.current && typeof window !== 'undefined') {
                localStorage.setItem('admin_sidebar_scroll', sidebarContentRef.current.scrollTop.toString())
            }
        }

        const contentElement = sidebarContentRef.current
        if (contentElement) {
            contentElement.addEventListener('scroll', handleScroll)
            return () => contentElement.removeEventListener('scroll', handleScroll)
        }
    }, [])

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
            <SidebarContent ref={sidebarContentRef}>
                <AdminNavMain items={navMain} />
                <AdminNavSecondary items={navSecondary} className="mt-auto" />
            </SidebarContent>
            <SidebarFooter>
                <AdminNavUser user={user} />
            </SidebarFooter>
        </Sidebar>
    )
}
