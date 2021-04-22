chmod -R 777 .

docker-compose build app
docker-compose up -d db
docker-compose up -d redis
docker-compose up -d app
docker-compose up -d webserver

vi /etc/hosts
127.0.0.1 dev.chatbot.com cdn.chatbot.com