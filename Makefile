install:
		composer install
validate:
		composer validate
lint:
		composer phpcs -- --standard=PSR12 src bin
brain-games:
		./bin/brain-games
