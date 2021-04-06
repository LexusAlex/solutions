build-pull:
	docker-compose build --pull
up-build:
	docker-compose up --build -d
up:
	docker-compose up -d
down:
	docker-compose down --remove-orphans
restart:
	docker-compose restart
down-clear:
	docker-compose down -v --remove-orphans