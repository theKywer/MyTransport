# === Обёртка: curl + JSON форматирование + HTTP статус ===
JSON_CURL = ./curl-json

API_URL=http://localhost:8080/api
API_TOKEN=1|QlQ2xu9e6kRQuIBLBUk3bgP85fbzrGTK0z6ZVYBOb6d5adcb

# =========================================================================================================
# TRANSPORT
# =========================================================================================================

transport-create:
	$(JSON_CURL) -X POST "$(API_URL)/transport"\
		-H "Accept: application/json"\
		-H "Content-Type: application/json"\
		-H "Authorization: Bearer $(API_TOKEN)"\
		-d '{"type_id": 1, "name": "Шкодина", "vin": "TMBAC4NE7D0041187", "year": 2013, "brand": "Skoda", "model": "Octavia"}'

transport-list:
	$(JSON_CURL) -X GET "$(API_URL)/transport"\
		-H "Accept: application/json"\
		-H "Content-Type: application/json"\
		-H "Authorization: Bearer $(API_TOKEN)"

transport-update:
	$(JSON_CURL) -X PUT "$(API_URL)/transport"\
		-H "Accept: application/json"\
		-H "Content-Type: application/json"\
		-H "Authorization: Bearer $(API_TOKEN)"\
		-d '{"id": 1, "type_id": 1}'

transport-delete:
	$(JSON_CURL) -X DELETE "$(API_URL)/transport/1"\
		-H "Accept: application/json"\
		-H "Content-Type: application/json"\
		-H "Authorization: Bearer $(API_TOKEN)"








# =========================================================================================================
# EVENT
# =========================================================================================================

event-create:
	$(JSON_CURL) -X POST "$(API_URL)/event"\
		-H "Accept: application/json"\
		-H "Content-Type: application/json"\
		-H "Authorization: Bearer $(API_TOKEN)"\
		-d '{
  "transport_id": 1,
  "type_id": 5,
  "mileage": 100000,
  "work": 5000,
  "resources": 150000,
  "total": 20000,
  "description": "ТО 3",
  "details": [
    {
      "name": "Замена свечей",
	  "work": 5000,
      "total": 15000,
      "description": "Замена на NGK",
      "resources": [
        {
          "name": "Свеча зажигания Longlife",
          "article": "04E905601",
          "count": 4,
          "price": 3941,
          "description": "Оригинал"
        }
      ]
    }
  ]
}'
