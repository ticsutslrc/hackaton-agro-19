
# Jornada

**New** POST /hack/api/journal

**Body**
```json
{
  "numparcela": "005-66",
  "descripcion": "Parcela km 34 carretera a cd victoria",
  "inicio": "2019-03-16 11:02:56",
  "fin": "2019-03-16 11:02:56",
  "idsupervisor": "1",
  "jornaleros": [
    {
      "id": "1",
      "nombre": "Juan Perez",
      "nacimiento": "1980-05-06",
      "folioinicial": "0000",
      "foliofinal": "0050",
      "contenedores": [
        {
          "folio": "0005",
          "completado": "2019-03-03 8:04:02"
        },
        {
          "folio": "0008",
          "completado": "2019-03-03 8:14:35"
        },
        {
          "folio": "0015",
          "completado": "2019-03-03 9:25:42"
        }
      ]
    },
    {
      "id": "2",
      "nombre": "Pepe Perez",
      "nacimiento": "1990-09-01",
      "folioinicial": "0051",
      "foliofinal": "0100",
      "contenedores": [
        {
          "folio": "0045",
          "completado": "2019-03-03 8:05:06"
        },
        {
          "folio": "0068",
          "completado": "2019-03-03 8:11:14"
        }
      ]
    },
    {
      "id": null,
      "nombre": "Manuel Perez",
      "nacimiento": "1990-09-01",
      "folioinicial": "0101",
      "foliofinal": "0200",
      "contenedores": [
        {
          "folio": "0125",
          "completado": "2019-03-03 8:15:06"
        },
        {
          "folio": "0148",
          "completado": "2019-03-03 8:19:52"
        },
        {
          "folio": "0116",
          "completado": "2019-03-03 9:25:36"
        }
      ]
    }
  ]
}
```