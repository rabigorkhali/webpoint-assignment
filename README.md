
```markdown
# WebPoint Assignment

This project is designed to run with Docker. Before you start, make sure Docker is installed on your system, and verify that the ports specified in the "docker-compose.yml" file are available.

## Setup Instructions

### Step 1: Clone the Repository
```bash
git clone https://github.com/rabigorkhali/webpoint-assignment
```

### Step 2: Checkout the Main Branch
```bash
git checkout main
```

### Step 3: Run Setup
1. Open your terminal and navigate to the cloned repository folder.
2. Run the following command outside the 'application-files' folder, at the same path level as where the Makefile is situated.
   ```bash
   make setup
   ```

## After Successful Setup

### Access the Project
Visit [http://localhost:9002/public/login](http://localhost:9002/public/login) in your browser.

- Default User Email: rabigorkhali@gmail.com
- Default Password: rabi@123

### Access PHPMyAdmin
To access PHPMyAdmin, go to [http://localhost:9001/](http://localhost:9001/) in your browser.

- Default Server: mysql_db
- Default Username: root
- Default Password: root
