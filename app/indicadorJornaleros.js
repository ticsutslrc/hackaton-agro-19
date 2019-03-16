$(function () {
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
            url:"http://localhost:86/hack/api/journal/"+unidad+"/foreman",
            search:true,
            columns: [
                {
                    field: "id",
                    title: "ID"
                }, {
                    field: "nombre",
                    title: "Nombre"
                }, {
                    field: "nacimiento",
                    title: "Nacimiento"
                },
            ],
        }
    )
})