$(function () {
    $("#Table").bootstrapTable({
            classes: "table",
            url:"http://localhost:86/hack/api/supervisor",
            search:true,
            columns: [
                {
                    field: "id",
                    title: "ID"
                }, {
                    field: "nombre",
                    title: "Nombre"
                },
            ],
        }
    )
})