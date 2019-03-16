(function () {
    return {
        Scan: function () {
            console.log("Scan: ")
            var callback = function (err, contents) {
                if (err) {
                    console.error(err._message);
                }
                alert('The QR Code contains: ' + contents);
            };

            QRScanner.scan(callback);
        }
    }
})();


var done = function (err, status) {
    if (err) {
        console.error(err._message);
    } else {
        console.log('QRScanner is initialized. Status:');
        alert("scanner ",status);
    }
};
QRScanner.prepare(done);


var Scan = function () {
    var callback = function (err, contents) {
        if (err) {
            console.error(err._message);
        }
        alert('Contenedor # ' + contents);
    };
    QRScanner.scan(callback);
}
