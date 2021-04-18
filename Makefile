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
add-migration:
	docker-compose run --rm --user="1000" php-cli composer phinx create $(name)
run-migrations:
	docker-compose run --rm php-cli composer phinx migrate -- -e development
rollback-migration:
	docker-compose run --rm php-cli composer phinx rollback