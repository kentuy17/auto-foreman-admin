import { DashboardContextProvider } from "@/context/DashboardContextProvider";
import { Separator } from "@ui/separator";
import { columns } from "@/components/extra/categories/columns";
import { DataTable } from "@/components/extra/categories/data-table";
import { useEffect, useState } from "react";
import axiosClient from "./axios-client";
import moment from "moment";

const Categorization = () => {
  const [data, setData] = useState([]);

  useEffect(() => {
    axiosClient
      .get("/categories")
      .then(async ({ data }) => {
        let tmpData = [];
        await data.data.forEach((item) => {
          tmpData.push({
            id: item.id,
            name: item.name,
            description: item.description,
            is_productive: item.is_productive,
            header_name: item.header_name,
            icon: item.icon,
            abbreviation: item.abbreviation,
            priority_id: item.priority_id,
            updated_at:
              item.updated_at ??
              moment(item.updated_at).format("YYYY-MM-DD HH:mm:ss"),
            created_at: item.created_at
              ? moment(item.created_at).format("YYYY-MM-DD HH:mm:ss")
              : null,
          });
        });
        setData(tmpData);
      })
      .catch((err) => console.log(err));
  }, []);

  return (
    <DashboardContextProvider>
      <div className="h-full px-4 py-6 lg:px-8">
        <div className="flex items-center justify-between">
          <div className="space-y-1">
            <h2 className="text-2xl font-semibold tracking-tight">
              Categorization
            </h2>
          </div>
        </div>
        <Separator className="my-4" />
        <div className="relative">
          <div className="hidden h-full flex-1 flex-col space-y-8 p-8 md:flex">
            <DataTable data={data} columns={columns} />
          </div>
        </div>
      </div>
    </DashboardContextProvider>
  );
};

export default Categorization;
