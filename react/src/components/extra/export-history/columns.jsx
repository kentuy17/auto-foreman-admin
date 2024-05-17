import { Badge } from "@ui/badge";
import { Checkbox } from "@ui/checkbox";

import { DataTableColumnHeader } from "./data-table-column-header";
import { DataTableRowActions } from "./data-table-row-actions"

import {
  ArrowDownIcon,
  ArrowRightIcon,
  ArrowUpIcon,
  CheckCircledIcon,
  CircleIcon,
  CrossCircledIcon,
  QuestionMarkCircledIcon,
  StopwatchIcon,
} from "@radix-ui/react-icons";
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { Progress } from '@/components/ui/progress';
import { useEffect, useState } from 'react';
import { echoInstance } from '@/lib/echo';
import { cn } from '@/lib/utils';

const labels = [
  {
    value: "bug",
    label: "Bug",
  },
  {
    value: "feature",
    label: "Feature",
  },
  {
    value: "documentation",
    label: "Documentation",
  },
];

export const statuses = [
  {
    value: "Inactive",
    label: "Inactive",
    icon: CircleIcon,
  },
  {
    value: "Break",
    label: "Break",
    icon: QuestionMarkCircledIcon,
  },
  {
    value: "pending",
    label: "Pending",
    icon: StopwatchIcon,
  },
  {
    value: "completed",
    label: "Completed",
    icon: CheckCircledIcon,
  },
  {
    value: "failed",
    label: "Failed",
    icon: CrossCircledIcon,
  },
];

export const priorities = [
  {
    label: "Low",
    value: "low",
    icon: ArrowDownIcon,
  },
  {
    label: "Medium",
    value: "medium",
    icon: ArrowRightIcon,
  },
  {
    label: "High",
    value: "high",
    icon: ArrowUpIcon,
  },
];

function ProgressLoader({ item }) {
  const butaw = 100 / item.item_count;
  const [percentage, setPercentage] = useState(0)

  useEffect(() => {
    echoInstance.channel('export')
      .listen('ReportExported', (e) => {
        let processedFile = e.user;
        if ((processedFile.export_id === item.id) && (percentage < 100)) {
          setPercentage(butaw * processedFile.items_completed)
        }
      })
  }, [])

  console.log(percentage, 'percentage');

  return percentage < 100 ? <Progress className='border' value={percentage} /> : 'completed';
}

export const columns = [
  {
    id: "select",
    header: ({ table }) => (
      <Checkbox
        checked={
          table.getIsAllPageRowsSelected() ||
          (table.getIsSomePageRowsSelected() && "indeterminate")
        }
        onCheckedChange={(value) => table.toggleAllPageRowsSelected(!!value)}
        aria-label="Select all"
        className="translate-y-[2px]"
      />
    ),
    cell: ({ row }) => (
      <Checkbox
        checked={row.getIsSelected()}
        onCheckedChange={(value) => row.toggleSelected(!!value)}
        aria-label="Select row"
        className="translate-y-[2px]"
      />
    ),
    enableSorting: false,
    enableHiding: false,
  },
  {
    accessorKey: "id",
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title="File/Progress" />
    ),
    cell: ({ row }) => (
      // <div className="w-[80px]">{`${row.original.employees.length} / ${row.original.employees.length}`}</div>
      <div className="flex gap-0 flex-row justify-start">
        {row.original.status === 'completed' ? (
          <div className='flex flex-row'>
            <Avatar className="flex items-center justify-center">
              <AvatarImage
                className="h-6 w-6"
                src={'/icons/excel.png'}
                alt={row.original.id}
              />
              <AvatarFallback>
                {row.original.id}
              </AvatarFallback>
            </Avatar>
            <span className='grid content-center'>{`${row.original.employees.length} / ${row.original.employees.length}`}</span>
          </div>

        ) : row.original.status === 'failed' ? (<span className='text-primary'>Failed</span>) : (
          <ProgressLoader item={row.original} />
        )}


      </div>
    ),
    enableSorting: false,
    enableHiding: false,
  },
  {
    accessorKey: "team_name",
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title="Team" />
    ),
    cell: ({ row }) => {
      const label = labels.find((label) => label.value === row.original.label);
      const teamName = row.getValue("team_name") ?? 'undefined';
      return (
        <div className="flex space-x-2">
          {label && <Badge variant="outline">{label.label}</Badge>}
          <span className={cn("max-w-[500px] truncate font-medium", teamName === 'undefined' ? 'italic' : 'non-italic')}>
            {teamName}
          </span>
        </div>
      );
    },
  },
  {
    accessorKey: "status",
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title="Status" />
    ),
    cell: ({ row }) => {
      const status = statuses.find(
        (status) => status.value === row.getValue("status")
      );

      if (!status) {
        return null;
      }

      return (
        <div className="flex w-[100px] items-center">
          {status.icon && (
            <status.icon className="mr-2 h-4 w-4 text-muted-foreground" />
          )}
          {/* <span>{status.label}</span> */}
        </div>
      );
    },
    filterFn: (row, id, value) => {
      return value.includes(row.getValue(id));
    },
  },
  {
    accessorKey: "type",
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title="Type" />
    ),
    cell: ({ row }) => {
      return (
        <div className="flex items-center">
          <span>{row.getValue("type")}</span>
        </div>
      );
    },
    filterFn: (row, id, value) => {
      return value.includes(row.getValue(id));
    },
  },
  {
    id: "actions",
    cell: ({ row }) => <DataTableRowActions row={row} />,
  },
];
