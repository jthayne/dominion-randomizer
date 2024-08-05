.DEFAULT_GOAL := help
.PHONY: $(filter-out vendor,$(MAKECMDGOALS))

bin = ./vendor/bin

help: ## This help message
	@printf "\033[33mUsage:\033[0m\n  make [target]\n\n\033[33mTargets:\033[0m\n"
	@grep -E '^[-a-zA-Z0-9_\.\/]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[32m%-15s\033[0m %s\n", $$1, $$2}'

# Aliases
precommit: cs-fixer lint sniffercbf sniffer ## Run style fixing and linting commands
scan: cs-fixer lint sniffercbf sniffer phpmd ## Run all scans including mess detection
baseline: phpmd-baseline ## Generate tool baselines
build: clean vendor precommit ## Recompile all assets from scratch

## Build Processes
vendor: composer.json composer.lock ## Install PHP dependencies
	@composer install -n
	@echo "PHP dependencies installed."

clean: ## Removes all build dependencies (vendor)
	@rm -rf vendor/
	@echo "Dependencies removed."

# Build Tooling
cs-fixer: ## Code styling fixer
	@$(bin)/php-cs-fixer fix --config=build/php-cs-fixer/php-cs-fixer.dist.php

sniffer: ## Code sniffer
	@$(bin)/phpcs --standard=build/phpcs/VirtualReef/ruleset.xml --report=full -w -q classes tests config bootstrap

sniffer-ci:
	@$(bin)/phpcs --standard=build/phpcs/VirtualReef/ruleset.xml --report=full --colors -q classes tests config bootstrap

sniffercbf:
	@$(bin)/phpcbf --standard=build/phpcs/VirtualReef/ruleset.xml --report=full -w -q classes tests config bootstrap

sniffercbf-ci:
	@$(bin)/phpcbf --standard=build/phpcs/VirtualReef/ruleset.xml --report=full --colors -q -n classes tests config bootstrap

lint: ## PHP Syntax Checking
	@$(bin)/parallel-lint -j 10 classes tests public config bootstrap --no-progress --colors --blame

lint-ci:
	$(bin)/parallel-lint -j 10 classes public --no-progress --colors --checkstyle > report.xml

phpmd: ## PHP Mess Detection
	@$(bin)/phpmd classes,public ansi build/phpmd/phpmd.xml

phpmd-ci:
	@$(bin)/phpmd classes,public github build/phpmd/phpmd.xml

phpmd-baseline: ## PHP Mess Detection. Generate Baseline
	@$(bin)/phpmd classes,public ansi build/phpmd/phpmd.xml --generate-baseline

# Testing. Requires installing Pest. (Not yet installed).
pest: ## Unit testing
	@$(bin)/pest --colors=always -c build/pest/phpunit.xml
