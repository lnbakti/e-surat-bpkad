.PHONY: help up down restart build logs ps bash artisan migrate fresh seed test vite npm-install npm-build clean

help:
	@echo "Perintah Docker untuk Sistem Persuratan BPKAD:"
	@echo "  make up          - Menjalankan seluruh container di latar belakang"
	@echo "  make down        - Menghentikan dan menghapus container"
	@echo "  make restart     - Restart seluruh container"
	@echo "  make build       - Build ulang Docker image"
	@echo "  make logs        - Melihat log container secara real-time"
	@echo "  make ps          - Melihat status dan port container"
	@echo "  make bash        - Masuk ke terminal bash container app"
	@echo "  make migrate     - Menjalankan migrasi database"
	@echo "  make seed        - Menjalankan seeder database"
	@echo "  make fresh       - Reset database dan seeder ulang (migrate:fresh --seed)"
	@echo "  make test        - Menjalankan test suite PHPUnit"
	@echo "  make vite        - Menjalankan Vite dev server untuk hot-reload"
	@echo "  make npm-build   - Build aset produksi Vite (Tailwind CSS & JS)"
	@echo "  make clean       - Bersihkan cache Laravel"

up:
	docker compose up -d

down:
	docker compose down

restart:
	docker compose restart

build:
	docker compose build

logs:
	docker compose logs -f

ps:
	docker compose ps

bash:
	docker compose exec -it app bash

migrate:
	docker compose exec app php artisan migrate

seed:
	docker compose exec app php artisan db:seed

fresh:
	docker compose exec app php artisan migrate:fresh --seed

test:
	docker compose exec app php artisan test

vite:
	docker compose --profile dev up -d vite

npm-install:
	docker compose exec app npm install

npm-build:
	docker compose exec app npm run build

clean:
	docker compose exec app php artisan optimize:clear
