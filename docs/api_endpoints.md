## API Endpoints

This section provides detailed information on each API endpoint offered by Maya's Kitchen restaurant booking system API. For each endpoint, you'll find a description of it's purpose, the HTTP method it uses, and details about it's expected inputs and outputs.

### Bookings

- **Create Booking**
    - **HTTP Method**: POST
    - **Endpoint**: `/api/bookings`
    - **Description**: Creates a new booking.
    - **Request Body**: JSON object containing booking details.
    - **Parameters**:
  - `user_id` (integer): The ID of the user making the booking.
  - `date` (string): The date of the booking 
  - `time` (string): The time of the booking
  - `party_size` (integer): The number of people in the booking party.
  - `preferences_id` (integer, optional): The ID of any preferences for the booking.
  - `discount_id` (integer, optional): The ID of any discount to apply to the booking.
  - **Response**: JSON object with the created booking details.

- **Update Booking**
    - **HTTP Method**: PUT
    - **Endpoint**: `/api/bookings/{booking_id}`
    - **Description**: Updates an existing booking with the specified `booking_id`.
    - **Request Body**: JSON object with updated booking details.
    - **Response**: JSON object with the updated booking details.

- **Delete Booking**
    - **HTTP Method**: DELETE
    - **Endpoint**: `/api/bookings/{booking_id}`
    - **Description**: Deletes the booking with the specified `booking_id`.
    - **Response**: JSON object confirming the deletion.

- **Get Booking Details**
    - **HTTP Method**: GET
    - **Endpoint**: `/api/bookings/{booking_id}`
    - **Description**: Retrieves the details of a booking with the specified `booking_id`.
    - **Response**: JSON object with the booking details.

### Daily Specials

- **Get Daily Specials**
    - **HTTP Method**: GET
    - **Endpoint**: `/api/daily-specials`
    - **Description**: Retrieves a list of daily specials.
    - **Response**: JSON array containing details of daily specials.

- **Create Daily Special**
    - **HTTP Method**: POST
    - **Endpoint**: `/api/daily-specials`
    - **Description**: Creates a new daily special.
    - **Request Body**: JSON object containing daily special details 
    - **Parameters**: 
    - `date` (string): The date for the daily special, formatted as YYYY-MM-DD.
    - `food_special` (string): The name of the daily special.
    - `price` (float): The price of the daily special.
    - `description` (string): A description of the daily special.
    - **Response**: JSON object with the created daily special details.

- **Update Daily Special**
    - **HTTP Method**: PUT
    - **Endpoint**: `/api/daily-specials/{special_id}`
    - **Description**: Updates an existing daily special with the specified `special_id`.
    - **Request Body**: JSON object with updated daily special details.
    - **Response**: JSON object with the updated daily special details.

- **Delete Daily Special**
    - **HTTP Method**: DELETE
    - **Endpoint**: `/api/daily-specials/{special_id}`
    - **Description**: Deletes the daily special with the specified `special_id`.
    - **Response**: JSON object confirming the deletion.

### Discounts

- **Get Discounts**
    - **HTTP Method**: GET
    - **Endpoint**: `/api/discounts`
    - **Description**: Retrieves a list of available discounts.
    - **Response**: JSON array containing details of discounts.

- **Create Discount**
    - **HTTP Method**: POST
    - **Endpoint**: `/api/discounts`
    - **Description**: Creates a new discount.
    - **Request Body**: JSON object containing discount details 
    - **Parameters**: 
    - `code` (string): The discount code, a unique identifier for the discount.
    - `amount` (float): The amount of the discount, either as a percentage or a fixed amount.
    - `expriation-date` (string): The expiration date of the discount, formatted as YYYY-MM-DD.
    - **Response**: JSON object with the created discount details.

- **Update Discount**
    - **HTTP Method**: PUT
    - **Endpoint**: `/api/discounts/{discount_id}`
    - **Description**: Updates an existing discount with the specified `discount_id`.
    - **Request Body**: JSON object with updated discount details.
    - **Response**: JSON object with the updated discount details.

- **Delete Discount**
    - **HTTP Method**: DELETE
    - **Endpoint**: `/api/discounts/{discount_id}`
    - **Description**: Deletes the discount with the specified `discount_id`.
    - **Response**: JSON object confirming the deletion.

### Drinks

- **Get Drinks**
    - **HTTP Method**: GET
    - **Endpoint**: `/api/drinks`
    - **Description**: Retrieves a list of available drinks.
    - **Response**: JSON array containing details of drinks.

- **Create Drink**
    - **HTTP Method**: POST
    - **Endpoint**: `/api/drinks`
    - **Description**: Creates a new drink.
    - **Request Body**: JSON object containing drink details 
    - **Parameters**: 
    - `name` (string): The name of the drink.
    - `price` (float): The price of the drink.
    - **Response**: JSON object with the created drink details.

- **Update Drink**
    - **HTTP Method**: PUT
    - **Endpoint**: `/api/drinks/{drink_id}`
    - **Description**: Updates an existing drink with the specified `drink_id`.
    - **Request Body**: JSON object with updated drink details.
    - **Response**: JSON object with the updated drink details.

- **Delete Drink**
    - **HTTP Method**: DELETE
    - **Endpoint**: `/api/drinks/{drink_id}`
    - **Description**: Deletes the drink with the specified `drink_id`.
    - **Response**: JSON object confirming the deletion.

### EventFeedback

- **Get EventFeedback**
    - **HTTP Method**: GET
    - **Endpoint**: `/api/event-feedback`
    - **Description**: Retrieves feedback from events held at the restaurant.
    - **Response**: JSON array containing feedback details.

- **Create EventFeedback**
    - **HTTP Method**: POST
    - **Endpoint**: `/api/event-feedback`
    - **Description**: Creates feedback for an event.
    - **Request Body**: JSON object containing feedback details .
     - **Parameters**: 
    - `event_id ` (integer): The ID of the event being reviewed.
    - `user_id` (integer): The ID of the user providing feedback.
     - `comment  ` (string): The user's comments or feedback on the event.
    - `rating` (integer): The user's rating of the event, on a scale of 1 to 5.
    - **Response**: JSON object with the created feedback details.

- **Update EventFeedback**
    - **HTTP Method**: PUT
    - **Endpoint**: `/api/event-feedback/{feedback_id}`
    - **Description**: Updates an existing event feedback entry with the specified `feedback_id`.
    - **Request Body**: JSON object with updated feedback details.
    - **Response**: JSON object with the updated feedback details.

- **Delete EventFeedback**
    - **HTTP Method**: DELETE
    - **Endpoint**: `/api/event-feedback/{feedback_id}`
    - **Description**: Deletes event feedback with the specified `feedback_id`.
    - **Response**: JSON object confirming the deletion.


### LoyaltyProgram

- **Get Loyalty Program**
    - **HTTP Method**: GET
    - **Endpoint**: `/api/loyalty-program`
    - **Description**: Retrieves details of the loyalty program for customers, including available points, rewards, and tiers.
    - **Response**: JSON object with loyalty program details.

- **Create Loyalty Program**
    - **HTTP Method**: POST
    - **Endpoint**: `/api/loyalty-program`
    - **Description**: Creates a new loyalty program entry for a customer.
    - **Request Body**: JSON object containing the loyalty program details.
    - **Parameters**:
    - `user_id` (integer): The ID of the user for whom the loyalty program entry is being created.
    - `points` (integer): The initial amount of points for the user's loyalty program account.
    - `discount_id` (integer): The ID of the discount associated with the user's loyalty program.
    - **Response**: JSON object with the created loyalty program details.

- **Update Loyalty Program**
    - **HTTP Method**: PUT
    - **Endpoint**: `/api/loyalty-program/{user_id}`
    - **Description**: Updates the loyalty program entry for the specified `user_id`.
    - **Request Body**: JSON object with updated loyalty program details.
    - **Response**: JSON object with the updated loyalty program details.

- **Delete Loyalty Program**
    - **HTTP Method**: DELETE
    - **Endpoint**: `/api/loyalty-program/{user_id}`
    - **Description**: Deletes the loyalty program entry for the specified `user_id`.
    - **Response**: JSON object confirming the deletion.


### AppOrders

- **Get App Orders**
    - **HTTP Method**: GET
    - **Endpoint**: `/api/app-orders`
    - **Description**: Retrieves a list of all app orders.
    - **Response**: JSON array containing order details.

- **Create App Order**
    - **HTTP Method**: POST
    - **Endpoint**: `/api/app-orders`
    - **Description**: Creates a new app order.
    - **Request Body**: JSON object containing order details.
    - **Parameters**:
        - `user_id` (integer): The ID of the user creating the order.
        - `order_date` (string): The date the order was placed.
        - `total_price` (decimal): The total price of the order.
        - `status` (string): The current status of the order (e.g., "Pending," "Completed").
        - `delivery_type` (string): The type of delivery for the order (e.g., "Pickup," "Delivery").
    - **Response**: JSON object with the created order details.

- **Update App Order**
    - **HTTP Method**: PUT
    - **Endpoint**: `/api/app-orders/{order_id}`
    - **Description**: Updates an existing app order with the specified `order_id`.
    - **Request Body**: JSON object with updated order details.
    - **Response**: JSON object with the updated order details.

- **Delete App Order**
    - **HTTP Method**: DELETE
    - **Endpoint**: `/api/app-orders/{order_id}`
    - **Description**: Deletes the app order with the specified `order_id`.
    - **Response**: JSON object confirming the deletion.

- **Get App Order Details**
    - **HTTP Method**: GET
    - **Endpoint**: `/api/app-orders/{order_id}`
    - **Description**: Retrieves the details of a specific app order with the specified `order_id`.
    - **Response**: JSON object containing the order details.

    Here is the API documentation for Event Management following the provided format:

### EventManagement

- **Create Event**
    - **HTTP Method**: POST
    - **Endpoint**: `/api/events`
    - **Description**: Creates a new event.
    - **Request Body**: JSON object containing event details.
    - **Parameters**:
        - `user_id` (integer): The ID of the user creating the event.
        - `event_name` (string): The name of the event.
        - `event_date` (string): The date of the event.
        - `event_time` (string): The time of the event.
        - `party_size` (integer): The size of the party for the event.
    - **Response**: JSON object with the created event details.

- **Update Event**
    - **HTTP Method**: PUT
    - **Endpoint**: `/api/events/{event_id}`
    - **Description**: Updates an existing event with the specified `event_id`.
    - **Request Body**: JSON object containing updated event details.
    - **Response**: JSON object with the updated event details.

- **Delete Event**
    - **HTTP Method**: DELETE
    - **Endpoint**: `/api/events/{event_id}`
    - **Description**: Deletes the event with the specified `event_id`.
    - **Response**: JSON object confirming the deletion.

- **Get Events details for User**
    - **HTTP Method**: GET
    - **Endpoint**: `/api/events/user/{user_id}`
    - **Description**: Retrieves a list of events for the specified user based on `user_id`.
    - **Response**: JSON array containing event details, including event ID, event name, event date, event time, and party size for each event associated with the user.

### Food

- **Create Food**
    - **HTTP Method**: POST
    - **Endpoint**: `/api/food`
    - **Description**: Creates a new food item.
    - **Request Body**: JSON object containing food item details.
    - **Parameters**:
        - `name` (string): The name of the food item.
        - `price` (float): The price of the food item.
        - `extra` (string): Additional information or extras about the food item.
    - **Response**: JSON object with the created food item details.

- **Update Food**
    - **HTTP Method**: PUT
    - **Endpoint**: `/api/food/{food_id}`
    - **Description**: Updates an existing food item based on `food_id`.
    - **Request Body**: JSON object containing updated food item details.
    - **Response**: JSON object with the updated food item details.

- **Delete Food**
    - **HTTP Method**: DELETE
    - **Endpoint**: `/api/food/{food_id}`
    - **Description**: Deletes the food item with the specified `food_id`.
    - **Response**: JSON object confirming the deletion.

- **Get Food Menu**
    - **HTTP Method**: GET
    - **Endpoint**: `/api/food/menu`
    - **Description**: Retrieves a list of all food items available on the menu.
    - **Response**: JSON array containing food item details including `food_id`, `name`, `price`, and `extra`.

### Orders

- **Get All Orders**
    - **HTTP Method**: GET
    - **Endpoint**: `/api/orders`
    - **Description**: Retrieves a list of all orders in the database.
    - **Response**: JSON array containing order details including `order_id`, `booking_id`, `food_id`, `drink_id`, `discount_id`, `table_id`, and `offer_id`.

- **Get Order Details**
    - **HTTP Method**: GET
    - **Endpoint**: `/api/orders/{order_id}`
    - **Description**: Retrieves details of a specific order based on `order_id`.
    - **Response**: JSON object containing order details.

- **Create Order**
    - **HTTP Method**: POST
    - **Endpoint**: `/api/orders`
    - **Description**: Creates a new order.
    - **Request Body**: JSON object containing order details.
    - **Parameters**:
        - `booking_id` (integer): The ID of the booking associated with the order.
        - `food_id` (integer, optional): The ID of the food item associated with the order.
        - `drink_id` (integer, optional): The ID of the drink item associated with the order.
        - `discount_id` (integer, optional): The ID of the discount associated with the order.
        - `table_id` (integer, optional): The ID of the table where the order is placed.
        - `offer_id` (integer, optional): The ID of the offer associated with the order.
    - **Response**: JSON object with the created order details.

- **Update Order**
    - **HTTP Method**: PUT
    - **Endpoint**: `/api/orders/{order_id}`
    - **Description**: Updates an existing order based on `order_id`.
    - **Request Body**: JSON object containing updated order details.
    - **Response**: JSON object with the updated order details.

- **Delete Order**
    - **HTTP Method**: DELETE
    - **Endpoint**: `/api/orders/{order_id}`
    - **Description**: Deletes the order with the specified `order_id`.
    - **Response**: JSON object confirming the deletion.

- **Mark Order as Served**
    - **HTTP Method**: PUT
    - **Endpoint**: `/api/orders/{order_id}/served`
    - **Description**: Marks an order as served based on `order_id`.
    - **Response**: JSON object confirming the order has been marked as served.

### Recipes

- **Get All Recipes**
    - **HTTP Method**: GET
    - **Endpoint**: `/api/recipes`
    - **Description**: Retrieves a list of all recipes from the database.
    - **Response**: JSON array containing recipes with properties such as `recipe_id`, `recipe_name`, `prep_time_minutes`, `total_time_minutes`, `servings`, `meal_type`, and `instructions`.

- **Get Recipe Details**
    - **HTTP Method**: GET
    - **Endpoint**: `/api/recipes/{recipe_id}`
    - **Description**: Retrieves detailed information about a specific recipe based on `recipe_id`.
    - **Response**: JSON object with recipe details.

- **Create Recipe**
    - **HTTP Method**: POST
    - **Endpoint**: `/api/recipes`
    - **Description**: Creates a new recipe in the database.
    - **Request Body**: JSON object containing recipe details.
    - **Parameters**:
        - `recipe_name` (string): The name of the recipe.
        - `prep_time_minutes` (integer): Preparation time in minutes.
        - `total_time_minutes` (integer): Total time in minutes.
        - `cook_time_minutes` (integer): Cooking time in minutes.
        - `servings` (integer): Number of servings.
        - `meal_type` (string): Type of meal (e.g., breakfast, lunch, dinner).
        - `instructions` (string): Cooking instructions.
    - **Response**: JSON object with the newly created recipe details.

- **Update Recipe**
    - **HTTP Method**: PUT
    - **Endpoint**: `/api/recipes/{recipe_id}`
    - **Description**: Updates an existing recipe in the database based on `recipe_id`.
    - **Request Body**: JSON object containing the updated recipe details.
    - **Response**: JSON object with the updated recipe details.

- **Delete Recipe**
    - **HTTP Method**: DELETE
    - **Endpoint**: `/api/recipes/{recipe_id}`
    - **Description**: Deletes a recipe from the database based on `recipe_id`.
    - **Response**: JSON object confirming the deletion of the recipe.

### Reviews

- **Get All Reviews**
    - **HTTP Method**: GET
    - **Endpoint**: `/api/reviews`
    - **Description**: Retrieves a list of all reviews from the database, ordered by the most recent first.
    - **Response**: JSON array containing reviews, with properties such as `id`, `user_id`, `rating`, `comment`, and `time`.

- **Get Single Review**
    - **HTTP Method**: GET
    - **Endpoint**: `/api/reviews/{id}`
    - **Description**: Retrieves a single review based on its ID.
    - **Response**: JSON object with review properties such as `id`, `user_id`, `rating`, `comment`, and `time`.

- **Create Review**
    - **HTTP Method**: POST
    - **Endpoint**: `/api/reviews`
    - **Description**: Adds a new review to the database.
    - **Request Body**: JSON object containing review details.
    - **Parameters**:
        - `user_id` (integer): ID of the user submitting the review.
        - `rating` (integer): Rating value from the user.
        - `comment` (string): Comment from the user.
    - **Response**: JSON object confirming the creation of the review.

- **Update Review**
    - **HTTP Method**: PUT
    - **Endpoint**: `/api/reviews/{id}`
    - **Description**: Updates an existing review based on its ID.
    - **Request Body**: JSON object containing updated review details.
    - **Response**: JSON object confirming the update.

- **Delete Review**
    - **HTTP Method**: DELETE
    - **Endpoint**: `/api/reviews/{id}`
    - **Description**: Deletes a review from the database based on its ID.
    - **Response**: JSON object confirming the deletion.

- **Get User Reviews**
    - **HTTP Method**: GET
    - **Endpoint**: `/api/reviews/user/{user_id}`
    - **Description**: Retrieves reviews written by a specific user.
    - **Response**: JSON array containing reviews written by the user, with properties such as `id`, `user_id`, `rating`, `comment`, `time`, and `user_name`.

### SpecialOffers

- **Create Special Offer**
    - **HTTP Method**: POST
    - **Endpoint**: `/api/special_offers`
    - **Description**: Adds a new special offer to the database.
    - **Request Body**: JSON object containing special offer details.
    - **Parameters**:
        - `name` (string): Name of the special offer.
        - `discount_percentage` (float): Discount percentage offered.
        - `valid_until` (date): Expiry date of the special offer.
    - **Response**: JSON object confirming the creation of the special offer.

- **Update Special Offer**
    - **HTTP Method**: PUT
    - **Endpoint**: `/api/special_offers/{offer_id}`
    - **Description**: Updates an existing special offer based on its ID.
    - **Request Body**: JSON object containing updated special offer details.
    - **Parameters**:
        - `offer_id` (integer): ID of the special offer to update.
        - `name` (string): Updated name of the special offer.
        - `discount_percentage` (float): Updated discount percentage.
        - `valid_until` (date): Updated expiry date.
    - **Response**: JSON object confirming the update of the special offer.

- **Delete Special Offer**
    - **HTTP Method**: DELETE
    - **Endpoint**: `/api/special_offers/{offer_id}`
    - **Description**: Deletes a special offer from the database based on its ID.
    - **Response**: JSON object confirming the deletion of the special offer.


### StaffShifts

- **Create Staff Shift**
    - **HTTP Method**: POST
    - **Endpoint**: `/api/staff_shifts`
    - **Description**: Adds a new staff shift to the database.
    - **Request Body**: JSON object containing staff shift details.
    - **Parameters**:
        - `staff_id` (integer): ID of the staff member.
        - `start_time` (time): Start time of the shift.
        - `end_time` (time): End time of the shift.
        - `date` (date): Date of the shift.
    - **Response**: JSON object confirming the creation of the staff shift.

- **Read Staff Shifts**
    - **HTTP Method**: GET
    - **Endpoint**: `/api/staff_shifts`
    - **Description**: Retrieves all staff shifts from the database.
    - **Response**: JSON array containing the staff shifts.

- **Read Single Staff Shift**
    - **HTTP Method**: GET
    - **Endpoint**: `/api/staff_shifts/{id}`
    - **Description**: Retrieves a single staff shift based on its ID.
    - **Parameters**:
        - `id` (integer): ID of the staff shift.
    - **Response**: JSON object containing the details of the staff shift.

- **Delete Staff Shift**
    - **HTTP Method**: DELETE
    - **Endpoint**: `/api/staff_shifts/{id}`
    - **Description**: Deletes a staff shift from the database based on its ID.
    - **Parameters**:
        - `id` (integer): ID of the staff shift to be deleted.
    - **Response**: JSON object confirming the deletion of the staff shift.


### staffwork

- **Read All Staff**
    - **Description**: Retrieves all staff records from the database.
    - **Returns**: A statement with the results of the query.

- **Read Single Staff**
    - **Description**: Retrieves a single staff record from the database based on the staff ID.
    - **Parameters**:
        - `staff_id` (integer): The ID of the staff member to be retrieved.
    - **Returns**: A statement with the results of the query.

- **Create Staff**
    - **Description**: Adds a new staff record to the database.
    - **Parameters**:
        - `username` (string): The username of the staff member.
        - `email` (string): The email of the staff member.
        - `password` (string): The password of the staff member.
        - `role` (string): The role of the staff member.
    - **Returns**: `true` if the creation was successful, `false` otherwise.

- **Update Staff**
    - **Description**: Updates an existing staff record in the database.
    - **Parameters**:
        - `staff_id` (integer): The ID of the staff member to be updated.
        - `username` (string): The new username of the staff member.
        - `email` (string): The new email of the staff member.
        - `password` (string): The new password of the staff member.
        - `role` (string): The new role of the staff member.
    - **Returns**: `true` if the update was successful, `false` otherwise.

- **Delete Staff**
    - **Description**: Deletes a staff record from the database based on the staff ID.
    - **Parameters**:
        - `staff_id` (integer): The ID of the staff member to be deleted.
    - **Returns**: `true` if the deletion was successful, `false` otherwise.

### Tables

- **Read All Tables**
    - **Description**: Retrieves all tables from the database.
    - **Returns**: A statement with the results of the query.

- **Read Single Table**
    - **Description**: Retrieves a single table from the database based on the table ID.
    - **Parameters**:
        - `table_id` (integer): The ID of the table to be retrieved.
    - **Returns**: An associative array containing the table data.

- **Create Table**
    - **Description**: Adds a new table to the database.
    - **Parameters**:
        - `number` (integer): The number or identifier of the new table.
        - `available` (boolean): Whether the table is available or not.
    - **Returns**: `true` if the creation was successful, `false` otherwise.

- **Update Table**
    - **Description**: Updates an existing table in the database based on the table ID.
    - **Parameters**:
        - `table_id` (integer): The ID of the table to be updated.
        - `number` (integer): The new number or identifier of the table.
        - `available` (boolean): Whether the table is available or not.
    - **Returns**: `true` if the update was successful, `false` otherwise.

- **Delete Table**
    - **Description**: Deletes a table from the database based on the table ID.
    - **Parameters**:
        - `table_id` (integer): The ID of the table to be deleted.
    - **Returns**: `true` if the deletion was successful, `false` otherwise.


### User

- **Read All Users**
    - **Description**: Retrieves all users from the database.
    - **Returns**: A statement with the results of the query.

- **Read Single User**
    - **Description**: Retrieves a single user from the database based on the user ID.
    - **Parameters**:
        - `id` (integer): The ID of the user to be retrieved.
    - **Returns**: An associative array containing the user data.

- **Create User**
    - **Description**: Adds a new user to the database.
    - **Parameters**:
        - `username` (string): The username of the new user.
        - `email` (string): The email address of the new user.
        - `password` (string): The password of the new user.
    - **Returns**: `true` if the creation was successful, `false` otherwise.

- **Update User**
    - **Description**: Updates an existing user in the database based on the user ID.
    - **Parameters**:
        - `id` (integer): The ID of the user to be updated.
        - `username` (string): The new username of the user.
        - `email` (string): The new email address of the user.
        - `password` (string): The new password of the user.
    - **Returns**: `true` if the update was successful, `false` otherwise.

- **Delete User**
    - **Description**: Deletes a user from the database based on the user ID.
    - **Parameters**:
        - `id` (integer): The ID of the user to be deleted.
    - **Returns**: `true` if the deletion was successful, `false` otherwise.

- **Update Password**
    - **Description**: Updates the password of a user in the database.
    - **Parameters**:
        - `id` (integer): The ID of the user whose password is to be updated.
        - `password` (string): The new password for the user.
    - **Returns**: `true` if the update was successful, `false` otherwise.

- **Get Special Offers**
    - **Description**: Retrieves all special offers from the database.
    - **Returns**: A statement with the results of the query.

- **Apply Special Offer**
    - **Description**: Applies a special offer to a user.
    - **Parameters**:
        - `offer_id` (integer): The ID of the special offer to apply.
    - **Returns**: `true` if the special offer is successfully applied, `false` otherwise.

- **Get Daily Specials**
    - **Description**: Retrieves daily specials from the database.
    - **Returns**: An array of associative arrays containing daily specials data.


### UserOrderFeedback

- **Read All Feedback**
    - **Description**: Retrieves all feedback entries from the database.
    - **Returns**: An array of associative arrays containing feedback data.

- **Read Single Feedback**
    - **Description**: Retrieves a single feedback entry from the database based on the feedback ID (`serve_feedback_id`).
    - **Parameters**:
        - `serve_feedback_id` (integer): The ID of the feedback entry to retrieve.
    - **Returns**: An associative array containing the feedback data.

- **Create Feedback**
    - **Description**: Adds a new feedback entry to the database.
    - **Parameters**:
        - `order_id` (integer): The ID of the order associated with the feedback.
        - `rating` (integer): The rating given in the feedback.
        - `comment` (string): The comment given in the feedback.
    - **Returns**: `true` if the creation was successful, `false` otherwise.

- **Update Feedback**
    - **Description**: Updates an existing feedback entry in the database based on the feedback ID (`serve_feedback_id`).
    - **Parameters**:
        - `serve_feedback_id` (integer): The ID of the feedback entry to update.
        - `order_id` (integer): The ID of the order associated with the feedback.
        - `rating` (integer): The updated rating for the feedback.
        - `comment` (string): The updated comment for the feedback.
    - **Returns**: `true` if the update was successful, `false` otherwise.

- **Delete Feedback**
    - **Description**: Deletes a feedback entry from the database based on the feedback ID (`serve_feedback_id`).
    - **Parameters**:
        - `serve_feedback_id` (integer): The ID of the feedback entry to delete.
    - **Returns**: `true` if the deletion was successful, `false` otherwise.

- **Get User Feedback**
    - **Description**: Retrieves all feedback entries associated with a specific user based on the user ID (`user_id`).
    - **Parameters**:
        - `user_id` (integer): The ID of the user whose feedback entries are to be retrieved.
    - **Returns**: An array of associative arrays containing user feedback data.


### UserPreferences

- **Create Preference**
    - **Description**: Adds a new user preference to the database.
    - **Parameters**:
        - `preference_name` (string): The name of the preference to be created.
    - **Returns**: `true` if the creation was successful, `false` otherwise.

- **Update Preference**
    - **Description**: Updates an existing user preference in the database based on the preference ID (`preferences_id`).
    - **Parameters**:
        - `preferences_id` (integer): The ID of the preference entry to update.
        - `preference_name` (string): The updated name of the preference.
    - **Returns**: `true` if the update was successful, `false` otherwise.

- **Delete Preference**
    - **Description**: Deletes a user preference from the database based on the preference ID (`preferences_id`).
    - **Parameters**:
        - `preferences_id` (integer): The ID of the preference entry to delete.
    - **Returns**: `true` if the deletion was successful, `false` otherwise.

### UserOrdersApp

- **Read All Orders**
    - **Description**: Retrieves all order items from the database.
    - **Returns**: A `PDOStatement` object containing the results of the query.

- **Read Single Order**
    - **Description**: Retrieves a single order item from the database based on the `order_id` property.
    - **Parameters**:
        - `order_id` (integer): The ID of the order to retrieve.
    - **Returns**: An associative array containing the order details if found, `false` otherwise.

- **Create Order**
    - **Description**: Adds a new order to the database.
    - **Parameters**:
        - `order_id` (integer): The ID of the new order.
        - `user_id` (integer): The ID of the user who placed the order.
        - `food_id` (integer): The ID of the food item in the order.
        - `drink_id` (integer): The ID of the drink item in the order.
        - `quantity_food` (integer): The quantity of the food item in the order.
        - `quantity_drink` (integer): The quantity of the drink item in the order.
        - `discount_id` (integer): The ID of the discount applied to the order, if any.
    - **Returns**: `true` if the creation was successful, `false` otherwise.

- **Delete Order**
    - **Description**: Deletes an order from the database based on the `order_id` property.
    - **Parameters**:
        - `order_id` (integer): The ID of the order to delete.
    - **Returns**: `true` if the deletion was successful, `false` otherwise.



