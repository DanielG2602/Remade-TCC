up:
	docker compose up -d

down:
	docker compose down
	
build:
	docker compose up -d --build

fresh:
	docker compose down
	docker compose up -d --build

restart:
	docker compose restart

logs:
	docker compose logs -f

shell:
	docker compose exec php bash

db:
	docker compose exec mysql -u acervo -pacervo123 acervo_rct
	
ps:
	docker compose ps