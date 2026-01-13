import { TrendingDownIcon, TrendingUpIcon, PackageIcon, ShoppingCartIcon, LayersIcon, DollarSignIcon } from "lucide-react"

import { Badge } from "@/components/ui/badge"
import {
    Card,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/components/ui/card"

export function AdminSectionCards({ stats }) {
    const cards = [
        {
            title: "Total Orders",
            value: stats?.totalOrders || 0,
            trend: "+12.5%",
            trendUp: true,
            footer: "Order volume this month",
            subFooter: "Compared to last month",
            icon: ShoppingCartIcon,
        },
        {
            title: "Total Products",
            value: stats?.totalProducts || 0,
            trend: "+3",
            trendUp: true,
            footer: "Products in catalog",
            subFooter: "Active product listings",
            icon: PackageIcon,
        },
        {
            title: "Total Categories",
            value: stats?.totalCategories || 0,
            trend: "+2",
            trendUp: true,
            footer: "Category organization",
            subFooter: "Product categories active",
            icon: LayersIcon,
        },
        {
            title: "Revenue",
            value: `Rs. ${(stats?.totalRevenue || 0).toLocaleString()}`,
            trend: "+8.2%",
            trendUp: true,
            footer: "Revenue growth",
            subFooter: "Total sales this period",
            icon: DollarSignIcon,
        },
    ]

    return (
        <div className="*:data-[slot=card]:shadow-xs @xl/main:grid-cols-2 @5xl/main:grid-cols-4 grid grid-cols-1 gap-4 px-4 *:data-[slot=card]:bg-gradient-to-t *:data-[slot=card]:from-primary/5 *:data-[slot=card]:to-card dark:*:data-[slot=card]:bg-card lg:px-6">
            {cards.map((card, index) => (
                <Card key={index} className="@container/card">
                    <CardHeader className="relative">
                        <CardDescription className="flex items-center gap-2">
                            <card.icon className="size-4" />
                            {card.title}
                        </CardDescription>
                        <CardTitle className="@[250px]/card:text-3xl text-2xl font-semibold tabular-nums">
                            {card.value}
                        </CardTitle>
                        <div className="absolute right-4 top-4">
                            <Badge variant="outline" className="flex gap-1 rounded-lg text-xs">
                                {card.trendUp ? (
                                    <TrendingUpIcon className="size-3" />
                                ) : (
                                    <TrendingDownIcon className="size-3" />
                                )}
                                {card.trend}
                            </Badge>
                        </div>
                    </CardHeader>
                    <CardFooter className="flex-col items-start gap-1 text-sm">
                        <div className="line-clamp-1 flex gap-2 font-medium">
                            {card.footer}
                            {card.trendUp ? (
                                <TrendingUpIcon className="size-4" />
                            ) : (
                                <TrendingDownIcon className="size-4" />
                            )}
                        </div>
                        <div className="text-muted-foreground">{card.subFooter}</div>
                    </CardFooter>
                </Card>
            ))}
        </div>
    )
}
