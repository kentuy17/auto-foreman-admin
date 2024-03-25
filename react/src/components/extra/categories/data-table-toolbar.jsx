import { Cross2Icon } from "@radix-ui/react-icons";

import { Button } from "@ui/button";
import { Input } from "@ui/input";
import { DataTableViewOptions } from "./data-table-view-options";

import { DataTableFacetedFilter } from "./data-table-faceted-filter";

import { DialogAdd } from "./add";

export function DataTableToolbar({ table }) {
  const isFiltered = table.getState().columnFilters.length > 0;

  return (
    <div className="flex items-center justify-between">
      <div className="flex flex-1 items-center space-x-2">
        {/* <Input
          placeholder="Filter by employee ID..."
          value={table.getColumn("employeeId")?.getFilterValue() ?? ""}
          onChange={(event) =>
            table.getColumn("employeeId")?.setFilterValue(event.target.value)
          }
          className="h-8 w-[150px] lg:w-[250px]"
        /> */}
        <Input
          placeholder="Search Employee..."
          value={table.getColumn("name")?.getFilterValue() ?? ""}
          onChange={(event) =>
            table.getColumn("name")?.setFilterValue(event.target.value)
          }
          className="h-8 w-[150px] lg:w-[250px]"
        />{" "}
        {table.getColumn("abbreviation") && (
          <DataTableFacetedFilter
            column={table.getColumn("abbreviation")}
            title="Abbreviation"
            options={[
              { value: "Productive", label: "Productive" },
              { value: "Unproductive", label: "Unproductive" },
              { value: "Others", label: "Others" },
            ]}
          />
        )}
        {
          <DialogAdd />
        }
        {isFiltered && (
          <Button
            variant="ghost"
            onClick={() => table.resetColumnFilters()}
            className="h-8 px-2 lg:px-3"
          >
            Reset
            <Cross2Icon className="ml-2 h-4 w-4" />
          </Button>
        )}
      </div>
      <DataTableViewOptions table={table} />
    </div>
  );
}
