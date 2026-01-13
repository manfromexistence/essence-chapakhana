import * as React from "react"
import { usePage, Link } from "@inertiajs/react"
import { Separator } from "@/components/ui/separator"
import { SidebarTrigger } from "@/components/ui/sidebar"
import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbPage,
    BreadcrumbSeparator,
} from "@/components/ui/breadcrumb"

export function AdminSiteHeader({ title, breadcrumbs = [] }) {
    const { url } = usePage()

    // Generate default breadcrumbs from URL if not provided
    const defaultBreadcrumbs = () => {
        const parts = url.split('/').filter(Boolean)
        const crumbs = []
        let path = ''

        parts.forEach((part, index) => {
            path += `/${part}`
            const isLast = index === parts.length - 1
            crumbs.push({
                label: part.charAt(0).toUpperCase() + part.slice(1).replace(/-/g, ' '),
                href: isLast ? undefined : path,
            })
        })

        return crumbs
    }

    const finalBreadcrumbs = breadcrumbs.length > 0 ? breadcrumbs : defaultBreadcrumbs()

    return (
        <header className="flex h-14 shrink-0 items-center gap-2 border-b bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
            <div className="flex w-full items-center gap-1 px-4 lg:gap-2 lg:px-6">
                <SidebarTrigger className="-ml-1" />
                <Separator orientation="vertical" className="mx-2 data-[orientation=vertical]:h-4" />
                <Breadcrumb>
                    <BreadcrumbList>
                        {finalBreadcrumbs.map((crumb, index) => (
                            <React.Fragment key={index}>
                                {index > 0 && <BreadcrumbSeparator />}
                                <BreadcrumbItem>
                                    {crumb.href ? (
                                        <BreadcrumbLink asChild>
                                            <Link href={crumb.href}>
                                                {crumb.label}
                                            </Link>
                                        </BreadcrumbLink>
                                    ) : (
                                        <BreadcrumbPage>{crumb.label}</BreadcrumbPage>
                                    )}
                                </BreadcrumbItem>
                            </React.Fragment>
                        ))}
                    </BreadcrumbList>
                </Breadcrumb>
                {title && (
                    <>
                        <Separator orientation="vertical" className="mx-2 data-[orientation=vertical]:h-4" />
                        <h1 className="text-base font-medium">{title}</h1>
                    </>
                )}
            </div>
        </header>
    )
}
