# TextStyler Site (textstyler.neurofabrika.store)

Статический сайт. Этот репозиторий содержит CI для проверки и деплоя.
- Скрипт `scripts/check-basic.js` проверяет базовые файлы и мета.
- Workflow `site-ci.yml` запускает проверку на push и деплой по тэгу релиза.

## Secrets для деплоя по SSH (пример, если есть VPS)
- `DEPLOY_HOST` — хост
- `DEPLOY_USER` — пользователь
- `DEPLOY_SSH_KEY` — приватный ключ
- `DEPLOY_PATH` — путь на сервере (например `/var/www/textstyler`)

Альтернатива: отключить шаг деплоя и выкладывать руками.
