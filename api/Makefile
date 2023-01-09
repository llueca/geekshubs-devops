.PHONY=run-dev

DOCKER-COMPOSE=docker-compose
DOCKER=docker

run-dev-front:

run-dev-back:
	cd ../back && docker compose up -d && cd -

run-dev: run-dev-back run-dev-front
