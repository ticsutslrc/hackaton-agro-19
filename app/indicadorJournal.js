$(function () {

    // leer variable y concatenar a ruta
     function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

    var unidad = getParameterByName("unidad")

    $("#Table").bootstrapTable({
            classes: "table",
            url:"http://192.168.43.89:5460/hack/api/unitofwork/"+unidad+"/journal",
            search:true,
            columns: [
                {
                    field: "idjornada",
                    title: "ID"
                }, {
                    field: "referencia",
                    title: "Referencia",
                    formatter: function(val, row) {
                        return "<a href='./indicadorJornaleros.html?unidad=" + row["idjornada"] + "'>" + val + "</a>"
                    }
                }, {
                    field: "descripcion",
                    title: "Descripcion"
                }, {
                    field: "inicio",
                    title: "Fecha de Inicio",
                    align: "right"
                }, {
                    field: "final",
                    title: "Fecha Final",
                    align: "right"
                },
            ],
        }
    )
})