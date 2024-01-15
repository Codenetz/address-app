FROM node:alpine
WORKDIR /var/www
COPY . /var/www

COPY package*.json ./

RUN npm install

EXPOSE 8033

CMD [ "npm", "run", "production" ]
