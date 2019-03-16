$(function () {
    $("#Table").bootstrapTable({
            classes: "table",
        url:"http://localhost:86/hack/api/unitofwork",
        search:true,
            columns: [
                {
                    field: "id",
                    title: "ID"
                }, {
                    field: "referencia",
                    title: "Referencia",
                    formatter: function(val, row){
                        return "<a href='./indicadorJournal.html?unidad="+row["id"]+"'>"+val+"</a>"
                    }
                }, {
                    field: "cantidad",
                    title: "Cantidad"
                }, {
                    field: "unidad",
                    title: "Unidad",
                    align: "right",
                }, {
                    field: "inicio",
                    title: "Fecha de Inicio",
                    align: "right",
                }, {
                    field: "final",
                    title: "Fecha Final",
                    align: "right",
                },
            ],
        }
    )
})