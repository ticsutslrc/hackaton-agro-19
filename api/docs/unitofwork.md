

# Unidad de Trabajo

**New** POST /hack/api/unitofwork

**Body**
```json
{
   "referencia":"65498",
   "cantidad":"100",
   "unidadmedida":"CAJAS",
   "inicio":"2019-03-01",
   "final":"2019-03-30"
}
```

**Update** POST /hack/api/unitofwork/:id

**Body**
```json
{
   "referencia":"65498",
   "cantidad":"100",
   "unidadmedida":"CAJAS",
   "inicio":"2019-03-01",
   "final":"2019-03-30"
}
```

**Remove** DELETE /hack/api/unitofwork/:id

Reponse OK 200
```json
{
    "msg": ":id"
}
```


**List** GET /hack/api/unitofwork

Params: offset, limit, search

Response OK 200

```json

{
  "rows": [
    {
      "id": "2",
      "referencia": "6666",
      "cantidad": "100",
      "unidad": "CAJAS",
      "inicio": "2019-03-01 00:00:00",
      "final": "2019-03-30 00:00:00",
      "creada": "2019-03-15 22:32:54"
    }
  ],
  "total": "1"
}

```
