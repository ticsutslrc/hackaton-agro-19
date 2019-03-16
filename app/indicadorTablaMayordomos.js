$(function () {
    $("#Table").bootstrapTable({
            classes: "table",
            url:"http://192.168.43.89:5460/hack/api/supervisor",
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