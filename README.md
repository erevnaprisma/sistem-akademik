
### docker run
docker-compose -f "/Users/anvere/Library/Application Support/tutor/env/local/docker-compose.yml" -f "/Users/anvere/Library/Application Support/tutor/env/local/docker-compose.prod.yml" --project-name tutor_local run -d --service-ports mysql
docker-compose -f docker-compose.yml --project-name tutor_local run -d --service-ports sistemakademik