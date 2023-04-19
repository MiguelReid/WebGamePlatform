# WebGamePlatform
Final project for my web development module in Computer Science at Exeter

## Features

### JS Index

The code contains two main functionalities:

A function named getCookie that takes in a parameter name and retrieves the value of a cookie with the given name. It does this by accessing the document.cookie property, searching for the cookie with the given name, and returning its value if found. If not found, it returns null.
A window.onload event that triggers a function named checkCookies when the webpage loads. This function checks for the existence of a cookie named "username" and uses its value to determine whether or not to display the registration form or the game. If the cookie is not found, the registration form and related elements are made visible and the game is hidden. Otherwise, the game and related elements are made visible and the registration form is hidden. Additionally, the function retrieves the values of three more cookies named "eyes", "mouth", and "skin", and uses them to set the sources of three images on the page to the corresponding images.

------

### JS Pairs

* reload(): this function reloads the current page when called.

* restart(): this function is called when the user wants to restart the game. It resets some variables and removes all the cards from the board before calling the complexGame() function to start a new game.

* getCookie(name): this function is used to get the value of a cookie with the given name.

* shuffle(array): this function shuffles the elements of an array using the Fisher-Yates algorithm and returns the shuffled array.

* gameDifficulty(): this function is called when the user selects a game difficulty. It sets the display of the play button to none and initializes the game with the difficulty selected in the register page.

* nonClickeable(counter): this function disables the click event for the flipped cards.

* complexGame(): this function is called when the user selects the "complex" game difficulty. It calls the initializeGame() function to start the first level of the game. Depending on the complexGameIndex value, it calls initializeGame() with different parameters to start the other levels of the game.

* initializeGame(cards, complex, extraCards, flipCounter): this function initializes the game with the given parameters. It creates the cards, sets their images and ids, and appends them to the board. It also sets the grid template columns of the board and initializes some variables.

### PHP Pairs

Functionality 1: updatescores
This functionality updates a user's score in the leaderboard by creating a JSON object with the user's username, levels completed, and points earned, and appending it to the end of the existing JSON leaderboard data. The updated leaderboard data is then written to a file.

Functionality 2: changeScore
This functionality updates a user's score in the leaderboard by iterating through the existing JSON leaderboard data and finding the entry with the matching username. If the user's new score is higher than their existing score, their level completion data and score are updated, and the updated leaderboard data is written to a file.

Functionality 3: findUser
This functionality checks if a given user's username exists in the JSON leaderboard data. If the username is found, it returns true; otherwise, it returns false.

Functionality 4: leaderboardNames
This functionality retrieves a list of usernames from the JSON leaderboard data and returns them as an array.

Functionality 5: leaderboardScores
This functionality retrieves a list of scores from the JSON leaderboard data and returns them as an array.

Functionality 6: highscore
This functionality retrieves the highest score from the JSON leaderboard data and returns it. If the leaderboard data is empty, it returns 0.

------

### HTML and JS Registration

* The form has an onsubmit attribute that calls the submitForm() function, which validates the user's input before allowing the form to be submitted to the PHP file with a POST method

* The avatar selector is a dropdown menu that allows the user to choose between three options: simple, medium, and complex. When the user selects an option, the onchange attribute calls the showDiv() function, which displays or hides a group of related options based on the selected option.

* The complex options are three additional dropdown menus for selecting different parts of the avatar: eyes, mouth, and skin. These options are hidden by default but are displayed when the user selects the "complex" option in the avatar selector.

* Each of the three complex options has an onchange attribute that calls the changeFace() function, which changes the image displayed for the corresponding body part of the avatar.

* The changeFace() function is called by the onchange attribute of the complex options to change the image displayed for the selected body part. 

* The showDiv() function is called by the onchange attribute of the avatar selector to show or hide the complex options based on the selected option. 

* The submitForm() function is called by the onsubmit attribute of the form to validate the user's input before submitting the form.

### PHP Registration

1. We retrieve all of the variables we will need via POST method.
2. We check again that the username doesn't have any special characters
3. If the format is correct we'll set cookies for the values we will need in the pairs game
4. We go to the html page again

-----

### JS Leaderboard

* createTable creates an HTML table element and appends it to an existing HTML element.

* The table has a header row with five columns, labeled "Username", "Level 1", "Level 2", "Level 3", and "Total Points".

* The function also retrieves data passed to it as an argument, sorts it into arrays, and populates the table rows with the data.

* The scoreAlert function is called when the response from a server request is received. If the request was successful, the function retrieves the response text and passes it to the createTable function.

* The getCookie function retrieves the value of a specified cookie.

* The checkCookies function checks the user's cookies for values related to user customization of the site's appearance, and updates the site's appearance accordingly.

* The leaderboardScores function is called when the window loads. It calls the checkCookies function and makes an asynchronous HTTP request to retrieve leaderboard data, passing the response text to the scoreAlert function.

### PHP Leaderboard

1. The code checks if the action parameter was passed through POST and is set to 'leaderboardScores'.

2. The code reads a JSON file located at "../leaderboard.json".

3. The JSON data is decoded into an array.

4. The data is transformed into a one-dimensional array with the values of 'username', 'lvl1', 'lvl2', 'lvl3', and 'points' of each object in the decoded JSON array.

5. The array is encoded back into JSON and echoed out as a response.