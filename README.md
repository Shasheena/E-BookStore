# Task Manager App
[![Ask DeepWiki](https://devin.ai/assets/askdeepwiki.png)](https://deepwiki.com/Shasheena/task-manager-app.git)

A simple, full-stack Task Manager application. It allows users to create, view, update, and delete tasks. The application features a vanilla JavaScript frontend and a Node.js backend connected to a MongoDB database. The backend is also containerized using Docker and includes a basic Jenkins CI pipeline configuration.

## Features

-   Add new tasks.
-   Display a list of all existing tasks.
-   Mark tasks as complete or incomplete.
-   Delete tasks from the list.
-   Persistent task storage via a MongoDB database.

## Tech Stack

-   **Frontend:** HTML, CSS, Vanilla JavaScript
-   **Backend:** Node.js, Express.js, Mongoose
-   **Database:** MongoDB
-   **Containerization:** Docker
-   **CI/CD:** Jenkins

## Project Structure

```
.
├── Jenkinsfile         # Jenkins pipeline configuration for CI
├── backend/            # Contains all backend source code
│   ├── Dockerfile      # Docker configuration for the backend
│   ├── package.json    # Backend dependencies and scripts
│   ├── server.js       # Main Express server entry point
│   ├── models/         # Mongoose data schemas
│   └── routes/         # API route definitions
└── frontend/           # Contains all frontend source code
    ├── index.html      # Main HTML file for the UI
    ├── script.js       # Client-side application logic
    └── style.css       # Styles for the application
```

## Getting Started

To run this project locally, you will need Node.js, npm, and MongoDB installed on your machine.

### 1. Backend Setup

1.  Navigate to the `backend` directory:
    ```bash
    cd backend
    ```

2.  Create a `.env` file in the `backend` directory. This file will store your environment variables. Add your MongoDB connection string and a port number:
    ```env
    MONGO_URI=mongodb://localhost:27017/taskmanager
    PORT=5000
    ```

3.  Install the necessary dependencies:
    ```bash
    npm install
    ```

4.  Start the development server:
    ```bash
    npm run dev
    ```
    The backend server will be running on `http://localhost:5000`.

### 2. Frontend Setup

1.  Navigate to the `frontend` directory.
2.  Open the `index.html` file in your preferred web browser.
3.  The application will automatically connect to the backend API, which it expects to be running at `http://localhost:5000`.

## Running with Docker

You can also run the backend service as a Docker container. This requires Docker to be installed on your system.

1.  Navigate to the `backend` directory.

2.  Build the Docker image:
    ```bash
    docker build -t task-manager-backend .
    ```

3.  Run the container, passing your MongoDB URI as an environment variable.
    ```bash
    docker run -p 5000:5000 -e MONGO_URI="your_mongodb_uri" task-manager-backend
    ```
    The backend will be accessible on `http://localhost:5000`.

## API Endpoints

The backend provides the following RESTful API endpoints for managing tasks:

| Method   | Endpoint         | Description                                     |
| :------- | :--------------- | :---------------------------------------------- |
| `GET`    | `/api/tasks`     | Fetches all tasks.                              |
| `POST`   | `/api/tasks`     | Creates a new task. Expects `{ "text": "..." }` in the body. |
| `PUT`    | `/api/tasks/:id` | Updates a task (e.g., to mark as complete). Expects `{ "completed": true/false }` in the body. |
| `DELETE` | `/api/tasks/:id` | Deletes a specific task.                        |