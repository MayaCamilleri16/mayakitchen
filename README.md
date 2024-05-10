# Maya's Kitchen - Restaurant Booking System API

Welcome to Maya's Kitchen! This project is a restaurant booking system API designed to manage bookings, events, menus, orders, and other related functionalities. The system provides endpoints for creating and managing bookings, orders, user feedback, and more.

## Table of Contents

- Getting Started
- Project Structure
- API Endpoints
- Usage
- Dependencies
- Api Testing
- Contributing


## Getting Started

To get started with the project, follow the instructions below:

1. **Clone the Repository**: Clone the repository to your local machine.

    ```shell
https://github.com/MayaCamilleri16/mayakitchen
    ```

2. **Navigate to the Project Directory**: Change to the project directory.

    ```shell
    cd mayaskitchen
    ```

3. **Install Dependencies**: Ensure you have the required dependencies installed.

    See the [Dependencies] section for more information.

4. **Configure the Database**: Set up and configure your database.

5. **Run the Application**: Follow the [Usage] section for instructions on how to run the application.

## Project Structure

The project is organized into the following main directories and components:

- api/: Contains the API scripts for handling various requests such as creating and managing bookings, orders, user feedback, and other related functionalities.
- core/: Contains core components such as database initialization, connection, and other essential configurations.
- database/: Contains scripts for setting up and managing the MySQL database, including schema creation and sample data insertion.
- documentation/: Uses MkDocs to generate comprehensive project documentation, including an overview of the API endpoints and usage.
- includes/: Contains shared code, utility functions, and reusable components used across the project.
- postman/: Contains Postman collections and environments to aid in testing and working with the API.
  
Additional Notes

MkDocs: You can use MkDocs to generate project documentation from the documentation/ directory. See the MkDocs documentation for more details on usage.
Postman: The postman/ directory contains Postman collections and environments for testing and exploring the API endpoints. Import these files into Postman to get started.

## API Endpoints

The API provides endpoints for various functionalities:

- **Bookings**: Manage restaurant bookings, including creating, updating, and deleting bookings.

- **DailySpecials**: Manage daily specials in the restaurant.

- **Discounts**: Handle discounts for orders and bookings made on the app and in the restaurant.

- **Drinks**: Manage drink options on the menu.

- **EventFeedback**: Manage feedback from events held at the restaurant.

- **EventManagement**: Manage restaurant events.

- **Food**: Manage food options on the menu.

- **FoodPreferences**: Manage user food preferences.

- **LoyaltyProgram**: Manage loyalty programs for customers.

- **OrderFeedbackUser**: Handle user feedback on orders.

- **Recipes**: Manage restaurant recipes.

- **Reviews**: Manage user reviews.

- **SpecialOffers**: Manage special offers for customers.

- **StaffShift**: Manage staff shifts and schedules.

- **StaffViewingAppOrders**: Manage the process of staff viewing app orders.

- **StaffWork**: Manage various staff-related tasks.

- **Tables**: Manage table availability and reservations.

- **User**: Manage user accounts and profiles.

- **UserOrderApp**: Manage user orders through the app.

- **WaiterTakingOrder**: Manage the process of waiters taking orders.

Refer to the code files in the `api/` directory for detailed information on each endpoint.

## Usage

To run the application:

1. Start a local server and point it to the project directory.

2. Ensure the database is properly configured and running.

3. Access the API endpoints using tools like Postman or a web browser.

4. Refer to the code comments for detailed explanations of the usage of different endpoints.

## Dependencies

The project relies on the following dependencies:

- **PHP**: The server-side scripting language used for the project.

- **MySQL**: The database management system used for data storage and retrieval.

- **PDO**: PHP Data Objects for database interactions.

## API Testing

The API can be tested and explored using Postman. Postman collections and environments have been provided in the postman/ directory to aid in API testing.

To get started:

- Import the provided collections and environments into Postman.
- Use the endpoints in the collections to test the API.
- Refer to Postman's documentation for more information on how to use the tool.

## Contributing

Contributions are welcome! If you would like to contribute, please fork the repository and create a pull request. Make sure to follow coding best practices and include clear, concise comments in your code.

