FROM node:18.1.0-alpine3.14 AS build

COPY ../.. /app

WORKDIR /app

RUN npm i && npm run build

FROM build AS production

COPY --from=build /app/build /app/build
COPY --from=build /app/public/build /app/public/build
COPY --from=build /app/package.json /app/package.json
COPY --from=build /app/package-lock.json /app/package-lock.json
COPY --from=build /app/server.js /app/server.js

WORKDIR /app

RUN npm i --omit=dev

WORKDIR /app/build

ENTRYPOINT ["npm", "start"]
