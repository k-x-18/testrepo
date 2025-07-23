# PHP Search Website Docker Setup

## Build the Docker Image
```sh
docker build -t php-search-app .
```

## Run the Container
```sh
docker run -p 8080:80 php-search-app
```

Then open your browser to http://localhost:8080 to view the site. 