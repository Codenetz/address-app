FROM node:alpine
WORKDIR /var/www
COPY package*.json ./
RUN npm ci
COPY . .
EXPOSE 8033
CMD [ "npm", "run", "production" ]