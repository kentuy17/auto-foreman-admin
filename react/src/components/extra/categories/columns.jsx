import { cn } from "@/lib/utils";
import { DataTableColumnHeader } from "./data-table-column-header";
import { Badge } from "@ui/badge";
import { AlertDialogDemo } from "./delete-categories";
import { DialogDemo } from "./edit-categories";
import {
  ArrowDownIcon,
  ArrowRightIcon,
  ArrowUpIcon,
  CheckCircledIcon,
  CheckIcon,
  Cross1Icon,
  CrossCircledIcon,
  QuestionMarkCircledIcon,
} from "@radix-ui/react-icons";

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
    value: "Approved",
    label: "Approved",
    icon: CheckCircledIcon,
  },
  {
    value: "Pending",
    label: "Pending",
    icon: QuestionMarkCircledIcon,
  },
  {
    value: "Rejected",
    label: "Rejected",
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

const getIconColor = (value) => {
  switch (value) {
    case "Approved":
      return "text-green-500";
    case "Pending":
      return "text-yellow-500";
    case "Rejected":
      return "text-red-500";
    default:
      return "text-gray-500";
  }
};

const handleApprove = (row) => {
  console.log(row, "approve");
};

const handleReject = (row) => {
  console.log(row, "reject");
};

export const columns = [
  {
    accessorKey: "id",
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title="ID" />
    ),
    cell: ({ row }) => <div className="w-[80px]">{row.getValue("id")}</div>,
    enableSorting: false,
    enableHiding: false,
  },
  {
    accessorKey: "name",
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title="MySQL" />
    ),
    cell: ({ row }) => {
      const label = labels.find((label) => label.value === row.original.label);

      return (
        <div className="flex space-x-2">
          {label && <Badge variant="outline">{label.label}</Badge>}
          <span className="max-w-[500px] truncate">{row.getValue("name")}</span>
        </div>
      );
    },
  },
  {
    accessorKey: "description",
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title="Description" />
    ),
    cell: ({ row }) => {
      const label = labels.find((label) => label.value === row.original.label);

      return (
        <div className="flex space-x-2">
          {label && <Badge variant="outline">{label.label}</Badge>}
          <span className="max-w-[500px] truncate">
            {row.getValue("description")}
          </span>
        </div>
      );
    },
  },
  {
    accessorKey: "is_productive",
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title="Is Productive" />
    ),
    cell: ({ row }) => {
      return (
        <div className="flex items-center">
          <span>{row.getValue("is_productive")}</span>
        </div>
      );
    },
    filterFn: (row, id, value) => {
      return value.includes(row.getValue(id));
    },
  },
  {
    accessorKey: "header_name",
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title="Header Name" />
    ),
    cell: ({ row }) => {
      return (
        <div className="flex items-center">
          <span>{row.getValue("header_name")}</span>
        </div>
      );
    },
    filterFn: (row, id, value) => {
      return value.includes(row.getValue(id));
    },
  },
  {
    accessorKey: "icon",
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title="Icon" />
    ),
    cell: ({ row }) => {
      return (
        <div className="flex items-center w-[100px]">
          <img
            className="aspect-square h-6 w-6 items-center"
            alt=""
            src={`/icons/${row.getValue("icon")}`}
          />
        </div>
      );
    },
    filterFn: (row, id, value) => {
      return value.includes(row.getValue(id));
    },
  },
  {
    accessorKey: "abbreviation",
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title="Abbreviation" />
    ),
    cell: ({ row }) => {
      return (
        <div className="flex items-center">
          <span>{row.getValue("abbreviation")}</span>
        </div>
      );
    },
    filterFn: (row, id, value) => {
      return value.includes(row.getValue(id));
    },
  },
  {
    accessorKey: "priority_id",
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title="Priority Id" />
    ),
    cell: ({ row }) => {
      return (
        <div className="flex items-center">
          <span>{row.getValue("priority_id")}</span>
        </div>
      );
    },
    filterFn: (row, id, value) => {
      return value.includes(row.getValue(id));
    },
  },
  {
    accessorKey: "updated_at",
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title="Updated At" />
    ),
    cell: ({ row }) => {
      return (
        <div className="flex items-center">
          <span>{row.getValue("updated_at")}</span>
        </div>
      );
    },
    filterFn: (row, id, value) => {
      return value.includes(row.getValue(id));
    },
  },
  {
    accessorKey: "created_at",
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title="Updated At" />
    ),
    cell: ({ row }) => {
      return (
        <div className="flex items-center">
          <span>{row.getValue("created_at")}</span>
        </div>
      );
    },
    filterFn: (row, id, value) => {
      return value.includes(row.getValue(id));
    },
  },
  {
    id: "actions",
    header: ({ column }) => (
      <DataTableColumnHeader column={column} title="Action" />
    ),
    cell: ({ row }) => {
      return (
        <div className="flex space-x-2 my-2">
          <DialogDemo
            id={row.getValue("id")}
            name={row.getValue("name")}
            description={row.getValue("description")}
            is_productive={row.getValue("is_productive")}
            header_name={row.getValue("header_name")}
            icon={row.getValue("icon")}
            abbreviation={row.getValue("abbreviation")}
            priority_id={row.getValue("priority_id")}
            updated_at={row.getValue("updated_at")}
            created_at={row.getValue("created_at")}
          />
          <AlertDialogDemo id={row.getValue("id")} />
        </div>
      );
    },
  },
];
