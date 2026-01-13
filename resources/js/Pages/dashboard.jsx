import AdminLayout from '@/Layouts/AdminLayout';
import { ChartAreaInteractive } from "@/components/chart-area-interactive"
import { DataTable } from "@/components/data-table"
import { AdminSectionCards } from "@/components/admin-section-cards"

export default function Dashboard({ stats }) {
  return (
    <div className="flex flex-1 flex-col">
      <div className="@container/main flex flex-1 flex-col gap-2">
        <div className="flex flex-col gap-4 py-4 md:gap-6 md:py-6">
          <AdminSectionCards stats={stats} />
          <div className="px-4 lg:px-6">
            <ChartAreaInteractive />
          </div>
          <DataTable data={stats?.recentOrders || []} tabStorageKey="admin-dashboard-datatable-tab" />
        </div>
      </div>
    </div>
  );
}

Dashboard.layout = (page) => <AdminLayout title="Dashboard">{page}</AdminLayout>
