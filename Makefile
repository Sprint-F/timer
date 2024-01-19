.PHONY: tests

COMPOSE=docker-compose -f docker-compose.yaml

clean:
	@echo "Stopping all containers and cleaning $(ENV) ..."
	@docker stop $$(docker ps -a -q)
	@yes | docker system prune
	@echo "Cleaned!"

clean-all:
	@echo "Stopping all containers and cleaning $(ENV) ..."
	@docker stop $$(docker ps -a -q)
	@yes | docker system prune -a
	@yes | docker volume prune
	@echo "Cleaned!"

up:
	@echo "Starting..."
	$(COMPOSE) up -d --build --remove-orphans
	$(COMPOSE) exec -T php composer install --no-scripts
	@echo "Built!"

fix:
	@echo "Fixing..."
	@$(COMPOSE) exec -T php vendor/bin/php-cs-fixer fix
	@echo "Fixed!"

tests:
	@echo "Testing in $(ENV) ..."
	@$(COMPOSE) exec -T php php tests/index.php
	@echo "Tested!"

down:
	@echo "Stopping..."
	@$(COMPOSE) down
	@echo "Stopped!"
