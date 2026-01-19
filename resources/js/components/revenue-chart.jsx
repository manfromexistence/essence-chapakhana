"use client"

import * as React from "react"
import { Area, AreaChart, Bar, BarChart, CartesianGrid, XAxis, YAxis } from "recharts"

import { useIsMobile } from "@/hooks/use-mobile"
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card"
import { ChartContainer, ChartTooltip, ChartTooltipContent } from "@/components/ui/chart";
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select"
import {
  ToggleGroup,
  ToggleGroupItem,
} from "@/components/ui/toggle-group"

const chartConfig = {
  revenue: {
    label: "Revenue",
    color: "hsl(var(--chart-1))",
  },
  orders: {
    label: "Orders",
    color: "hsl(var(--chart-2))",
  }
}

export function RevenueChart({ data = [] }) {
  const isMobile = useIsMobile()
  const [timeRange, setTimeRange] = React.useState("30d")
  const [chartType, setChartType] = React.useState("revenue")

  React.useEffect(() => {
    if (isMobile) {
      setTimeRange("7d")
    }
  }, [isMobile])

  const filteredData = React.useMemo(() => {
    if (!data || data.length === 0) return []
    
    const now = new Date()
    let daysToShow = 30
    
    if (timeRange === "7d") {
      daysToShow = 7
    } else if (timeRange === "90d") {
      daysToShow = 90
    }
    
    return data.slice(-daysToShow)
  }, [data, timeRange])

  const totalRevenue = React.useMemo(() => {
    return filteredData.reduce((sum, item) => sum + (item.revenue || 0), 0)
  }, [filteredData])

  const totalOrders = React.useMemo(() => {
    return filteredData.reduce((sum, item) => sum + (item.orders || 0), 0)
  }, [filteredData])

  return (
    <Card className="@container/card">
      <CardHeader className="relative">
        <div className="flex items-start justify-between">
          <div>
            <CardTitle>
              {chartType === "revenue" ? "Revenue Overview" : "Orders Overview"}
            </CardTitle>
            <CardDescription>
              <span className="@[540px]/card:block hidden">
                {chartType === "revenue" 
                  ? `Total revenue: ৳${totalRevenue.toLocaleString()}`
                  : `Total orders: ${totalOrders}`
                }
              </span>
              <span className="@[540px]/card:hidden">
                {chartType === "revenue" 
                  ? `৳${totalRevenue.toLocaleString()}`
                  : `${totalOrders} orders`
                }
              </span>
            </CardDescription>
          </div>
          <div className="flex flex-col gap-2 items-end">
            {/* Chart Type Toggle */}
            <ToggleGroup
              type="single"
              value={chartType}
              onValueChange={setChartType}
              variant="outline"
              className="@[540px]/card:flex hidden"
            >
              <ToggleGroupItem value="revenue" className="h-8 px-3">
                Revenue
              </ToggleGroupItem>
              <ToggleGroupItem value="orders" className="h-8 px-3">
                Orders
              </ToggleGroupItem>
            </ToggleGroup>
            
            {/* Time Range Toggle */}
            <ToggleGroup
              type="single"
              value={timeRange}
              onValueChange={setTimeRange}
              variant="outline"
              className="@[767px]/card:flex hidden"
            >
              <ToggleGroupItem value="90d" className="h-8 px-2.5">
                90 days
              </ToggleGroupItem>
              <ToggleGroupItem value="30d" className="h-8 px-2.5">
                30 days
              </ToggleGroupItem>
              <ToggleGroupItem value="7d" className="h-8 px-2.5">
                7 days
              </ToggleGroupItem>
            </ToggleGroup>
            
            {/* Mobile Selects */}
            <div className="@[767px]/card:hidden flex gap-2">
              <Select value={chartType} onValueChange={setChartType}>
                <SelectTrigger className="w-28" aria-label="Select chart type">
                  <SelectValue />
                </SelectTrigger>
                <SelectContent className="rounded-xl">
                  <SelectItem value="revenue" className="rounded-lg">
                    Revenue
                  </SelectItem>
                  <SelectItem value="orders" className="rounded-lg">
                    Orders
                  </SelectItem>
                </SelectContent>
              </Select>
              
              <Select value={timeRange} onValueChange={setTimeRange}>
                <SelectTrigger className="w-28" aria-label="Select time range">
                  <SelectValue />
                </SelectTrigger>
                <SelectContent className="rounded-xl">
                  <SelectItem value="90d" className="rounded-lg">
                    90 days
                  </SelectItem>
                  <SelectItem value="30d" className="rounded-lg">
                    30 days
                  </SelectItem>
                  <SelectItem value="7d" className="rounded-lg">
                    7 days
                  </SelectItem>
                </SelectContent>
              </Select>
            </div>
          </div>
        </div>
      </CardHeader>
      <CardContent className="px-2 pt-4 sm:px-6 sm:pt-6">
        {filteredData.length === 0 ? (
          <div className="flex h-[250px] items-center justify-center text-muted-foreground">
            No data available
          </div>
        ) : chartType === "revenue" ? (
          <ChartContainer config={chartConfig} className="aspect-auto h-[250px] w-full">
            <AreaChart data={filteredData}>
              <defs>
                <linearGradient id="fillRevenue" x1="0" y1="0" x2="0" y2="1">
                  <stop offset="5%" stopColor="var(--color-revenue)" stopOpacity={0.8} />
                  <stop offset="95%" stopColor="var(--color-revenue)" stopOpacity={0.1} />
                </linearGradient>
              </defs>
              <CartesianGrid vertical={false} strokeDasharray="3 3" opacity={0.3} />
              <XAxis
                dataKey="date"
                tickLine={false}
                axisLine={false}
                tickMargin={8}
                minTickGap={32}
                tickFormatter={(value) => {
                  const date = new Date(value)
                  return date.toLocaleDateString("en-US", {
                    month: "short",
                    day: "numeric",
                  });
                }}
              />
              <YAxis
                tickLine={false}
                axisLine={false}
                tickMargin={8}
                tickFormatter={(value) => `৳${value}`}
              />
              <ChartTooltip
                cursor={false}
                content={
                  <ChartTooltipContent
                    labelFormatter={(value) => {
                      return new Date(value).toLocaleDateString("en-US", {
                        month: "short",
                        day: "numeric",
                        year: "numeric",
                      });
                    }}
                    formatter={(value) => `৳${value.toLocaleString()}`}
                    indicator="dot"
                  />
                }
              />
              <Area
                dataKey="revenue"
                type="monotone"
                fill="url(#fillRevenue)"
                stroke="var(--color-revenue)"
                strokeWidth={2}
              />
            </AreaChart>
          </ChartContainer>
        ) : (
          <ChartContainer config={chartConfig} className="aspect-auto h-[250px] w-full">
            <BarChart data={filteredData}>
              <CartesianGrid vertical={false} strokeDasharray="3 3" opacity={0.3} />
              <XAxis
                dataKey="date"
                tickLine={false}
                axisLine={false}
                tickMargin={8}
                minTickGap={32}
                tickFormatter={(value) => {
                  const date = new Date(value)
                  return date.toLocaleDateString("en-US", {
                    month: "short",
                    day: "numeric",
                  });
                }}
              />
              <YAxis
                tickLine={false}
                axisLine={false}
                tickMargin={8}
              />
              <ChartTooltip
                cursor={false}
                content={
                  <ChartTooltipContent
                    labelFormatter={(value) => {
                      return new Date(value).toLocaleDateString("en-US", {
                        month: "short",
                        day: "numeric",
                        year: "numeric",
                      });
                    }}
                    formatter={(value) => `${value} orders`}
                    indicator="dot"
                  />
                }
              />
              <Bar
                dataKey="orders"
                fill="var(--color-orders)"
                radius={[4, 4, 0, 0]}
              />
            </BarChart>
          </ChartContainer>
        )}
      </CardContent>
    </Card>
  );
}
