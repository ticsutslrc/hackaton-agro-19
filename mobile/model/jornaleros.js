var JornalerosModel = Backbone.Model.extend({

    localStorageID: 'jornaleros',

    initialize: function (options) {
        var self = this;
        this.listenTo(this, 'change', this.saveLocalStorage);
        if (this.getLocalStorage()) this._setData();
        if (window.addEventListener) window.addEventListener("storage", function () {
            self._setData()
        }, false);
        else window.addEventListener("onstorage", function () {
            self._setData()
        });
    },

    saveLocalStorage: function (model) {
        localStorage.setItem(this.localStorageID, JSON.stringify(model.toJSON()))
    },

    getLocalStorage: function () {
        return JSON.parse(localStorage.getItem(this.localStorageID));

    },

    _clear: function () {
        localStorage.removeItem(this.localStorageID);
    },

    _setData: function () {
        this.set(this.getLocalStorage());
    },

    defaults: {
        "id": null,
        "nombre": "",
        "nacimiento": "",
        "folioinicial": "",
        "foliofinal": "",
        "contenedores": []
    },
});