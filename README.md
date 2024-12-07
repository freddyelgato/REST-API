# REST API - PHP Application

This project is a simple REST API built using PHP, MySQL, and Docker. You can run it locally and interact with it using tools like Postman.

## Requirements
- **Docker**: [Install Docker](https://www.docker.com/get-started) if you don’t have it yet.

## Installation Instructions

1. **Clone this repository**:
   ```bash
   git clone https://github.com/freddyelgato/REST-API.git
   cd REST-API
2. **Build and run the application with Docker**:
   ```bash
   docker build -t rest-api .
   docker run -d -p 8080:80 --name rest-api-container rest-api
3. **Access the API**
   ```bash
   GET Request: http://localhost:8080/friends (To get all friends)
   POST Request: http://localhost:8080/friends (To create a new friend)
   PUT Request: http://localhost:8080/friends/{id} (To update a friend)
   DELETE Request: http://localhost:8080/friends/{id} (To delete a friend)

## API Methods

### GET
- **Fetch all friends**: This method retrieves the list of all friends.
- **Fetch a specific friend by ID**: This method retrieves the information of a friend by their unique ID.

### POST
- **Add a new friend**: This method allows you to add a new friend to the database.

### PUT
- **Update an existing friend**: This method allows you to update the information of an already registered friend in the database.

### DELETE
- **Delete a friend**: This method allows you to delete a friend from the database by their ID.
# Useful Commands

View running containers: `docker ps`  
Stop the container: `docker stop rest-api-container`  
Remove the container: `docker rm rest-api-container`  
Remove the image: `docker rmi rest-api`  

## Docker Hub Image
You can push the image to Docker Hub for easy access if needed: [Docker Hub Image](https://hub.docker.com/r/2424833f/mi-aplicacion-php)

## GitHub Repository
Check out the GitHub repository for more details and updates: [GitHub Repository](https://github.com/freddyelgato/REST-API)


