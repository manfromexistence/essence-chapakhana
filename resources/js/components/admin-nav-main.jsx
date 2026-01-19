import * as React from "react"
import { Link, usePage } from "@inertiajs/react"
import { ChevronRight } from "lucide-react"

import {
    SidebarGroup,
    SidebarGroupContent,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarMenuSub,
    SidebarMenuSubButton,
    SidebarMenuSubItem,
} from "@/components/ui/sidebar"

const STORAGE_KEY = 'admin_sidebar_open_items'

export function AdminNavMain({ items }) {
    const { url } = usePage()
    
    // Initialize state from localStorage
    const [openItems, setOpenItems] = React.useState(() => {
        if (typeof window !== 'undefined') {
            const stored = localStorage.getItem(STORAGE_KEY)
            if (stored) {
                try {
                    return JSON.parse(stored)
                } catch (e) {
                    return {}
                }
            }
        }
        return {}
    })

    // Auto-expand parent menu if current URL matches a sub-item
    React.useEffect(() => {
        items.forEach(item => {
            if (item.items && item.items.length > 0) {
                const hasActiveSubItem = item.items.some(subItem => url.startsWith(subItem.url))
                if (hasActiveSubItem && !openItems[item.title]) {
                    setOpenItems(prev => {
                        const newState = { ...prev, [item.title]: true }
                        localStorage.setItem(STORAGE_KEY, JSON.stringify(newState))
                        return newState
                    })
                }
            }
        })
    }, [url, items])

    const toggleItem = (title) => {
        setOpenItems(prev => {
            const newState = {
                ...prev,
                [title]: !prev[title]
            }
            // Persist to localStorage
            localStorage.setItem(STORAGE_KEY, JSON.stringify(newState))
            return newState
        })
    }

    return (
        <SidebarGroup>
            <SidebarGroupLabel>Main Navigation</SidebarGroupLabel>
            <SidebarGroupContent>
                <SidebarMenu>
                    {items.map((item) => {
                        const isActive = url.startsWith(item.url)
                        const hasSubItems = item.items && item.items.length > 0
                        const isOpen = openItems[item.title]

                        return (
                            <SidebarMenuItem key={item.title}>
                                {hasSubItems ? (
                                    <>
                                        <SidebarMenuButton
                                            tooltip={item.title}
                                            onClick={() => toggleItem(item.title)}
                                            isActive={isActive}
                                        >
                                            {item.icon && <item.icon />}
                                            <span>{item.title}</span>
                                            <ChevronRight
                                                className={`ml-auto transition-transform ${
                                                    isOpen ? "rotate-90" : ""
                                                }`}
                                            />
                                        </SidebarMenuButton>
                                        {isOpen && (
                                            <SidebarMenuSub>
                                                {item.items.map((subItem) => {
                                                    const subIsActive = url === subItem.url
                                                    return (
                                                        <SidebarMenuSubItem key={subItem.title}>
                                                            <SidebarMenuSubButton
                                                                asChild
                                                                isActive={subIsActive}
                                                            >
                                                                <Link href={subItem.url}>
                                                                    <span>{subItem.title}</span>
                                                                </Link>
                                                            </SidebarMenuSubButton>
                                                        </SidebarMenuSubItem>
                                                    )
                                                })}
                                            </SidebarMenuSub>
                                        )}
                                    </>
                                ) : (
                                    <SidebarMenuButton
                                        asChild
                                        tooltip={item.title}
                                        isActive={isActive}
                                    >
                                        <Link href={item.url}>
                                            {item.icon && <item.icon />}
                                            <span>{item.title}</span>
                                        </Link>
                                    </SidebarMenuButton>
                                )}
                            </SidebarMenuItem>
                        )
                    })}
                </SidebarMenu>
            </SidebarGroupContent>
        </SidebarGroup>
    )
}
