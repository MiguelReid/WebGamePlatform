 ### JS Index

* If cookie "username" doesn't exist it displays the registration form, otherwise, it displays the game. From the cookies it also displays the navBar avatar.

------

### Pairs

* We select the game difficulty by the value selected in register page

* We create the cards, sets their images and ids programmatically depending on the cookies (number of cards needed), and appends them to the board. It also sets the grid template columns of the board.

* The cards are shuffled using the Fisher-Yates algorithm

* To the flipped cards it disables the click event.

* We initialize a loop which tracks the score, time taken and if the highscore is broken

* If the difficulty = complex we go through different levels depending on the complexGameIndex

* If we submit score we check if the user exists and if the score is higher than the one written, if it does we rewrite it, if the user doesn't exist we write the JSON with the new data.

* We get the highest score with a HttpRequest

------

### Registration

* With an onsubmit form, we can validate the user's input on the client-side before allowing the data to be submitted to the PHP file with a POST method.

* If we select complex difficulty we can customize the avatar and extra options appear, we'll also see how our avatar will look real-time, if not we'll have a predefined one.

* On the PHP we check the username again for special characters, if it's correct we'll set the cookies and session.

-----

### JS Leaderboard

* Programmatically we create a table with the data retrieved from an POST HttpRequest which gets the whole JSON and stores it in an array which we then separate so we can populate the table.