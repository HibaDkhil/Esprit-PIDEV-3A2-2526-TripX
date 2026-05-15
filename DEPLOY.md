# Deployment

This project now includes a production Docker setup built for Symfony 6.4 and PHP 8.3.

## Before You Deploy

1. Rotate every secret currently stored in your local `.env` file.
2. Copy `.env.deploy.example` to a private deployment env file such as `.env.deploy.local`.
3. Fill in the real production values there or in your hosting platform's secret manager.

Important:

- Do not commit real secrets.
- `public/uploads` is mounted as a Docker volume so user uploads survive restarts.
- Set `APP_ENV=prod` in production.

## Deploy With Docker Compose

1. Create your production env file:

```powershell
Copy-Item .env.deploy.example .env.deploy.local
```

2. Update the values in `.env.deploy.local`.

3. Start the stack:

```powershell
docker compose --env-file .env.deploy.local -f docker-compose.prod.yml up --build -d
```

4. Open the app:

- Website: `http://YOUR_SERVER_IP:8080`
- Mercure hub: `http://YOUR_SERVER_IP:3000/.well-known/mercure`

## Common Operations

Run migrations manually:

```powershell
docker compose --env-file .env.deploy.local -f docker-compose.prod.yml exec app php bin/console doctrine:migrations:migrate --no-interaction
```

View logs:

```powershell
docker compose --env-file .env.deploy.local -f docker-compose.prod.yml logs -f app
```

Stop the stack:

```powershell
docker compose --env-file .env.deploy.local -f docker-compose.prod.yml down
```

## Notes

- If you already use a managed MySQL or Redis service, point `DATABASE_URL` or `REDIS_URL` at those services instead of the bundled containers.
- If Mercure is not needed in production, you can remove that service and set the Mercure env vars accordingly.
- If `GOOGLE_AUTH_CONFIG` must point to a file, mount that credential file into the container and set the absolute container path.
