$(function () {
    var txtparcela = $("#txtNumParcela");
    // var txtReferencia = $("#txtReferencia");
    var txtDescripcion = $("#txtDescripcion");

    $("#frmParcela").on('submit', function (e) {
        e.preventDefault();
       var jornada = new JornadaModel();
       jornada.set("numparcela", txtparcela.val());
       jornada.set("descripcion", txtDescripcion.val());
       jornada.set("inicio", new Date());
       // jornada.save();
    })
});