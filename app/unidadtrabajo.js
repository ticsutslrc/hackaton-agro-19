
$(function () {
    var txtReferencia = $("#txtreferencia");
    var txtCantidad = $("#txtcantidad");
    var txtUnidad = $("#sell");
    var txtInicio = $ ("#txtinicio");
    var txtFinal = $("#txtfinal");

    $("#newunidadtrabajo").on("submit", function (e) {
        e.preventDefault();
        console.log(txtReferencia.val(), txtCantidad.val() ,txtInicio.val(),txtFinal.val())
        $.post("http://localhost:85/hack/api/unitofwork", JSON.stringify({
            "referencia":txtReferencia.val(),
            "cantidad":txtCantidad.val(),
            "unidadmedida":txtUnidad.val(),
            "inicio":txtInicio.val(),
            "final":txtFinal.val()
        }))
            .done(function (res) {
                $("#result").text(res.id)
            })
    })
})
