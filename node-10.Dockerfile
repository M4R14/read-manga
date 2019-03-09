FROM node:10-alpine

RUN apk update \
  && apk add git
  
RUN npm install -g gatsby-cli

WORKDIR /app
