

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