$(function () {
    $("#Table").bootstrapTable({
            classes: "table",
            url:"http://localhost:86/hack/api/unitofwork/{id}/journal",
            search:true,
            columns: [
                {
                    field: "id",
                    title: "ID"
                }, {
                    field: "referencia",
                    title: "Referencia"
                }, {
                    field: "descripcion",
                    title: "Descripcion"
                }, {
                    field: "inicio",
                    title: "Unidad",
                    align: "right",
                }, {
                    field: "fin",
                    title: "Fecha de Inicio",
                    align: "right",
                }, {
                    field: "idsupervisor",
                    title: "Fecha Final",
                    align: "right",
                },{
                    field: "idlote",
                    title: "Fecha Final",
                    align: "right",
                },
            ],
        }
    )
})